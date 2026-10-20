
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_izins', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mahasantri_id')
                ->constrained('mahasantri')
                ->cascadeOnDelete();

            $table->foreignId('sesi_presensi_id')
                ->nullable()
                ->constrained('sesi_presensi')
                ->nullOnDelete();

            $table->enum('jenis', ['izin', 'sakit']);
            $table->date('tanggal');
            $table->text('alasan');
            $table->string('bukti_foto')->nullable();

            $table->enum('status', [
                'menunggu',
                'disetujui',
                'ditolak',
            ])->default('menunggu');

            $table->text('catatan_pengurus')->nullable();
            $table->foreignId('diproses_oleh')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('diproses_pada')->nullable();
            $table->timestamps();

            $table->index(['tanggal', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_izins');
    }
};
