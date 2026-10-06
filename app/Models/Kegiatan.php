<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SesiPresensi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    /**
     * Nama tabel.
     */
    protected $table = 'kegiatan';

    /**
     * Kolom yang boleh diisi.
     */
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
}