<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\GetWeatherData::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('command:getweatherdata')->hourly(); // based on scheduled cronjob similar to: * * * * * cd <laravel-path> && php artisan schedule:run >> /dev/null 2>&1
        //$schedule->command('command:getweatherdata')->everyFiveMinutes(); // based on scheduled cronjob similar to: * * * * * cd <laravel-path> && php artisan schedule:run >> /dev/null 2>&1
        //$schedule->command('writetolog')->everyMinute();
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
