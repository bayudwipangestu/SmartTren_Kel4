<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sesi_presensi_id')
                ->constrained('sesi_presensi')
                ->cascadeOnDelete();

            $table->foreignId('mahasantri_id')
                ->constrained('mahasantri')
                ->cascadeOnDelete();

            $table->enum('status', [
                'hadir',
                'izin',
                'sakit',
                'alpa',
            ])->default('hadir');

            $table->text('keterangan')->nullable();

            $table->dateTime('waktu_presensi')->nullable();

            $table->timestamps();

            // Satu mahasantri hanya boleh memiliki
            // satu presensi pada satu sesi.
            $table->unique([
                'sesi_presensi_id',
                'mahasantri_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};