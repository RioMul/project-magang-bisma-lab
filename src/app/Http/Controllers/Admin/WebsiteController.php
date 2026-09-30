<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class WebsiteController extends Controller
{
    public function index(Request $request)
    {
        $website = config('website');

        $tab = $request->get('tab', 'editor');
        $section = $request->get('section', 'header');

        $allowedTabs = ['editor', 'seo', 'domain'];

        if (!in_array($tab, $allowedTabs, true)) {
            $tab = 'editor';
        }

        $allowedSections = ['header', 'body', 'sidebar', 'footer'];

        if (!in_array($section, $allowedSections, true)) {
            $section = 'header';
        }

        return view('admin.websites.index', compact(
            'website',
            'tab',
            'section'
        ));
    }

    public function update(Request $request)
    {
        $website = config('website');

        $tab = $request->input('tab', 'editor');
        $section = $request->input('section', 'header');

        if ($tab === 'editor') {
            if ($section === 'header') {
                $website['header']['site_name'] = $request->input(
                    'site_name',
                    $website['header']['site_name'] ?? ''
                );

                $website['header']['badge'] = $request->input(
                    'badge',
                    $website['header']['badge'] ?? ''
                );

                $website['header']['button_text'] = $request->input(
                    'button_text',
                    $website['header']['button_text'] ?? ''
                );

                $website['header']['button_link'] = $request->input(
                    'button_link',
                    $website['header']['button_link'] ?? ''
                );
            }

            if ($section === 'body') {
                $bodyFields = [
                    'hero_title',
                    'hero_highlight',
                    'hero_description',
                    'problem_1_title',
                    'problem_1_description',
                    'problem_2_title',
                    'problem_2_description',
                    'problem_3_title',
                    'problem_3_description',
                    'solution_title',
                    'solution_description',
                    'cta_title',
                    'cta_description',
                    'cta_button_text',
                ];

                foreach ($bodyFields as $field) {
                    if ($request->has($field)) {
                        $website['body'][$field] = $request->input($field);
                    }
                }

                if ($request->hasFile('hero_image')) {
                    $image = $request->file('hero_image');

                    if ($image->isValid()) {
                        $imagePath = $image->store(
                            'website',
                            'public'
                        );

                        $website['body']['hero_image'] =
                            'storage/' . $imagePath;
                    }
                }
            }

            if ($section === 'sidebar') {
                $sidebarFields = [
                    'phone',
                    'address',
                    'whatsapp',
                    'whatsapp_message',
                ];

                foreach ($sidebarFields as $field) {
                    if ($request->has($field)) {
                        $website['sidebar'][$field] =
                            $request->input($field);
                    }
                }
            }

            if ($section === 'footer') {
                if ($request->has('footer_description')) {
                    $website['footer']['description'] =
                        $request->input('footer_description');
                }

                if ($request->has('copyright')) {
                    $website['footer']['copyright'] =
                        $request->input('copyright');
                }
            }
        }

        if ($tab === 'seo') {
            $seoFields = [
                'title' => 'seo_title',
                'description' => 'seo_description',
                'keywords' => 'seo_keywords',
                'og_image' => 'og_image',
            ];

            foreach ($seoFields as $configKey => $requestKey) {
                if ($request->has($requestKey)) {
                    $website['seo'][$configKey] =
                        $request->input($requestKey);
                }
            }
        }

        if ($tab === 'domain') {
            if ($request->has('domain_name')) {
                $website['domain']['name'] =
                    $request->input('domain_name');
            }

            if ($request->has('domain_status')) {
                $website['domain']['status'] =
                    $request->input('domain_status');
            }
        }

        $configPath = config_path('website.php');

        $configContent =
            "<?php\n\nreturn " .
            var_export($website, true) .
            ";\n";

        file_put_contents(
            $configPath,
            $configContent
        );

        config([
            'website' => $website
        ]);

        Artisan::call('config:clear');

        return redirect()
            ->route('admin.websites.index', [
                'tab' => $tab,
                'section' => $section,
            ])
            ->with(
                'success',
                'Website berhasil diperbarui.'
            );
    }
}