<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';

    protected $fillable = [
        'sesi_presensi_id',
        'mahasantri_id',
        'status',
        'keterangan',
        'waktu_presensi',
    ];

    protected function casts(): array
    {
        return [
            'waktu_presensi' => 'datetime',
        ];
    }

    public function sesiPresensi(): BelongsTo
    {
        return $this->belongsTo(
            SesiPresensi::class,
            'sesi_presensi_id'
        );
    }

    public function mahasantri(): BelongsTo
    {
        return $this->belongsTo(
            Mahasantri::class,
            'mahasantri_id'
        );
    }
}