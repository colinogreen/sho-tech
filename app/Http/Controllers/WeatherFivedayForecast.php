<?php

namespace App\Http\Controllers;

use App\Library\WeatherDataForCity;
use App\Library\WeatherForecast;
use App\Console\Commands\GetWeatherData;

//use Illuminate\Http\Request;

class WeatherFivedayForecast extends Controller
{
    private $cityLatitudeAndLongitude = [];
    private $city_links =[];
    

    public function index()
    {

        //$weather_links = (new WeatherForecast)->getWeatherForecastCities();
        //return view("showcase_index", ["weather_links"=>$weather_links]); // Send the class and it's data to the view for processing

    }
    

}
