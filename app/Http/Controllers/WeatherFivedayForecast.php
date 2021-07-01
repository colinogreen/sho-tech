<?php

namespace App\Http\Controllers;

use App\Library\WeatherDataForCity;
use App\Console\Commands\GetWeatherData;

//use Illuminate\Http\Request;

class WeatherFivedayForecast extends Controller
{
    
    public function index()
    {
        $getWeatherData = new GetWeatherData();
        $cityWeather = new WeatherDataForCity($getWeatherData->getDataFromCache());

        return view("weather_index", ["cityWeather"=> $cityWeather]); // Send the class and it's data to the view for processing

    }
    /**
     * Log a message in laravel.log if .env APP_DEBUG=true.
     * Static for easy use by any class.
     * @param string $msg
     */
    public static function logMessage(string $msg)
    {
        if(env('APP_DEBUG'))
        {
           \Log::debug($msg); 
        }
    }
}
