<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanIzin extends Model
{
    protected $table = 'pengajuan_izins';

    protected $fillable = [
        'mahasantri_id',
        'sesi_presensi_id',
        'kegiatan_id',
        'jenis',
        'tanggal',
        'alasan',
        'bukti_foto',
        'status',
        'catatan_pengurus',
        'diproses_oleh',
        'diproses_pada',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'diproses_pada' => 'datetime',
    ];

    public function mahasantri(): BelongsTo
    {
        return $this->belongsTo(Mahasantri::class);
    }

    public function sesiPresensi(): BelongsTo
    {
        return $this->belongsTo(SesiPresensi::class);
    }

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function pemroses(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diproses_oleh');
    }
}
