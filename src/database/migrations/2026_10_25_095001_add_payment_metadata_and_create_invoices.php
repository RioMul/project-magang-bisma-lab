<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->unique();
            $table->timestamp('paid_at')->nullable();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignUuid('order_id')
                ->unique()
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->string('invoice_number')->unique();
            $table->string('status')->default('pending');
            $table->string('currency', 3)->default('IDR');

            // Snapshot identitas pelanggan saat invoice dibuat.
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_whatsapp')->nullable();

            $table->decimal('subtotal', 12, 2);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2);

            $table->timestamp('issued_at');
            $table->timestamp('due_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        // Satu invoice per pesanan lama. Rinciannya memakai order_items.
        $orders = DB::table('orders')->orderBy('created_at')->get();

        foreach ($orders as $order) {
            $issuedAt = $order->created_at ?? now();

            DB::table('invoices')->insert([
                'order_id' => $order->id,
                'invoice_number' => 'INV-' . $order->order_number,
                'status' => $order->status,
                'currency' => 'IDR',
                'customer_name' => $order->customer_name,
                'customer_email' => $order->customer_email,
                'customer_whatsapp' => $order->customer_whatsapp,
                'subtotal' => $order->total_amount,
                'discount_amount' => 0,
                'tax_amount' => 0,
                'total_amount' => $order->total_amount,
                'issued_at' => $issuedAt,

                // Database lama tidak menyimpan tanggal jatuh tempo/lunas.
                'due_at' => null,
                'paid_at' => null,

                'created_at' => $issuedAt,
                'updated_at' => $order->updated_at ?? $issuedAt,
            ]);
        }
    }

    public function down(): void
    {
        throw new RuntimeException(
            'Rollback otomatis dinonaktifkan agar data transaksi dan invoice tidak terhapus.'
        );
    }
};