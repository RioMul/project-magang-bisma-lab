<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Template;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $website = config('website');
        
        $templates = Template::with([
            'type',
            'images' => function ($q) {
                $q->where('is_primary', true);
            }
        ])
            ->where('is_active', true)
            ->latest()
            ->get();

        $packages = Package::with('features')
            ->where('is_active', true)
            ->get();

        return view('landing', compact('website', 'templates', 'packages'));
    }

    public function templateDetail($slug)
    {
        $template = Template::with(['type', 'images', 'reviews.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('template_detail', compact('template'));
    }

    public function templatePreview($slug)
    {
        $template = Template::with('images')->where('slug', $slug)->firstOrFail();
        $heroImage = $template->images->where('is_primary', true)->first()?->image_path ?? 'jpg1.jpg';

        $templateData = [
            'business_name' => $template->name,
            'search_placeholder' => 'Cari produk di ' . $template->name . '...',
            'theme_color' => '#ee4d2d',
            'hero_description' => $template->description,
            'button_text' => 'Beli Sekarang',
            'hero_image' => $heroImage,
            'main_banner' => $heroImage
        ];

        return view('template.extemplate.ecommerce', compact('templateData', 'template'));
    }
}