<?php

namespace App\Http\Controllers;

use App\Library\WeatherDataForCity;
use App\Console\Commands\GetWeatherData;

//use Illuminate\Http\Request;

class WeatherFivedayForecast extends Controller
{
    private $cityLatitudeAndLongitude = [];
    private $city_links =[];
    
    public function __construct()
    {
        $this->setCityLatitudeAndLongitude();
    }
    public function index()
    {
        //print("Debug: env('APP_DEBUG'): ". env('APP_DEBUG'));
        //$getWeatherData = new GetWeatherData();
        //$cityWeather = new WeatherDataForCity($getWeatherData->getDataFromCache());

        //return view("weather_index", ["cityWeather"=> $cityWeather]); // Send the class and it's data to the view for processing
        $weather_links = $this->getWeatherForecastCities();
        return view("showcase_index", ["weather_links"=>$weather_links]); // Send the class and it's data to the view for processing

    }
    
    public function myGreeting(string $city)
    {
        //return "Hello Greeting $param!";
        return view("weather_index", ["city" => $city]);
    }
    
    public function indexWeatherWithCity($city)
    {
        return view("weather_index", ["city" => $city]); // Send the class and it's data to the view for processing       
    }
    /*
     *             'latitude' => '56.46913', // Dundee latitude
            'longitude' => '-2.97489',  // Dundee longitude
     */
    
    private function setCityLatitudeAndLongitude()
    {
        $this->cityLatitudeAndLongitude = [
            
            "dundee"=>[
                "name" => "dundee", 
                "latitude"=>"56.46913", 
                "longitude"=>"-2.97489"],
            
            "liverpool"=>[
                "name" => "liverpool",
                "latitude"=>"53.41058",
                "longitude"=>"-2.97794"],
            
            "london"=>[
                "name" => "london",
                "latitude"=>"51.50853",
                "longitude"=>"-0.12574"],
            //53.41058, -2.97794 Liverpool ropewalks?
            // 51.50853, -0.12574 - London
        ];
    }
    
    public function getWeatherForecastCities():array
    {
        $cities = array_keys($this->getCityLatitudeAndLongitudeArray());
        array_walk($cities, [$this,'createWeatherLinks']);
        return $this->city_links;
        //$city_links = [];
        
    }
    
    private function createWeatherLinks($city)
    {
        $this->city_links[] = '<p><a href="/weather/'. $city . '">' . ucfirst($city). '</a></p>';
        
    }
    private function getCityLatitudeAndLongitudeArray():array
    {
        return $this->cityLatitudeAndLongitude;
    }
    private function getCityLatitudeAndLongitude($city):object
    {
        $std = new \stdClass();
        $std->name = $city;
        //\Log::debug("Trying to get city data for $city: ".print_r($this->cityLatitudeAndLongtitude[$city], true)); exit("End");
        $std->latitude = $this->cityLatitudeAndLongitude[$city]['latitude'];
        $std->longitude = $this->cityLatitudeAndLongitude[$city]['longitude'];
        
        return $std;
    }
    /**
     * Just get json data for React.js, etc.
     * @return WeatherDataForCity
     */
    
    public function dataWithoutCityParameter()
    {
        return $this->data("dundee");
        //return $this->data("liverpool");
    }
    public function data(string $city)
    {
        $stdClass = $this->getCityLatitudeAndLongitude(strtolower($city));
        //\Log::debug("Trying to get city data for $city: ".print_r($stdClass, true)); exit("End");
        $getWeatherData = new GetWeatherData();
        $getWeatherData->setCityDetails($stdClass);
        $cityWeather = new WeatherDataForCity($getWeatherData->getDataFromCache());
        //exit("<pre>". __CLASS__. "::".__FUNCTION__." - ".print_r($cityWeather->getLastApiUpdate(), true)."</pre>");
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
