<?php

namespace App\Http\Controllers;

use App\Library\WeatherForecast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Showcase extends Controller
{
    
    private $weatherForecast;
    
    public function index()
    {
        return view("showcase_index", ["indexcontent"=>"general"]); // Send the class and it's data to the view for processing
    } 
    
    public function cvStatsUK()
    {
        //exit(str_ireplace("api_token=", "",file_get_contents("/var/www/html/connect/api_token_test.ini")));
        $wwwpath = dirname(__FILE__, 5);
        //$token = str_ireplace("api_token=", "",file_get_contents("$wwwpath/connect/api_token_test.ini")); $url = "http://cms.technohelp.vm2/api/statisticsdata";
        //exit($token);
        $token = str_ireplace("api_token=", "",file_get_contents("$wwwpath/connect/api_token_live.ini")); $url = "https://cms.technohelp.uk/api/statisticsdata";      
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.trim($token),
            'Accept' => 'application/json',
        ])->get($url, []);
        
        print("<pre>". print_r($response->json(), true). "</pre>" ) ;
       
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
