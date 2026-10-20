<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'status',
    ];

    public function sesiPresensi(): HasMany
    {
        return $this->hasMany(
            SesiPresensi::class,
            'kegiatan_id'
        );
    }

    public function jadwalKegiatan(): HasMany
    {
        return $this->hasMany(
            JadwalKegiatan::class,
            'kegiatan_id'
        );
    }
}