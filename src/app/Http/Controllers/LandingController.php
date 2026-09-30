<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Template;
use Illuminate\Support\Facades\File;

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

        $templates->each(function ($template) {
            $template->template_data = $this->getTemplateData(
                $template->slug
            );
        });

        $packages = Package::with('features')
            ->where('is_active', true)
            ->get();

        return view(
            'landing',
            compact('website', 'templates', 'packages')
        );
    }

    public function templateDetail($slug)
    {
        $template = Template::with([
            'type',
            'images',
            'reviews.user'
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        $templateData = $this->getTemplateData(
            $template->slug
        );

        return view(
            'template_detail',
            compact('template', 'templateData')
        );
    }

    public function templatePreview($slug)
    {
        $template = Template::with('images')
            ->where('slug', $slug)
            ->firstOrFail();

        $templateData = $this->getTemplateData(
            $template->slug
        );

        if (empty($templateData)) {
            $heroImage = $template->images
                ->where('is_primary', true)
                ->first()?->image_path ?? 'jpg1.jpg';

            $templateData = [
                'name' => $template->name,

                'header' => [
                    'site_name' => $template->name,
                    'logo_text' => strtoupper(
                        Str::limit($template->name, 10, '')
                    ),
                    'badge' => 'OFFICIAL',
                    'menu' => [
                        'Home',
                        'Products',
                        'About',
                        'Contact'
                    ],
                    'button_text' => 'Order Now',
                ],

                'body' => [
                    'hero_title' => $template->name,
                    'hero_highlight' => '',
                    'hero_description' => $template->description,
                    'hero_image' => $heroImage,
                    'button_text' => 'Beli Sekarang',
                    'categories' => [],
                    'products' => [],
                ],

                'sidebar' => [],
                'footer' => [],
                'seo' => [],
                'style' => [
                    'primary' => '#ee4d2d',
                    'secondary' => '#fff1ed',
                    'background' => '#f5f5f5',
                    'text' => '#1e293b',
                ],
            ];
        }

        return view(
            'template.extemplate.ecommerce',
            compact('template', 'templateData')
        );
    }

    private function getTemplateData(string $slug): array
    {
        $path = resource_path(
            'templates/' . $slug . '.json'
        );

        if (!File::exists($path)) {
            return [];
        }

        $content = File::get($path);

        if (!$content) {
            return [];
        }

        $data = json_decode($content, true);

        return is_array($data) ? $data : [];
    }
}