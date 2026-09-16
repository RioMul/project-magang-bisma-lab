<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use App\Models\UserWebsite;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('is_admin', false)->count();

        $activeWebsites = UserWebsite::where('status', 'active')->count();

        $monthlyRevenue = Order::where('status', 'paid')
            ->whereBetween('created_at', [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ])
            ->sum('total_amount');

        $expiredOrders = Order::where('status', 'expired')->count();

        $recentOrders = Order::with([
            'user',
            'package',
        ])
            ->latest()
            ->limit(8)
            ->get();

        $paidOrders = Order::where('status', 'paid')->count();

        $pendingOrders = Order::where('status', 'pending')->count();

        $monthlyUsers = User::where('is_admin', false)
            ->whereBetween('created_at', [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ])
            ->count();

        $revenueData = collect(range(5, 0))
            ->map(function (int $month) {
                $date = now()->subMonths($month);

                return [
                    'label' => $date->format('M'),
                    'value' => Order::where('status', 'paid')
                        ->whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->sum('total_amount'),
                ];
            });

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeWebsites',
            'monthlyRevenue',
            'expiredOrders',
            'recentOrders',
            'paidOrders',
            'pendingOrders',
            'monthlyUsers',
            'revenueData'
        ));
    }
}