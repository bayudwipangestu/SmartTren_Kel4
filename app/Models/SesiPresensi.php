<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SesiPresensi extends Model
{
    use HasFactory;

    protected $table = 'sesi_presensi';

    protected $fillable = [
        'kegiatan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    /**
     * Sesi presensi milik satu kegiatan.
     */
    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(
            Kegiatan::class,
            'kegiatan_id'
        );
    }

    /**
     * Satu sesi presensi memiliki banyak data presensi.
     */
    public function presensi(): HasMany
    {
        return $this->hasMany(
            Presensi::class,
            'sesi_presensi_id'
        );
    }
}