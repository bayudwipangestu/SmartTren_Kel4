<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('presensi:generate-sesi')
    ->everyMinute()
    ->timezone('Asia/Jakarta');


Schedule::command('presensi:tutup-sesi')
    ->everyMinute()
    ->timezone('Asia/Jakarta');
