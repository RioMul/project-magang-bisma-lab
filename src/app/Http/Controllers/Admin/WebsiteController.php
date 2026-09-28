<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserWebsite;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(Request $request)
    {
        $totalWebsites = UserWebsite::count();

        $activeWebsites = UserWebsite::whereIn('status', [
            'active',
            'published',
        ])->count();

        $buildingWebsites = UserWebsite::whereIn('status', [
            'building',
            'pending',
        ])->count();

        $expiredWebsites = UserWebsite::where('status', 'expired')
            ->count();

        $websites = UserWebsite::query()
            ->with([
                'order.user',
                'order.template',
                'order.package',
            ])
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = $request->input('search');

                    $query->where(function ($query) use ($search) {

                        $query->where(
                            'domain_name',
                            'like',
                            "%{$search}%"
                        );

                        $query->orWhereHas(
                            'order.user',
                            function ($query) use ($search) {
                                $query
                                    ->where('name', 'like', "%{$search}%")
                                    ->orWhere('email', 'like', "%{$search}%");
                            }
                        );

                    });
                }
            )
            ->when(
                $request->filled('status'),
                function ($query) use ($request) {
                    $query->where(
                        'status',
                        $request->input('status')
                    );
                }
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.websites.index', compact(
            'websites',
            'totalWebsites',
            'activeWebsites',
            'buildingWebsites',
            'expiredWebsites'
        ));
    }
}