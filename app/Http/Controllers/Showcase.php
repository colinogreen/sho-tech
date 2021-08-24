<?php

namespace App\Http\Controllers;

use App\Library\WeatherForecast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Classes\Messages\Message;
require_once dirname(__DIR__, 4)."/Classes/autoloader.php";

class Showcase extends Controller
{
    
    private $weatherForecast;

    public static function logSiteVisit()
    {
        (new Message())->logSiteVisit();        
    }
    public function index()
    {
        self::logSiteVisit();
        return view("showcase_index", ["indexcontent"=>"general"]); // Send the class and it's data to the view for processing
    } 
    public function covidStatsUk()
    {
        return view('covid_stats_uk');
    }
    
    public function cvStatsUK(Request $post)
    {
        //\Log::debug(__FUNCTION__. " - " . __LINE__. " - Post: ".print_r($post->toArray(), true));
        $wwwpath = dirname(__FILE__, 5);
        //if(!stristr(url(""), ".uk"))
        if($wwwpath === "/var/www/html")
        {
            //echo $wwwpath;
            $token = str_ireplace("api_token=", "",file_get_contents("$wwwpath/connect/api_token_test.ini")); $url = "http://cms.technohelp.vm2/api/getcovidstatsfull";            
        }
        else
        {
            $token = str_ireplace("api_token=", "",file_get_contents("$wwwpath/connect/api_token_live.ini")); $url = "https://cms.technohelp.uk/api/getcovidstatsfull"; 
        }   
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.trim($token),
            'Accept' => 'application/json',
        ])->post($url, $post->toArray());
        
        //print("<pre>". print_r($response->json(), true). "</pre>" ) ;
        return $response;
       
    }
    
    public function indexWeatherWithCity($city)
    {
        self::logSiteVisit();
        return view("weather_city", ["city" => $city]); // Send the class and it's data to the view for processing
    }
    public function indexWeather()
    {
        self::logSiteVisit();
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
