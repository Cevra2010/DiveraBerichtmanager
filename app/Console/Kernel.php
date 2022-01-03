<?php

namespace App\Console;

use App\Console\Commands\AutodeleteBerichteCommand;
use App\Console\Commands\CheckAlarmsCommand;
use App\Models\Bericht;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Zis\Ext\SettingsManager\Setting;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        CheckAlarmsCommand::class,
        AutodeleteBerichteCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('check_alarms')->everyMinute();
        $schedule->command('autodelete_berichte')->everyThirtyMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
