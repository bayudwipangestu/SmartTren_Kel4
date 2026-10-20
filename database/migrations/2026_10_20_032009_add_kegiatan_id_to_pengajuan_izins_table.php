
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_izins', function (Blueprint $table) {
            $table->foreignId('kegiatan_id')
                ->nullable()
                ->after('sesi_presensi_id')
                ->constrained('kegiatan')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_izins', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kegiatan_id');
        });
    }
};
