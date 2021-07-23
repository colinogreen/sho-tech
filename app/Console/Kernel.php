<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\GetWeatherData;

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
        if(!env('APP_DEBUG'))
        {
            // Every x hours on live installation.
            //$schedule->command('command:getweatherdata')->everySixHours();
            //$schedule->command('command:getweatherdata')->everyTwoHours();
            $schedule->command('command:getweatherdata')->cron('0 0,6,12,18 * * *');
            //$schedule->command('command:getweatherdata')->hourly();
        }
        else
        {
            // When in debug/dev mode.
            //\Log::debug("Cache length hours: ".GetWeatherData::getCacheLengthHours());
            //\Log::debug("Cache length seconds: ".GetWeatherData::getCacheLengthSeconds());
            $past_the_hour = [58, 59, 0, 1, 3]; // Array of minutes past the hour to run the command/task
            $int = $past_the_hour[rand(0,(count($past_the_hour)-1))]; // pick a minute past the hour from the available array at random
            $schedule->command('command:getweatherdata')->hourlyAt($int); // based on scheduled cronjob similar to: * * * * * cd <laravel-path> && php artisan schedule:run >> /dev/null 2>&1            
        }

        //$schedule->command('command:getweatherdata')->everyTwoHours();
        //$schedule->command('command:getweatherdata')->everyFiveMinutes();

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
