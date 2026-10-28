<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('templates', function (Blueprint $table) {
            // Nilai 0 berarti template gratis.
            $table->decimal('price', 12, 2)->default(0);
        });

        Schema::table('template_reviews', function (Blueprint $table) {
            $table->text('comment')->nullable()->change();

            $table->unique(
                ['user_id', 'template_id'],
                'template_reviews_user_template_unique'
            );
        });

        DB::statement(
            'ALTER TABLE template_reviews
             ADD CONSTRAINT template_reviews_rating_check
             CHECK (rating BETWEEN 1 AND 5)'
        );
    }

    public function down(): void
    {
        throw new RuntimeException(
            'Rollback otomatis dinonaktifkan untuk mencegah penghapusan data. Buat rollback manual setelah backup dan persetujuan.'
        );
    }
};