<?php

namespace Database\Seeders;

use App\Models\ServerPackage;
use App\Models\Template;
use Illuminate\Database\Seeder;

class PlatformInitSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Paket Server
        $packages = [
            [
                'name' => 'Paket S',
                'code' => 'S',
                'price' => 99000,
                'description' => 'Perfect for small portfolios and personal landing pages.',
                'features' => ['Single Landing Page', 'Domain .com (Free 1th)', 'E-commerce Features'],
                'is_popular' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Paket M',
                'code' => 'M',
                'price' => 249000,
                'description' => 'Complete toolkit for scaling businesses with custom branding and analytics.',
                'features' => ['Up to 5 Pages', 'Business Email (3)', 'Basic SEO Setup'],
                'is_popular' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Paket L',
                'code' => 'L',
                'price' => 499000,
                'description' => 'Perfect for growing businesses needing higher performance and integration.',
                'features' => ['Unlimited Pages', 'E-commerce Integration', 'Payment Gateway'],
                'is_popular' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Paket XL',
                'code' => 'XL',
                'price' => 999000,
                'description' => 'Full enterprise-grade infrastructure with dedicated support.',
                'features' => ['Custom Features', 'Dedicated Support', 'High Performance Server'],
                'is_popular' => false,
                'is_active' => true,
            ],
        ];

        foreach ($packages as $pkg) {
            ServerPackage::updateOrCreate(['code' => $pkg['code']], $pkg);
        }

        // 2. Data Template Menggunakan preview_image sesuai migrasi asli
        $templates = [
            [
                'name' => 'Nexus Corporate',
                'slug' => 'nexus-corporate',
                'category' => 'Company',
                'description' => 'Professional corporate website template.',
                'preview_image' => 'tech1.png',
                'demo_url' => '#',
                'setup_price' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Artisan Bakehouse',
                'slug' => 'artisan-bakehouse',
                'category' => 'UMKM',
                'description' => 'Warm and cozy website for culinary business.',
                'preview_image' => 'tech2.png',
                'demo_url' => '#',
                'setup_price' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Academia Plus',
                'slug' => 'academia-plus',
                'category' => 'School',
                'description' => 'Modern institutional design for schools and courses.',
                'preview_image' => 'tech3.png',
                'demo_url' => '#',
                'setup_price' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Civic Connect',
                'slug' => 'civic-connect',
                'category' => 'Government',
                'description' => 'Clean and structured layout for public services.',
                'preview_image' => 'tech4.png',
                'demo_url' => '#',
                'setup_price' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Elite Counsel',
                'slug' => 'elite-counsel',
                'category' => 'Company',
                'description' => 'Formal template for law firms and consulting.',
                'preview_image' => 'tech5.png',
                'demo_url' => '#',
                'setup_price' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Studio Prisma',
                'slug' => 'studio-prisma',
                'category' => 'Creative',
                'description' => 'Vibrant portfolio template for creative agencies.',
                'preview_image' => 'tech2.png',
                'demo_url' => '#',
                'setup_price' => 0,
                'is_active' => true,
            ],
        ];

        foreach ($templates as $tmpl) {
            Template::updateOrCreate(['slug' => $tmpl['slug']], $tmpl);
        }
    }
}