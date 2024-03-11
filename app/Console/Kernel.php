<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\generationsModel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('cars:checkrejected')->dailyAt('00:00');
        $schedule->call(function () {
            $currentYear = date('Y');
            generationsModel::where("generations", "like", "%ปัจจุบัน%")->update(["yearlast" => $currentYear]);
        })->yearly()->on(1, 1, '00:00:01');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
