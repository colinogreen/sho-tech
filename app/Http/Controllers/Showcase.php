<?php

namespace App\Http\Controllers;

use App\Library\WeatherForecast;
use Illuminate\Http\Request;

class Showcase extends Controller
{
    
    private $weatherForecast;
    
    public function index()
    {
        //print("Debug: env('APP_DEBUG'): ". env('APP_DEBUG'));
        //$getWeatherData = new GetWeatherData();
        //$cityWeather = new WeatherDataForCity($getWeatherData->getDataFromCache());
        
        //return view("weather_index", ["cityWeather"=> $cityWeather]); // Send the class and it's data to the view for processing
        //$weather_links = $this->getWeatherForecastCities();
        return view("showcase_index", ["indexcontent"=>"general"]); // Send the class and it's data to the view for processing
    }    
    
    public function indexWeatherWithCity($city)
    {
        return view("weather_city", ["city" => $city]); // Send the class and it's data to the view for processing
    }
    public function indexWeather()
    {
        $weather_links = $this->getWeatherForecast()->getWeatherForecastCities();
        return view("showcase_index", ["weather_links"=>$weather_links]); // Send the class and it's data to the view for processing
    }
    /**
     * 
     * @return WeatherForecast
     */
    private function getWeatherForecast(): WeatherForecast
    {
        if($this->weatherForecast === null)
        {
            $this->weatherForecast = new WeatherForecast();
        }

        return $this->weatherForecast;
    }

    public function weatherData(string $city)
    {
        return $this->getWeatherForecast()->data($city);
    }
    
    public function weatherDataWithoutCityParameter()
    {
        return $this->getWeatherForecast()->dataWithoutCityParameter();
    }

    
    
}
