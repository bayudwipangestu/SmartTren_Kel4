<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Presensi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mahasantri extends Model
{
    use HasFactory;

    protected $table = 'mahasantri';

    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'jenis_kelamin',
        'kamar',
        'no_hp',
        'qr_code',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function presensi(): HasMany
{
    return $this->hasMany(
        Presensi::class,
        'mahasantri_id'
    );
}
}