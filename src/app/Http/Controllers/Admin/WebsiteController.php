<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserWebsite;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(Request $request)
    {
        $websites = UserWebsite::with([
            'order.user',
            'order.template',
            'order.package',
        ])
            ->when(
                $request->search,
                function ($query, $search) {
                    $query->where('domain', 'like', "%{$search}%");
                }
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.websites.index', compact('websites'));
    }
}