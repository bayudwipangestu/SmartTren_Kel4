<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratIzin extends Model
{
    protected $fillable = [
        'user_id', 
        'jenis_izin', 
        'tanggal', 
        'keterangan', 
        'bukti_foto',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}