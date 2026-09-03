<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('domain_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_extension_id')->constrained()->cascadeOnDelete();
            $table->decimal('price', 12, 2);
            $table->integer('billing_period');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('domain_prices');
    }
};