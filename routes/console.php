<?php

use App\Admin\Jobs\ContractPayment\ScanStatusDueReminder;
use App\Admin\Jobs\ContractPayment\ScanStatusLate;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

// Schedule::job(new ScanStatusLate)->daily();
Schedule::job(new ScanStatusLate)->everyMinute();

Schedule::job(new ScanStatusDueReminder)->everyMinute();
// Schedule::job(new ScanStatusDueReminder)->dailyAt('00:05');