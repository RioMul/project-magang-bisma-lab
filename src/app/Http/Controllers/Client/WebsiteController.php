<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;

class WebsiteController extends Controller
{
    private function getUserJsonPath($order)
    {
        return 'user_websites/user_' . Auth::id() . '_' . $order->order_number . '.json';
    }

    public function edit(Request $request)
    {
        $order = Order::where('user_id', Auth::id())
            ->whereIn('status', ['paid', 'pending'])
            ->latest()
            ->first();

        if (!$order) {
            return redirect()->route('dashboard')->with('error', 'Anda belum memiliki website aktif.');
        }

        $path = $this->getUserJsonPath($order);

        // Kloning otomatis dari config Master jika JSON user belum ada
        if (!Storage::disk('local')->exists($path)) {
            $website = config('website');
            Storage::disk('local')->put($path, json_encode($website, JSON_PRETTY_PRINT));
        } else {
            $website = json_decode(Storage::disk('local')->get($path), true);
        }

        $tab = $request->get('tab', 'editor');
        $section = $request->get('section', 'header');

        return view('client.template.edit', compact('website', 'order', 'tab', 'section'));
    }

    public function update(Request $request)
    {
        $order = Order::where('user_id', Auth::id())
            ->whereIn('status', ['paid', 'pending'])
            ->latest()
            ->first();

        if (!$order) return back()->with('error', 'Pesanan tidak ditemukan.');

        $path = $this->getUserJsonPath($order);
        $website = Storage::disk('local')->exists($path) ? json_decode(Storage::disk('local')->get($path), true) : config('website');

        $tab = $request->input('tab', 'editor');
        $section = $request->input('section', 'header');

        if ($tab === 'editor') {
            if ($section === 'header') {
                $website['header']['site_name'] = $request->input('site_name');
                $website['header']['button_text'] = $request->input('button_text');
            } elseif ($section === 'body') {
                $website['body']['hero_title'] = $request->input('hero_title');
                $website['body']['hero_description'] = $request->input('hero_description');
                $website['body']['theme_color'] = $request->input('theme_color');
                $website['body']['button_text'] = $request->input('button_text');

                if ($request->hasFile('hero_image')) {
                    $imagePath = $request->file('hero_image')->store('user_images', 'public');
                    $website['body']['hero_image'] = 'storage/' . $imagePath;
                }
            }
        } elseif ($tab === 'seo') {
            $website['seo']['title'] = $request->input('seo_title');
            $website['seo']['description'] = $request->input('seo_description');
        } elseif ($tab === 'domain') {
            $website['domain']['name'] = $request->input('domain_name');
        }

        Storage::disk('local')->put($path, json_encode($website, JSON_PRETTY_PRINT));

        return redirect()->route('client.website.edit', ['tab' => $tab, 'section' => $section])->with('success', 'Website berhasil diperbarui.');
    }

    public function preview()
    {
        $order = Order::where('user_id', Auth::id())->whereIn('status', ['paid', 'pending'])->latest()->first();
        if (!$order) abort(404);

        $path = $this->getUserJsonPath($order);
        $website = Storage::disk('local')->exists($path) ? json_decode(Storage::disk('local')->get($path), true) : config('website');

        // Mengarahkan ke lokasi file preview_layout di dalam folder partials
        return view('client.template.partials.preview_layout', compact('website'));
    }
}