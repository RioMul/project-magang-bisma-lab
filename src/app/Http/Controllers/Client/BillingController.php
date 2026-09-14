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
            ->with(['package', 'payment', 'website'])
            ->latest()
            ->get();

        $latestOrder = $orders->first();

        return view('client.billing.index', [
            'orders' => $orders,
            'latestOrder' => $latestOrder,
        ]);
    }
}