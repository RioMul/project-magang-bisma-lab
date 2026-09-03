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
            ['name' => 'Company', 'slug' => 'company'],
            ['name' => 'UMKM', 'slug' => 'umkm'],
            ['name' => 'School', 'slug' => 'school'],
        ];

        $types = [];
        foreach ($categories as $cat) {
            $types[$cat['slug']] = TemplateType::firstOrCreate(['slug' => $cat['slug']], ['name' => $cat['name']])->id;
        }

        $templatesData = [
            ['type' => 'company', 'name' => 'Nexus Corporate', 'slug' => 'nexus', 'img' => 'tech1.png'],
            ['type' => 'umkm', 'name' => 'Artisan Bakehouse', 'slug' => 'artisan', 'img' => 'tech2.png'],
            ['type' => 'school', 'name' => 'Academia Plus', 'slug' => 'academia', 'img' => 'tech3.png'],
            ['type' => 'company', 'name' => 'Civic Connect', 'slug' => 'civic', 'img' => 'tech4.png'],
            ['type' => 'company', 'name' => 'Elite Counsel', 'slug' => 'elite', 'img' => 'tech5.png'],
            ['type' => 'umkm', 'name' => 'Studio Prisma', 'slug' => 'studio', 'img' => 'tech6.png'],
            ['type' => 'umkm', 'name' => 'Kopi Senja', 'slug' => 'kopi-senja', 'img' => 'tech7.png'],
            ['type' => 'umkm', 'name' => 'Fashion Store', 'slug' => 'fashion', 'img' => 'tech8.png'],
            ['type' => 'school', 'name' => 'EduLearn', 'slug' => 'edu-learn', 'img' => 'tech9.png'],
            ['type' => 'company', 'name' => 'Public Info', 'slug' => 'public-info', 'img' => 'tech10.png'],
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
                ['template_id' => $template->id, 'is_primary' => true],
                ['image_path' => $tmpl['img'], 'alt_text' => $tmpl['name'], 'sort_order' => 1]
            );

            TemplateReview::firstOrCreate(['template_id' => $template->id, 'user_id' => $userId, 'rating' => 5, 'comment' => 'Bagus!']);
        }

        $extCom = DB::table('domain_extensions')->insertGetId(['name' => 'Dot Com', 'extension' => '.com', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('domain_prices')->insert(['domain_extension_id' => $extCom, 'price' => 150000, 'billing_period' => 1, 'created_at'=>now(), 'updated_at'=>now()]);

        $features = [
            'Landing' => Feature::firstOrCreate(['name' => 'Single Landing Page']),
            'Domain' => Feature::firstOrCreate(['name' => 'Domain .com']),
            'Multi' => Feature::firstOrCreate(['name' => 'Multi Page Website']),
            'Seo' => Feature::firstOrCreate(['name' => 'SEO Friendly']),
            'BasicEcom' => Feature::firstOrCreate(['name' => 'Basic E-Commerce']),
            'Ecom' => Feature::firstOrCreate(['name' => 'Advanced E-Commerce']),
            'Payment' => Feature::firstOrCreate(['name' => 'Payment Integration']),
            'Priority' => Feature::firstOrCreate(['name' => 'Priority Support']),
            'Custom' => Feature::firstOrCreate(['name' => 'Custom Features']),
            'Dedicated' => Feature::firstOrCreate(['name' => 'Dedicated Support']),
        ];

        $pkgS = Package::firstOrCreate(['slug' => 'paket-s'], ['name' => 'Paket S', 'short_description' => 'Startup', 'price_monthly' => 99000, 'price_annually' => 99000, 'is_popular' => false]);
        $pkgM = Package::firstOrCreate(['slug' => 'paket-m'], ['name' => 'Paket M', 'short_description' => 'Professional', 'price_monthly' => 249000, 'price_annually' => 249000, 'is_popular' => true]);
        $pkgL = Package::firstOrCreate(['slug' => 'paket-l'], ['name' => 'Paket L', 'short_description' => 'Business', 'price_monthly' => 499000, 'price_annually' => 499000, 'is_popular' => false]);
        $pkgXL = Package::firstOrCreate(['slug' => 'paket-xl'], ['name' => 'Paket XL', 'short_description' => 'Enterprise', 'price_monthly' => 999000, 'price_annually' => 999000, 'is_popular' => false]);

        // Menyuntikkan semua fitur ke semua paket, tapi yang tidak didapat akan di set is_included = false
        $packages = [$pkgS, $pkgM, $pkgL, $pkgXL];
        foreach ($packages as $pkg) {
            $syncData = [];
            foreach ($features as $key => $feature) {
                $isIncluded = false;
                if ($pkg->slug === 'paket-s' && in_array($key, ['Landing', 'Domain'])) $isIncluded = true;
                if ($pkg->slug === 'paket-m' && in_array($key, ['Landing', 'Domain', 'Multi', 'Seo', 'BasicEcom'])) $isIncluded = true;
                if ($pkg->slug === 'paket-l' && in_array($key, ['Landing', 'Domain', 'Multi', 'Seo', 'BasicEcom', 'Ecom', 'Payment', 'Priority'])) $isIncluded = true;
                if ($pkg->slug === 'paket-xl') $isIncluded = true; // Dapat semua
                
                $syncData[$feature->id] = ['is_included' => $isIncluded];
            }
            $pkg->features()->sync($syncData);
        }
    }
}