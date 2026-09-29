<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Template\TemplateContentService;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function __construct(
        private TemplateContentService $templateContent
    ) {}

    private function getActiveOrder(): ?Order
    {
        return $this->templateContent->getEditableOrder();
    }

    public function edit(Request $request)
    {
        $order = $this->getActiveOrder();

        if (!$order) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Edit Website hanya tersedia setelah pembayaran template yang mendukung editor berhasil diverifikasi.'
                );
        }

        $website = $this->templateContent->getUserWebsite($order);

        if (!$website) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Website Anda belum tersedia. Silakan tunggu proses aktivasi.'
                );
        }

        $tab = $request->get('tab', 'editor');
        $section = $request->get('section', 'header');

        return view(
            'client.website.edit',
            compact(
                'website',
                'order',
                'tab',
                'section'
            )
        );
    }

    public function update(Request $request)
    {
        $order = $this->getActiveOrder();

        if (!$order) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Anda belum memiliki website yang dapat diedit.'
                );
        }

        $website = $this->templateContent->getUserWebsite($order);

        if (!$website) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Data website belum tersedia.'
                );
        }

        $tab = $request->input('tab', 'editor');
        $section = $request->input('section', 'header');

        if ($tab === 'editor') {
            $this->updateEditor(
                $request,
                $website,
                $section
            );
        }

        if ($tab === 'seo') {
            $website['seo']['title'] = $request->input(
                'seo_title',
                $website['seo']['title'] ?? ''
            );

            $website['seo']['description'] = $request->input(
                'seo_description',
                $website['seo']['description'] ?? ''
            );

            if ($request->filled('seo_keywords')) {
                $website['seo']['keywords'] =
                    $request->input('seo_keywords');
            }
        }

        if ($tab === 'domain') {
            $website['domain']['name'] = $request->input(
                'domain_name',
                $website['domain']['name'] ?? ''
            );
        }

        $this->templateContent->saveUserWebsite(
            $order,
            $website
        );

        return redirect()
            ->route('client.website.edit', [
                'tab' => $tab,
                'section' => $section,
            ])
            ->with(
                'success',
                'Perubahan website berhasil disimpan.'
            );
    }

    private function updateEditor(
        Request $request,
        array &$website,
        string $section
    ): void {
        if ($section === 'header') {
            $website['header']['site_name'] =
                $request->input(
                    'site_name',
                    $website['header']['site_name'] ?? ''
                );

            $website['header']['logo_text'] =
                $request->input(
                    'logo_text',
                    $website['header']['logo_text'] ?? ''
                );

            $website['header']['badge'] =
                $request->input(
                    'badge',
                    $website['header']['badge'] ?? ''
                );

            $website['header']['button_text'] =
                $request->input(
                    'button_text',
                    $website['header']['button_text'] ?? ''
                );

            return;
        }

        if ($section === 'body') {
            $website['body']['hero_title'] =
                $request->input(
                    'hero_title',
                    $website['body']['hero_title'] ?? ''
                );

            $website['body']['hero_highlight'] =
                $request->input(
                    'hero_highlight',
                    $website['body']['hero_highlight'] ?? ''
                );

            $website['body']['hero_description'] =
                $request->input(
                    'hero_description',
                    $website['body']['hero_description'] ?? ''
                );

            $website['body']['button_text'] =
                $request->input(
                    'button_text',
                    $website['body']['button_text'] ?? ''
                );

            $website['body']['promo_title'] =
                $request->input(
                    'promo_title',
                    $website['body']['promo_title'] ?? ''
                );

            $website['body']['promo_description'] =
                $request->input(
                    'promo_description',
                    $website['body']['promo_description'] ?? ''
                );

            if ($request->filled('theme_primary')) {
                $website['style']['primary'] =
                    $request->input('theme_primary');
            }

            if ($request->hasFile('hero_image')) {
                $imagePath = $request
                    ->file('hero_image')
                    ->store('user_images', 'public');

                $website['body']['hero_image'] =
                    'storage/' . $imagePath;
            }

            return;
        }

        if ($section === 'sidebar') {
            $website['sidebar']['phone'] =
                $request->input(
                    'phone',
                    $website['sidebar']['phone'] ?? ''
                );

            $website['sidebar']['address'] =
                $request->input(
                    'address',
                    $website['sidebar']['address'] ?? ''
                );

            $website['sidebar']['whatsapp'] =
                $request->input(
                    'whatsapp',
                    $website['sidebar']['whatsapp'] ?? ''
                );

            $website['sidebar']['whatsapp_message'] =
                $request->input(
                    'whatsapp_message',
                    $website['sidebar']['whatsapp_message'] ?? ''
                );

            $website['sidebar']['social_instagram'] =
                $request->input(
                    'social_instagram',
                    $website['sidebar']['social_instagram'] ?? ''
                );

            return;
        }

        if ($section === 'footer') {
            $website['footer']['description'] =
                $request->input(
                    'footer_description',
                    $website['footer']['description'] ?? ''
                );

            $website['footer']['copyright'] =
                $request->input(
                    'copyright',
                    $website['footer']['copyright'] ?? ''
                );
        }
    }

    public function preview()
    {
        $order = $this->getActiveOrder();

        if (!$order) {
            abort(403);
        }

        $website = $this->templateContent->getUserWebsite($order);

        if (!$website) {
            abort(404);
        }

        return view(
            'client.template.partials.preview_layout',
            compact('website')
        );
    }
}