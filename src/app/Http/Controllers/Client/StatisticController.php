<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\UserWebsite;
use App\Models\WebsiteVisit;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{
    public function index()
    {
        $website = UserWebsite::where('user_id', Auth::id())
            ->latest()
            ->first();

        $query = WebsiteVisit::query();

        if ($website) {
            $query->where('user_website_id', $website->id);
        } else {
            $query->whereRaw('1 = 0');
        }

        $visits = (clone $query)
            ->whereBetween('visited_at', [
                now()->subDays(29)->startOfDay(),
                now()->endOfDay(),
            ])
            ->get();

        $totalVisitors = $visits->count();

        $uniqueVisitors = $visits
            ->pluck('visitor_id')
            ->filter()
            ->unique()
            ->count();

        $bounceRate = 0;

        $averageSession = '0m 00s';

        $chart = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);

            $chart[] = [
                'label' => $date->format('d M'),
                'visitors' => $visits->whereBetween('visited_at', [
                    $date->copy()->startOfDay(),
                    $date->copy()->endOfDay(),
                ])->count(),
            ];
        }

        $topPages = $visits
            ->groupBy('page_path')
            ->map(function ($items, $path) {
                return [
                    'path' => $path ?: '/',
                    'views' => $items->count(),
                    'unique' => $items->pluck('visitor_id')->filter()->unique()->count(),
                ];
            })
            ->sortByDesc('views')
            ->take(10)
            ->values();

        $mobile = $visits->filter(function ($visit) {
            return preg_match('/mobile|android|iphone|ipad/i', $visit->user_agent ?? '');
        })->count();

        $desktop = max($totalVisitors - $mobile, 0);

        return view('client.statistics.index', compact(
            'totalVisitors',
            'uniqueVisitors',
            'bounceRate',
            'averageSession',
            'chart',
            'topPages',
            'mobile',
            'desktop'
        ));
    }
}