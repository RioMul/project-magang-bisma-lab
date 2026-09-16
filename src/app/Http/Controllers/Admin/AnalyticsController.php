<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserWebsite;
use App\Models\WebsiteVisit;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        $startDate = now()->subDays(29)->startOfDay();
        $endDate = now()->endOfDay();

        $visits = WebsiteVisit::query()
            ->whereBetween('visited_at', [$startDate, $endDate]);

        $totalVisitors = (clone $visits)->count();

        $uniqueVisitors = (clone $visits)
            ->whereNotNull('visitor_id')
            ->distinct('visitor_id')
            ->count('visitor_id');

        if ($uniqueVisitors === 0) {
            $uniqueVisitors = (clone $visits)
                ->whereNotNull('ip_address')
                ->distinct('ip_address')
                ->count('ip_address');
        }

        $activeWebsites = UserWebsite::query()
            ->where('status', 'active')
            ->count();

        $revenue = Order::query()
            ->where('status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_amount');

        $visitorData = collect(range(29, 0))
            ->map(function (int $days) {
                $date = now()->subDays($days);

                return [
                    'label' => $date->format('d M'),
                    'date' => $date->format('Y-m-d'),
                    'value' => WebsiteVisit::query()
                        ->whereDate('visited_at', $date)
                        ->count(),
                ];
            });

        $deviceData = $this->getDeviceData(
            (clone $visits)->get()
        );

        $trafficSources = $this->getTrafficSources(
            (clone $visits)->get()
        );

        $topContent = WebsiteVisit::query()
            ->whereBetween('visited_at', [$startDate, $endDate])
            ->selectRaw('page_path, COUNT(*) as pageviews')
            ->groupBy('page_path')
            ->orderByDesc('pageviews')
            ->limit(5)
            ->get();

        $bounceRate = null;
        $averageSession = null;

        return view('admin.analytics.index', compact(
            'totalVisitors',
            'uniqueVisitors',
            'activeWebsites',
            'revenue',
            'visitorData',
            'deviceData',
            'trafficSources',
            'topContent',
            'bounceRate',
            'averageSession',
            'startDate',
            'endDate'
        ));
    }

    private function getDeviceData($visits)
    {
        $mobile = 0;
        $desktop = 0;
        $tablet = 0;

        foreach ($visits as $visit) {
            $userAgent = strtolower($visit->user_agent ?? '');

            if (
                str_contains($userAgent, 'mobile')
                || str_contains($userAgent, 'android')
                || str_contains($userAgent, 'iphone')
            ) {
                $mobile++;
            } elseif (
                str_contains($userAgent, 'tablet')
                || str_contains($userAgent, 'ipad')
            ) {
                $tablet++;
            } else {
                $desktop++;
            }
        }

        $total = $mobile + $desktop + $tablet;

        return [
            'mobile' => [
                'count' => $mobile,
                'percentage' => $total > 0
                    ? round(($mobile / $total) * 100)
                    : 0,
            ],
            'desktop' => [
                'count' => $desktop,
                'percentage' => $total > 0
                    ? round(($desktop / $total) * 100)
                    : 0,
            ],
            'tablet' => [
                'count' => $tablet,
                'percentage' => $total > 0
                    ? round(($tablet / $total) * 100)
                    : 0,
            ],
        ];
    }

    private function getTrafficSources($visits)
    {
        $sources = [
            'Direct' => 0,
            'Search' => 0,
            'Social' => 0,
            'Referral' => 0,
        ];

        foreach ($visits as $visit) {
            $referer = strtolower($visit->referer ?? '');

            if ($referer === '') {
                $sources['Direct']++;
                continue;
            }

            if (
                str_contains($referer, 'google.')
                || str_contains($referer, 'bing.')
                || str_contains($referer, 'yahoo.')
            ) {
                $sources['Search']++;
                continue;
            }

            if (
                str_contains($referer, 'facebook.')
                || str_contains($referer, 'instagram.')
                || str_contains($referer, 'tiktok.')
                || str_contains($referer, 'twitter.')
                || str_contains($referer, 'x.com')
            ) {
                $sources['Social']++;
                continue;
            }

            $sources['Referral']++;
        }

        $total = array_sum($sources);

        return collect($sources)
            ->map(function ($count, $name) use ($total) {
                return [
                    'name' => $name,
                    'count' => $count,
                    'percentage' => $total > 0
                        ? round(($count / $total) * 100)
                        : 0,
                ];
            })
            ->values();
    }
}