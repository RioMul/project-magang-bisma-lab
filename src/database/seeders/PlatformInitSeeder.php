<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Package;
use App\Models\Template;
use App\Models\TemplateImage;
use App\Models\TemplateType;
use App\Models\TemplateReview;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PlatformInitSeeder extends Seeder
{
    public function run(): void
    {
        $userId = DB::table('users')->insertGetId([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $categories = [
            [
                'name' => 'Company',
                'slug' => 'company',
            ],
            [
                'name' => 'UMKM',
                'slug' => 'umkm',
            ],
            [
                'name' => 'School',
                'slug' => 'school',
            ],
        ];

        $types = [];
        foreach ($categories as $cat) {
            $types[$cat['slug']] = TemplateType::firstOrCreate(
                ['slug' => $cat['slug']], 
                ['name' => $cat['name']]
            )->id;
        }

        $templatesData = [
            [
                'type' => 'company',
                'name' => 'Nexus Corporate',
                'slug' => 'nexus',
                'img' => 'tech1.png'
            ],
            [
                'type' => 'umkm',
                'name' => 'Artisan Bakehouse',
                'slug' => 'artisan',
                'img' => 'tech2.png'
            ],
            [
                'type' => 'school',
                'name' => 'Academia Plus',
                'slug' => 'academia',
                'img' => 'tech3.png'
            ],
            [
                'type' => 'company',
                'name' => 'Civic Connect',
                'slug' => 'civic',
                'img' => 'tech4.png'
            ],
            [
                'type' => 'company',
                'name' => 'Elite Counsel',
                'slug' => 'elite',
                'img' => 'tech5.png'
            ],
            [
                'type' => 'umkm',
                'name' => 'Studio Prisma',
                'slug' => 'studio',
                'img' => 'tech6.png'
            ],
            [
                'type' => 'umkm',
                'name' => 'Kopi Senja',
                'slug' => 'kopi-senja',
                'img' => 'tech7.png'
            ],
            [
                'type' => 'umkm',
                'name' => 'Fashion Store',
                'slug' => 'fashion',
                'img' => 'tech8.png'
            ],
            [
                'type' => 'school',
                'name' => 'EduLearn',
                'slug' => 'edu-learn',
                'img' => 'tech9.png'
            ],
            [
                'type' => 'company',
                'name' => 'Public Info',
                'slug' => 'public-info',
                'img' => 'tech10.png'
            ],
        ];

        foreach ($templatesData as $tmpl) {
            $template = Template::firstOrCreate(
                ['slug' => $tmpl['slug']],
                [
                    'template_type_id' => $types[$tmpl['type']],
                    'name' => $tmpl['name'],
                    'description' => 'Desain website profesional modern.',
                    'demo_url' => 'https://demo.bismalabs.com/' . $tmpl['slug'],
                    'difficulty' => 'Medium',
                    'is_featured' => true,
                    'is_active' => true,
                ]
            );

            TemplateImage::firstOrCreate(
                [
                    'template_id' => $template->id,
                    'is_primary' => true
                ],
                [
                    'image_path' => '', // Dikosongkan agar memicu onerror
                    'alt_text' => $tmpl['name'],
                    'sort_order' => 1
                ]
            );

            TemplateReview::firstOrCreate([
                'template_id' => $template->id,
                'user_id' => $userId,
                'rating' => 5,
                'comment' => 'Template yang luar biasa!'
            ]);
        }

        $fLanding = Feature::firstOrCreate(['name' => 'Single Landing Page']);
        $fDomain = Feature::firstOrCreate(['name' => 'Domain .com']);
        $fEcom = Feature::firstOrCreate(['name' => 'E-Commerce Features']);
        $fMulti = Feature::firstOrCreate(['name' => 'Multi Page Website']);
        $fSeo = Feature::firstOrCreate(['name' => 'SEO Friendly']);
        $fBasicEcom = Feature::firstOrCreate(['name' => 'Basic E-Commerce']);
        $fPayment = Feature::firstOrCreate(['name' => 'Payment Integration']);
        $fPriority = Feature::firstOrCreate(['name' => 'Priority Support']);
        $fCustom = Feature::firstOrCreate(['name' => 'Custom Features']);
        $fDedicated = Feature::firstOrCreate(['name' => 'Dedicated Support']);
        $fServer = Feature::firstOrCreate(['name' => 'High Performance Server']);

        $pkgS = Package::firstOrCreate([
            'slug' => 'paket-s'
        ], [
            'name' => 'Paket S',
            'short_description' => 'Startup',
            'price_monthly' => 99000,
            'price_annually' => 99000,
            'is_popular' => false
        ]);

        $pkgM = Package::firstOrCreate([
            'slug' => 'paket-m'
        ], [
            'name' => 'Paket M',
            'short_description' => 'Professional',
            'price_monthly' => 249000,
            'price_annually' => 249000,
            'is_popular' => true
        ]);

        $pkgL = Package::firstOrCreate([
            'slug' => 'paket-l'
        ], [
            'name' => 'Paket L',
            'short_description' => 'Business',
            'price_monthly' => 499000,
            'price_annually' => 499000,
            'is_popular' => false
        ]);

        $pkgXL = Package::firstOrCreate([
            'slug' => 'paket-xl'
        ], [
            'name' => 'Paket XL',
            'short_description' => 'Enterprise',
            'price_monthly' => 999000,
            'price_annually' => 999000,
            'is_popular' => false
        ]);

        $pkgS->features()->syncWithoutDetaching([
            $fLanding->id => ['is_included' => true],
            $fDomain->id => ['is_included' => true],
            $fEcom->id => ['is_included' => false],
        ]);

        $pkgM->features()->syncWithoutDetaching([
            $fMulti->id => ['is_included' => true],
            $fSeo->id => ['is_included' => true],
            $fBasicEcom->id => ['is_included' => true],
        ]);

        $pkgL->features()->syncWithoutDetaching([
            $fEcom->id => ['is_included' => true],
            $fPayment->id => ['is_included' => true],
            $fPriority->id => ['is_included' => true],
        ]);

        $pkgXL->features()->syncWithoutDetaching([
            $fCustom->id => ['is_included' => true],
            $fDedicated->id => ['is_included' => true],
            $fServer->id => ['is_included' => true],
        ]);
    }
}