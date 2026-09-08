<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['template', 'package', 'website'])
            ->latest()
            ->get();

        $latestOrder = $orders->first();

        return view('dashboard', compact(
            'orders',
            'latestOrder'
        ));
    }
}