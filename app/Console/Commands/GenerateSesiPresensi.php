<?php

namespace App\Console\Commands;

use App\Models\JadwalKegiatan;
use App\Models\SesiPresensi;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class GenerateSesiPresensi extends Command
{
    protected $signature = 'presensi:generate-sesi';

    protected $description = 'Membuat sesi presensi berdasarkan jadwal rutin';

    public function handle(): int
    {
        $sekarang = Carbon::now('Asia/Jakarta');

        $hariIndonesia = [
            1 => 'senin',
            2 => 'selasa',
            3 => 'rabu',
            4 => 'kamis',
            5 => 'jumat',
            6 => 'sabtu',
            7 => 'minggu',
        ];

        $hari = $hariIndonesia[$sekarang->dayOfWeekIso];
        $tanggal = $sekarang->toDateString();

        $jadwalList = JadwalKegiatan::query()
            ->where('aktif', true)
            ->where('hari', $hari)
            ->whereHas('kegiatan', function ($query) {
                $query->where('status', 'aktif');
            })
            ->get();

        $jumlahDibuat = 0;

        foreach ($jadwalList as $jadwal) {
            $sesi = SesiPresensi::firstOrCreate(
                [
                    'kegiatan_id' => $jadwal->kegiatan_id,
                    'tanggal' => $tanggal,
                    'jam_mulai' => $jadwal->jam_mulai,
                ],
                [
                    'jam_selesai' => $jadwal->jam_selesai,
                    'status' => 'aktif',
                ]
            );

            if ($sesi->wasRecentlyCreated) {
                $jumlahDibuat++;
            }
        }

        $this->info("Tanggal: {$tanggal}");
        $this->info("Hari: {$hari}");
        $this->info("Sesi baru dibuat: {$jumlahDibuat}");

        return self::SUCCESS;
    }
}
