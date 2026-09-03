<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_type_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('demo_url')->nullable();
            $table->string('difficulty')->default('Medium');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void {
        Schema::dropIfExists('templates');
    }
};