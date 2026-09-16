<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\UserWebsite;
use App\Models\WebsiteVisit;

class AnalyticsController extends Controller
{
    public function index()
    {
        $totalVisitors = WebsiteVisit::count();

        $uniqueVisitors = WebsiteVisit::distinct('ip_address')->count(
            'ip_address'
        );

        $activeWebsites = UserWebsite::where(
            'status',
            'active'
        )->count();

        $revenue = Order::where('status', 'paid')
            ->sum('total_amount');

        $visitorData = collect(range(27, 0))
            ->map(function ($days) {
                $date = now()->subDays($days);

                return [
                    'label' => $date->format('d M'),
                    'value' => WebsiteVisit::whereDate(
                        'created_at',
                        $date
                    )->count(),
                ];
            });

        return view('admin.analytics.index', compact(
            'totalVisitors',
            'uniqueVisitors',
            'activeWebsites',
            'revenue',
            'visitorData'
        ));
    }
}