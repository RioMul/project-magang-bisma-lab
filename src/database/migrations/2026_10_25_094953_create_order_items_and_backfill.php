<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignUuid('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->foreignId('template_id')
                ->constrained('templates')
                ->restrictOnDelete();

            $table->foreignId('package_id')
                ->constrained('packages')
                ->restrictOnDelete();

            $table->string('domain_name');

            // Snapshot harga pada saat transaksi.
            $table->decimal('template_price', 12, 2)->default(0);
            $table->decimal('package_price', 12, 2);
            $table->decimal('domain_price', 12, 2)->default(0);
            $table->unsignedSmallInteger('billing_period_months')->default(12);
            $table->decimal('subtotal', 12, 2);

            // Status domain berbeda dari status website.
            $table->string('domain_status')->nullable();
            $table->string('website_status')->default('pending');
            $table->timestamp('website_expires_at')->nullable();

            // Item baru yang merupakan perpanjangan menunjuk ke item awal.
            $table->foreignId('renewal_of_order_item_id')
                ->nullable()
                ->constrained('order_items')
                ->nullOnDelete();

            // Menandai rincian harga lama yang diperkirakan dari harga katalog.
            $table->boolean('price_breakdown_is_estimated')->default(false);

            $table->timestamps();
        });

        $orders = DB::table('orders')
            ->leftJoin('packages', 'orders.package_id', '=', 'packages.id')
            ->select(
                'orders.*',
                'packages.price_annually as current_annual_package_price'
            )
            ->orderBy('orders.created_at')
            ->get();

        foreach ($orders as $order) {
            $total = round((float) $order->total_amount, 2);
            $currentPackagePrice = max(
                0,
                round((float) ($order->current_annual_package_price ?? 0), 2)
            );

            $currentDomainPrice = $this->getCurrentDomainPrice(
                $order->domain_name
            );

            // Jika total lama sama dengan harga katalog saat ini, gunakan
            // kedua harga katalog. Jika tidak, pertahankan total lama persis:
            // harga paket dibatasi ke total, lalu domain menjadi sisanya.
            $catalogTotal = $currentDomainPrice === null
                ? null
                : round($currentPackagePrice + $currentDomainPrice, 2);

            if (
                $catalogTotal !== null
                && abs($catalogTotal - $total) < 0.01
            ) {
                $packagePrice = $currentPackagePrice;
                $domainPrice = $currentDomainPrice;
            } else {
                $packagePrice = min($currentPackagePrice, $total);
                $domainPrice = max(
                    0,
                    round($total - $packagePrice, 2)
                );
            }

            $legacyWebsite = DB::table('user_websites')
                ->where('order_id', $order->id)
                ->first();

            DB::table('order_items')->insert([
                'order_id' => $order->id,
                'template_id' => $order->template_id,
                'package_id' => $order->package_id,
                'domain_name' => $order->domain_name,

                // Checkout lama belum mengenakan harga template.
                'template_price' => 0,
                'package_price' => $packagePrice,
                'domain_price' => $domainPrice,
                'billing_period_months' => 12,
                'subtotal' => $total,

                // Status registrasi domain belum tercatat di sistem lama.
                'domain_status' => null,

                // Pindahkan status dan masa aktif dari user_websites jika ada.
                'website_status' => $legacyWebsite->status ?? 'pending',
                'website_expires_at' => $legacyWebsite->expires_at ?? null,

                'renewal_of_order_item_id' => null,
                'price_breakdown_is_estimated' => true,
                'created_at' => $order->created_at ?? now(),
                'updated_at' => $order->updated_at ?? now(),
            ]);
        }
    }

    private function getCurrentDomainPrice(?string $domain): ?float
    {
        if (!$domain) {
            return null;
        }

        $price = DB::table('domain_prices')
            ->join(
                'domain_extensions',
                'domain_prices.domain_extension_id',
                '=',
                'domain_extensions.id'
            )
            ->where('domain_prices.billing_period', 1)
            ->where('domain_extensions.is_active', true)
            ->whereRaw(
                "? LIKE CONCAT('%', domain_extensions.extension)",
                [$domain]
            )
            // Mengutamakan ekstensi terpanjang, misalnya .co.id daripada .id.
            ->orderByRaw('CHAR_LENGTH(domain_extensions.extension) DESC')
            ->value('domain_prices.price');

        return $price === null
            ? null
            : round((float) $price, 2);
    }

    public function down(): void
    {
        throw new RuntimeException(
            'Rollback otomatis dinonaktifkan agar item pesanan yang sudah disalin tidak terhapus.'
        );
    }
};