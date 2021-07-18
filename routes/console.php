<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
//use App\Http\Controllers\WeatherFivedayForecast;
use App\Console\Commands\GetWeatherData;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('cachingtest', function () {
    (new GetWeatherData())->queryAPIOrGetDataMultiple();
})->purpose('Test the filling of the cache for api weather data processing');

