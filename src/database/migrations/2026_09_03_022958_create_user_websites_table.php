<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_websites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('domain_name');
            $table->string('status')->default('building');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('user_websites');
    }
};