<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Template;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $templates = Template::with([
            'type', 
            'images' => function($q) {
                $q->where('is_primary', true);
            }
        ])->where('is_active', true)->get();

        $packages = Package::where('is_active', true)->get();

        return view('landing', compact('templates', 'packages'));
    }

    public function templateDetail($slug)
    {
        $template = Template::with(['type', 'images', 'reviews.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('template_detail', compact('template'));
    }
}