<?php

namespace Database\Seeders;

use App\Models\JadwalKegiatan;
use Illuminate\Database\Seeder;

class JadwalKegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $jadwalKegiatan = [
            1 => ['jam_mulai' => '04:00:00', 'jam_selesai' => '05:00:00'],
            2 => ['jam_mulai' => '18:00:00', 'jam_selesai' => '18:15:00'],
            3 => ['jam_mulai' => '19:00:00', 'jam_selesai' => '20:00:00'],
            4 => ['jam_mulai' => '18:15:00', 'jam_selesai' => '19:30:00'],
            5 => ['jam_mulai' => '06:00:00', 'jam_selesai' => '10:00:00'],
            6 => ['jam_mulai' => '05:00:00', 'jam_selesai' => '05:30:00'],
        ];

        $hariList = [
            'senin',
            'selasa',
            'rabu',
            'kamis',
            'jumat',
            'sabtu',
            'minggu',
        ];

        foreach ($jadwalKegiatan as $kegiatanId => $jam) {
            foreach ($hariList as $hari) {
                JadwalKegiatan::updateOrCreate(
                    [
                        'kegiatan_id' => $kegiatanId,
                        'hari' => $hari,
                        'jam_mulai' => $jam['jam_mulai'],
                    ],
                    [
                        'jam_selesai' => $jam['jam_selesai'],
                        'aktif' => true,
                    ]
                );
            }
        }

        $this->command->info(
            'Jadwal rutin berhasil diproses untuk 6 kegiatan selama 7 hari.'
        );
    }
}