<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function edit()
    {
        // Nantinya data ini diambil dari model UserWebsite / Order
        $websiteData = [
            'business_name' => 'Bisma Labs',
            'description' => 'We build premium digital experiences for local artisans and craftsmens. Our atelier approach ensures every pixel is intentional.',
            'phone' => '+1 (555) 000-0000',
            'address' => '123 Artisan Way, Creative District'
        ];

        return view('client.website.edit', compact('websiteData'));
    }

    public function update(Request $request)
    {
        // Validasi dan update ke database nantinya dilakukan di sini
        return back()->with('success', 'Pengaturan website berhasil disimpan.');
    }
}