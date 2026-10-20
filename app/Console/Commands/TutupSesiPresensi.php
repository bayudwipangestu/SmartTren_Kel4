<?php

namespace App\Console\Commands;

use App\Models\SesiPresensi;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TutupSesiPresensi extends Command
{
    protected $signature = 'presensi:tutup-sesi';

    protected $description = 'Menutup sesi presensi yang sudah melewati waktu selesai';

    public function handle(): int
    {
        $sekarang = Carbon::now('Asia/Jakarta');
        $jumlahDitutup = 0;

        $sesiAktif = SesiPresensi::where('status', 'aktif')
            ->whereDate('tanggal', '<=', $sekarang->toDateString())
            ->get();

        foreach ($sesiAktif as $sesi) {
            $waktuSelesai = Carbon::parse(
                $sesi->tanggal->toDateString() . ' ' . $sesi->jam_selesai,
                'Asia/Jakarta'
            );

            if ($sekarang->greaterThanOrEqualTo($waktuSelesai)) {
                $sesi->update([
                    'status' => 'selesai',
                ]);

                $jumlahDitutup++;
            }
        }

        $this->info("Sesi yang ditutup: {$jumlahDitutup}");

        return self::SUCCESS;
    }
}
