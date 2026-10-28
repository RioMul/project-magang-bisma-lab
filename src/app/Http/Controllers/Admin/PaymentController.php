<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\Template\TemplateContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct(
        private TemplateContentService $templateContent
    ) {}

    public function index(Request $request)
    {
        $totalInvoices = Payment::count();

        $paidInvoices = Payment::where('status', 'paid')
            ->count();

        $pendingInvoices = Payment::where('status', 'pending')
            ->count();

        $failedInvoices = Payment::whereIn('status', [
            'failed',
            'expired',
        ])->count();

        $totalRevenue = Payment::where('status', 'paid')
            ->sum('amount_paid');

        $payments = Payment::query()
            ->with([
                'order.user',
                'order.orderItems.package',
                'order.orderItems.template',
                'order.invoice',
            ])
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = $request->input('search');

                    $query->whereHas('order', function ($orderQuery) use ($search) {
                        $orderQuery->where(function ($orderQuery) use ($search) {
                            $orderQuery
                                ->where('order_number', 'like', "%{$search}%")
                                ->orWhere('customer_name', 'like', "%{$search}%")
                                ->orWhere('customer_email', 'like', "%{$search}%")
                                ->orWhere('domain_name', 'like', "%{$search}%")
                                ->orWhereHas('orderItems', function ($itemQuery) use ($search) {
                                    $itemQuery->where(
                                        'domain_name',
                                        'like',
                                        "%{$search}%"
                                    );
                                });
                        });
                    });
                }
            )
            ->when(
                $request->filled('status'),
                function ($query) use ($request) {
                    $query->where(
                        'status',
                        $request->input('status')
                    );
                }
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();

        // Jaga tampilan tabel yang masih membaca relasi package pada Order.
        // Nilainya berasal dari item pesanan.
        $payments->getCollection()->each(function (Payment $payment) {
            $order = $payment->order;

            if (!$order) {
                return;
            }

            $item = $order->orderItems->first();

            if (!$item) {
                return;
            }

            $order->setRelation('package', $item->package);
            $order->setAttribute('domain_name', $item->domain_name);
        });

        return view('admin.billing.index', compact(
            'payments',
            'totalInvoices',
            'paidInvoices',
            'pendingInvoices',
            'failedInvoices',
            'totalRevenue'
        ));
    }

    public function updateStatus(
        Request $request,
        Payment $payment
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,paid,failed,expired',
            ],
        ]);

        DB::transaction(function () use ($payment, $validated) {
            $payment = Payment::query()
                ->with([
                    'order.invoice',
                    'order.orderItems.template',
                ])
                ->lockForUpdate()
                ->findOrFail($payment->id);

            $oldStatus = $payment->status;
            $newStatus = $validated['status'];

            $payment->update([
                'status' => $newStatus,
                'paid_at' => $newStatus === 'paid'
                    ? ($payment->paid_at ?? now())
                    : null,
            ]);

            $orderStatus = match ($newStatus) {
                'paid' => 'paid',
                'failed' => 'failed',
                'expired' => 'expired',
                default => 'pending',
            };

            $order = $payment->order;

            $order->update([
                'status' => $orderStatus,
            ]);

            if ($order->invoice) {
                $order->invoice->update([
                    'status' => $newStatus,
                    'paid_at' => $newStatus === 'paid'
                        ? ($order->invoice->paid_at ?? now())
                        : null,
                ]);
            }

            if (
                $oldStatus !== 'paid'
                && $newStatus === 'paid'
            ) {
                $orderItem = $order->orderItems->first();
                $template = $orderItem?->template;

                if (
                    $template
                    && $this->templateContent->isEditable(
                        $template->slug
                    )
                ) {
                    $this->templateContent->createUserCopy($order);
                }
            }
        });

        return back()->with(
            'success',
            'Status pembayaran berhasil diperbarui.'
        );
    }
}