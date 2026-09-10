<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        // Data dummy untuk tabel halaman
        $pages = [
            ['id' => 1, 'name' => 'Galeri Produk', 'slug' => '/produk', 'updated_at' => 'Oct 24, 2023', 'status' => 'Published'],
            ['id' => 2, 'name' => 'Legalitas Usaha', 'slug' => '/legalitas', 'updated_at' => 'Nov 02, 2023', 'status' => 'Published'],
            ['id' => 3, 'name' => 'Layanan', 'slug' => '/layanan', 'updated_at' => 'Nov 15, 2023', 'status' => 'Draft'],
            ['id' => 4, 'name' => 'Contact', 'slug' => '/contact', 'updated_at' => 'Dec 01, 2023', 'status' => 'Published'],
        ];

        return view('client.pages.index', compact('pages'));
    }

    public function edit($id)
    {
        // Nantinya fetch data halaman berdasarkan ID
        $page = [
            'id' => $id,
            'name' => 'Galeri Produk',
            'slug' => 'galeri-produk',
            'status' => 'Draft',
            'visibility' => 'Public',
            'meta_title' => 'Mastering the Digital Atelier | Bisma Labs',
            'meta_description' => 'Learn how to craft a premium digital identity for your small business using the Bisma Labs page editor...'
        ];

        return view('client.pages.edit', compact('page'));
    }
}