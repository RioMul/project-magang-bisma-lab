<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
    public function index(Request $request)
    {
        $website = config('website');

        $tab = $request->get('tab', 'editor');
        $section = $request->get('section', 'header');

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
            $validated = $request->validate([
                'site_name' => ['required', 'string', 'max:100'],
                'badge' => ['nullable', 'string', 'max:150'],
                'button_text' => ['nullable', 'string', 'max:100'],
                'button_link' => ['nullable', 'string', 'max:255'],

                'hero_title' => ['required', 'string', 'max:150'],
                'hero_highlight' => ['nullable', 'string', 'max:100'],
                'hero_description' => ['required', 'string', 'max:1000'],
                'hero_image' => ['nullable', 'image', 'max:4096'],

                'problem_1_title' => ['nullable', 'string', 'max:100'],
                'problem_1_description' => ['nullable', 'string', 'max:1000'],
                'problem_2_title' => ['nullable', 'string', 'max:100'],
                'problem_2_description' => ['nullable', 'string', 'max:1000'],
                'problem_3_title' => ['nullable', 'string', 'max:100'],
                'problem_3_description' => ['nullable', 'string', 'max:1000'],

                'solution_title' => ['nullable', 'string', 'max:150'],
                'solution_description' => ['nullable', 'string', 'max:1000'],

                'phone' => ['nullable', 'string', 'max:50'],
                'address' => ['nullable', 'string', 'max:255'],
                'whatsapp' => ['nullable', 'string', 'max:30'],
                'whatsapp_message' => ['nullable', 'string', 'max:255'],

                'footer_description' => ['nullable', 'string', 'max:500'],
                'copyright' => ['nullable', 'string', 'max:255'],

                'cta_title' => ['nullable', 'string', 'max:150'],
                'cta_description' => ['nullable', 'string', 'max:1000'],
                'cta_button_text' => ['nullable', 'string', 'max:100'],
            ]);

            $website['header']['site_name'] = $validated['site_name'];
            $website['header']['badge'] = $validated['badge'] ?? '';
            $website['header']['button_text'] = $validated['button_text'] ?? '';
            $website['header']['button_link'] = $validated['button_link'] ?? '';

            $website['body']['hero_title'] = $validated['hero_title'];
            $website['body']['hero_highlight'] = $validated['hero_highlight'] ?? '';
            $website['body']['hero_description'] = $validated['hero_description'];

            if ($request->hasFile('hero_image')) {
                $path = $request->file('hero_image')->store(
                    'website',
                    'public'
                );

                $website['body']['hero_image'] = 'storage/' . $path;
            }

            $website['body']['problem_1_title'] = $validated['problem_1_title'] ?? '';
            $website['body']['problem_1_description'] = $validated['problem_1_description'] ?? '';

            $website['body']['problem_2_title'] = $validated['problem_2_title'] ?? '';
            $website['body']['problem_2_description'] = $validated['problem_2_description'] ?? '';

            $website['body']['problem_3_title'] = $validated['problem_3_title'] ?? '';
            $website['body']['problem_3_description'] = $validated['problem_3_description'] ?? '';

            $website['body']['solution_title'] = $validated['solution_title'] ?? '';
            $website['body']['solution_description'] = $validated['solution_description'] ?? '';

            $website['body']['cta_title'] = $validated['cta_title'] ?? '';
            $website['body']['cta_description'] = $validated['cta_description'] ?? '';
            $website['body']['cta_button_text'] = $validated['cta_button_text'] ?? '';

            $website['sidebar']['phone'] = $validated['phone'] ?? '';
            $website['sidebar']['address'] = $validated['address'] ?? '';
            $website['sidebar']['whatsapp'] = $validated['whatsapp'] ?? '';
            $website['sidebar']['whatsapp_message'] = $validated['whatsapp_message'] ?? '';

            $website['footer']['description'] = $validated['footer_description'] ?? '';
            $website['footer']['copyright'] = $validated['copyright'] ?? '';
        }

        if ($tab === 'seo') {
            $validated = $request->validate([
                'seo_title' => ['required', 'string', 'max:160'],
                'seo_description' => ['required', 'string', 'max:320'],
                'seo_keywords' => ['nullable', 'string', 'max:500'],
                'og_image' => ['nullable', 'string', 'max:255'],
            ]);

            $website['seo']['title'] = $validated['seo_title'];
            $website['seo']['description'] = $validated['seo_description'];
            $website['seo']['keywords'] = $validated['seo_keywords'] ?? '';
            $website['seo']['og_image'] = $validated['og_image'] ?? '';
        }

        if ($tab === 'domain') {
            $validated = $request->validate([
                'domain_name' => ['required', 'string', 'max:255'],
                'domain_status' => ['required', 'string', 'max:50'],
            ]);

            $website['domain']['name'] = $validated['domain_name'];
            $website['domain']['status'] = $validated['domain_status'];
        }

        $this->writeConfig($website);

        return redirect()
            ->route('admin.websites.index', [
                'tab' => $tab,
                'section' => $section,
            ])
            ->with('success', 'Website settings berhasil disimpan.');
    }

    private function writeConfig(array $website): void
    {
        $path = config_path('website.php');

        $content = "<?php\n\nreturn " .
            var_export($website, true) .
            ";\n";

        file_put_contents($path, $content);

        Artisan::call('config:clear');
    }
}