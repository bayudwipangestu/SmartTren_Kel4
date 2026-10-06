<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Menjalankan seeder.
     */
    public function run(): void
    {
        $kegiatan = [
            [
                'nama_kegiatan' => 'Sholat Subuh',
                'deskripsi' => 'Presensi sholat Subuh berjamaah.',
                'status' => 'aktif',
            ],

            [
                'nama_kegiatan' => 'Sholat Magrib',
                'deskripsi' => 'Presensi sholat Magrib berjamaah.',
                'status' => 'aktif',
            ],

            [
                'nama_kegiatan' => 'Sholat Isya',
                'deskripsi' => 'Presensi sholat Isya berjamaah.',
                'status' => 'aktif',
            ],

            [
                'nama_kegiatan' => 'Ngaji Kitab',
                'deskripsi' => 'Presensi kegiatan ngaji kitab.',
                'status' => 'aktif',
            ],

            [
                'nama_kegiatan' => 'Roan',
                'deskripsi' => 'Presensi kegiatan roan/kebersihan.',
                'status' => 'aktif',
            ],
        ];

        foreach ($kegiatan as $item) {
            Kegiatan::updateOrCreate(
                [
                    'nama_kegiatan' => $item['nama_kegiatan'],
                ],
                $item
            );
        }
    }
}