<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\TemplateContentService;
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
                'order.package',
                'order.website',
            ])
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = $request->input('search');

                    $query->whereHas('order', function ($query) use ($search) {
                        $query->where(function ($query) use ($search) {
                            $query
                                ->where('order_number', 'like', "%{$search}%")
                                ->orWhere('customer_name', 'like', "%{$search}%")
                                ->orWhere('customer_email', 'like', "%{$search}%")
                                ->orWhere('domain_name', 'like', "%{$search}%");
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
            $oldStatus = $payment->status;
            $newStatus = $validated['status'];

            $payment->update([
                'status' => $newStatus,
            ]);

            $orderStatus = match ($newStatus) {
                'paid' => 'paid',
                'failed' => 'failed',
                'expired' => 'expired',
                default => 'pending',
            };

            $payment->order()->update([
                'status' => $orderStatus,
            ]);

            if (
                $oldStatus !== 'paid' &&
                $newStatus === 'paid'
            ) {
                $order = $payment->order()
                    ->with('template')
                    ->first();

                if (
                    $order &&
                    $order->template &&
                    $this->templateContent->isEditable(
                        $order->template->slug
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