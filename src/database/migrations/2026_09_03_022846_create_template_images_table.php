<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('template_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->string('alt_text')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('template_images');
    }
};