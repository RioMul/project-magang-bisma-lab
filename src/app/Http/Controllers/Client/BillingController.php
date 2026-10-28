<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with([
                'orderItems.package',
                'orderItems.template',
                'payment',
                'invoice',
            ])
            ->latest()
            ->get();

        $latestOrder = $orders->first();

        // Paket aktif ditentukan dari pesanan terakhir yang sudah dibayar.
        $currentOrder = $orders->firstWhere('status', 'paid')
            ?? $latestOrder;

        // Alur saat ini membuat satu item website untuk setiap pesanan.
        $currentOrderItem = $currentOrder?->orderItems->first();

        return view('client.billing.index', [
            'orders' => $orders,
            'latestOrder' => $latestOrder,
            'currentOrder' => $currentOrder,
            'currentOrderItem' => $currentOrderItem,
        ]);
    }
}