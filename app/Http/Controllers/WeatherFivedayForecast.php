<?php

namespace App\Http\Controllers;

use App\Library\WeatherDataForCity;
use App\Console\Commands\GetWeatherData;

//use Illuminate\Http\Request;

class WeatherFivedayForecast extends Controller
{
    
    public function index()
    {
        //print("Debug: env('APP_DEBUG'): ". env('APP_DEBUG'));
        //$getWeatherData = new GetWeatherData();
        //$cityWeather = new WeatherDataForCity($getWeatherData->getDataFromCache());

        //return view("weather_index", ["cityWeather"=> $cityWeather]); // Send the class and it's data to the view for processing
        return view("weather_index", []); // Send the class and it's data to the view for processing

    }
    
    /**
     * Just get json data for React.js, etc.
     * @return WeatherDataForCity
     */
    public function data()
    {
        $getWeatherData = new GetWeatherData();
        $cityWeather = new WeatherDataForCity($getWeatherData->getDataFromCache());
        //exit("<pre>". print_r(json_decode($getWeatherData->getDataFromCache()), true)."</pre>");
        //exit("<pre>". print_r($getWeatherData->getDataFromCache(), true)."</pre>");
        $data = new \stdClass;
        $data->api_query = new \stdClass;
        $data->api_query->last_api_update = $cityWeather->getLastApiUpdate();
        $data->api_query->last_forecast_update = $cityWeather->getDailyForecastLastUpdate();
        $data->api_query->location = $cityWeather->getLocation();
        //$data->api_query->location = "Feeblesticks";
        $data->api_query->day = [];
        for($i = 0; $i<6;$i++)
        {
            $data->api_query->day[$i] = new \stdClass;

            $data->api_query->day[$i]->day_of_week = $cityWeather->getDayOfWeek($i);
            $data->api_query->day[$i]->day_weather_desc = $cityWeather->getDaySignificantWeatherDesc($i);
            $data->api_query->day[$i]->day_weather_icon = $cityWeather->getDaySignificantWeatherIcon($i);
            $data->api_query->day[$i]->day_highest_temp = $cityWeather->getDayHighestTemp($i);
            $data->api_query->day[$i]->day_lowest_temp = $cityWeather->getDayLowestTemp($i);
            $data->api_query->day[$i]->day_chance_rain = $cityWeather->getDayChanceOfRain($i);
            $data->api_query->day[$i]->day_wind_mph = $cityWeather->getDayWindSpeed($i);
            $data->api_query->day[$i]->max_uv_index = $cityWeather->getDayMaxUvIndex($i);
            $data->api_query->day[$i]->max_feels_like_temp = $cityWeather->getDayMaxFeelsLikeTemp($i);
        }
        //exit("Data:<pre>". print_r($data, true)."</pre>");
        return json_encode($data);
        //return $getWeatherData->getDataFromCache();
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
