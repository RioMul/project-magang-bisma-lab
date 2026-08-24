<?php

namespace Database\Seeders;

use App\Models\ServerPackage;
use App\Models\Template;
use Illuminate\Database\Seeder;

class PlatformInitSeeder extends Seeder
{
    public function run(): void
    {
        Template::create([
            'name' => 'Nexus Corporate',
            'slug' => 'nexus-corporate',
            'category' => 'Company',
            'description' => 'Website profil perusahaan elegan dengan form kontak, katalog layanan, dan optimasi SEO.',
            'preview_image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&auto=format&fit=crop&q=80',
            'demo_url' => 'https://example.com/demo/company',
            'setup_price' => 175000,
            'is_active' => true,
        ]);

        Template::create([
            'name' => 'Artisan Bakehouse',
            'slug' => 'artisan-bakehouse',
            'category' => 'UMKM',
            'description' => 'Website landing page kafe & resto lengkap dengan buku menu digital dan pemesanan WhatsApp.',
            'preview_image' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600&auto=format&fit=crop&q=80',
            'demo_url' => 'https://example.com/demo/cafe',
            'setup_price' => 150000,
            'is_active' => true,
        ]);

        Template::create([
            'name' => 'Academia Plus',
            'slug' => 'academia-plus',
            'category' => 'School',
            'description' => 'Sistem portal sekolah modern dengan info kurikulum, kegiatan akademik, dan pengumuman.',
            'preview_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&auto=format&fit=crop&q=80',
            'demo_url' => 'https://example.com/demo/school',
            'setup_price' => 200000,
            'is_active' => true,
        ]);

        ServerPackage::create([
            'name' => 'Paket S',
            'cpu' => '1 vCPU',
            'ram' => '1 GB RAM',
            'storage' => '20 GB NVMe SSD',
            'bandwidth' => '1 TB Bandwidth',
            'price_per_month' => 45000,
            'is_active' => true,
        ]);

        ServerPackage::create([
            'name' => 'Paket M',
            'cpu' => '2 vCPU',
            'ram' => '2 GB RAM',
            'storage' => '40 GB NVMe SSD',
            'bandwidth' => '2 TB Bandwidth',
            'price_per_month' => 85000,
            'is_active' => true,
        ]);
    }
}