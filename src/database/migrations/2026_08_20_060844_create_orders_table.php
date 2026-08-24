<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('order_number')->unique();
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('template_id')->constrained()->cascadeOnDelete();
        $table->foreignId('server_package_id')->constrained()->cascadeOnDelete();
        $table->string('customer_name');
        $table->string('customer_email');
        $table->string('customer_whatsapp');
        $table->string('desired_domain');
        $table->decimal('total_amount', 12, 2);
        $table->enum('status', ['pending', 'paid', 'provisioning', 'active', 'cancelled'])->default('pending');
        $table->text('notes')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
