php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration.
     */
    public function up(): void
    {
        Schema::create('jadwal_kegiatan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kegiatan_id')
                ->constrained('kegiatan')
                ->cascadeOnDelete();

            // Nama hari: senin, selasa, dan seterusnya.
            $table->enum('hari', [
                'senin',
                'selasa',
                'rabu',
                'kamis',
                'jumat',
                'sabtu',
                'minggu',
            ]);

            $table->time('jam_mulai');

            $table->time('jam_selesai');

            // Apakah jadwal masih digunakan?
            $table->boolean('aktif')->default(true);

            $table->timestamps();

            // Mencegah jadwal identik tercatat dua kali.
            $table->unique(
                ['kegiatan_id', 'hari', 'jam_mulai'],
                'jadwal_kegiatan_unik'
            );
        });
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kegiatan');
    }
};