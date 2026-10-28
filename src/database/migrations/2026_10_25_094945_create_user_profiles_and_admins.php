<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // Salin akun admin dan hash password-nya.
        // Baris lama di users tetap dipertahankan.
        $admins = DB::table('users')
            ->where('is_admin', true)
            ->get([
                'id',
                'name',
                'email',
                'password',
                'created_at',
                'updated_at',
            ]);

        foreach ($admins as $admin) {
            DB::table('admins')->insert([
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'password' => $admin->password,
                'created_at' => $admin->created_at ?? now(),
                'updated_at' => $admin->updated_at ?? now(),
            ]);
        }
    }

    public function down(): void
    {
        throw new RuntimeException(
            'Rollback otomatis dinonaktifkan untuk mencegah penghapusan akun atau profil.'
        );
    }
};