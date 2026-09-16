<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::with([
            'order.user',
            'order.package',
        ])
            ->when(
                $request->search,
                function ($query, $search) {
                    $query->whereHas(
                        'order',
                        function ($query) use ($search) {
                            $query
                                ->where('order_number', 'like', "%{$search}%")
                                ->orWhere('customer_name', 'like', "%{$search}%")
                                ->orWhere('customer_email', 'like', "%{$search}%");
                        }
                    );
                }
            )
            ->when(
                $request->status,
                fn ($query, $status) => $query->where(
                    'status',
                    $status
                )
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.billing.index', compact('payments'));
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

            $payment->update([
                'status' => $validated['status'],
            ]);

            if ($validated['status'] === 'paid') {
                $payment->order()->update([
                    'status' => 'paid',
                ]);
            }

            if (
                in_array(
                    $validated['status'],
                    ['failed', 'expired']
                )
            ) {
                $payment->order()->update([
                    'status' => $validated['status'],
                ]);
            }
        });

        return back()->with(
            'success',
            'Status pembayaran berhasil diperbarui.'
        );
    }
}