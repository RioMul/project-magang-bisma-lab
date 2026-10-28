<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('is_admin', false)->count();

        $activeWebsites = OrderItem::where('website_status', 'active')
            ->count();

        $monthlyRevenue = Order::where('status', 'paid')
            ->whereBetween('created_at', [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ])
            ->sum('total_amount');

        $expiredOrders = OrderItem::where('website_status', 'expired')
            ->count();

        $recentOrders = Order::with([
            'user',
            'orderItems.package',
            'orderItems.template',
        ])
            ->latest()
            ->limit(5)
            ->get();

        $recentOrders->each(function (Order $order) {
            $item = $order->orderItems->first();

            if (!$item) {
                return;
            }

            $order->setRelation('package', $item->package);
            $order->setRelation('template', $item->template);
            $order->setAttribute('domain_name', $item->domain_name);
        });

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