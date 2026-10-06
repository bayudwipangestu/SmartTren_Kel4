<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasantri', function (Blueprint $table) {
            $table->id();

            // Terhubung ke akun users
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('nim', 30)->unique();
            $table->string('nama', 100);

            $table->enum('jenis_kelamin', ['L', 'P']);

            $table->string('kamar', 50);

            $table->string('no_hp', 20)->nullable();

            // ID yang digunakan untuk QR Code
            $table->string('qr_code', 100)->unique();

            $table->enum('status', ['aktif', 'nonaktif'])
                ->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasantri');
    }
};