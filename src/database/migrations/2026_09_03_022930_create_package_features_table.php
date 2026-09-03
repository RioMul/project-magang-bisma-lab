<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('package_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            $table->foreignId('feature_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_included')->default(true);
            $table->string('limit_value')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('package_features');
    }
};