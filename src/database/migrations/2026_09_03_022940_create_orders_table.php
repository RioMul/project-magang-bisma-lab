<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('template_id')->constrained()->cascadeOnDelete();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_whatsapp')->nullable();
            $table->string('domain_name');
            $table->decimal('total_amount', 12, 2);
            $table->string('payment_method');
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void {
        Schema::dropIfExists('orders');
    }
};