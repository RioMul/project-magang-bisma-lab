<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with([
            'user',
            'template',
            'package',
            'payment',
        ])
            ->when(
                $request->search,
                function ($query, $search) {
                    $query->where(function ($query) use ($search) {
                        $query
                            ->where('order_number', 'like', "%{$search}%")
                            ->orWhere('customer_name', 'like', "%{$search}%")
                            ->orWhere('customer_email', 'like', "%{$search}%")
                            ->orWhere('domain_name', 'like', "%{$search}%");
                    });
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

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load([
            'user',
            'template',
            'package',
            'payment',
            'website',
        ]);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(
        Request $request,
        Order $order
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,paid,expired,cancelled',
            ],
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return back()->with(
            'success',
            'Status order berhasil diperbarui.'
        );
    }
}