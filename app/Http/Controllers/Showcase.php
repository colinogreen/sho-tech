<?php

namespace App\Http\Controllers;

use App\Library\WeatherForecast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Showcase extends Controller
{
    
    private $weatherForecast;
    
    /**
     * Brand new Showcase and Technohelp method.
     * This should replace index() method when completed
     */
    public function indexNew()
    {
        // Add menu items for index page. [ ->indexItem(string $image, string $route, string $description)]
        $apps[] = $this->indexItem("covid_1_225h.jpg", "cstats_index","UK Covid infection rates and mortality rates updated on a schedule during weekdays");
        $apps[] = $this->indexItem("weather_1_225h.jpg", "weatherindex","Weather forecasts for various cities in the UK");
        return view("album.index", ["apps"=> $apps]);
    }
    public function index()
    {
        //self::logSiteVisit();
        return view("showcase_index", ["indexcontent"=>"general"]); // Send the class and it's data to the view for processing
    } 
    /**
     * Return anonymous class containing target main menu item
     * @param string $image
     * @param string $route
     * @param string $description
     * @return \App\Http\Controllers\#anon#Showcase_php#1
     */
    private function indexItem(string $image, string $route, string $description)
    {
        return new class($image, $route, $description){
            public $image;
            public $route;
            public $description;
            
            public function __construct($image, $route, $description)
            {
                $this->image = $image;
                $this->route = $route;
                $this->description = $description;
            }
        };
    }
    public function covidStatsUk()
    {
        return view('covid_stats_uk');
    }
    
    public function cvStatsUK(Request $post)
    {
        //\Log::debug(__FUNCTION__. " - " . __LINE__. " - Post: ".print_r($post->toArray(), true));
        $wwwpath = dirname(__FILE__, 5);
        $api_token_file = "api_token_live";
        //if(!stristr(url(""), ".uk"))
        if($wwwpath === "/var/www/html")
        {
            $api_token_file = "api_token_test";
            $url = "http://cms.technohelp.vm2/api/getcovidstatsfull";            
        }
        else
        {
            $url = "https://cms.technohelp.uk/api/getcovidstatsfull"; 
        }   
        $token = str_ireplace("api_token=", "",file_get_contents("$wwwpath/connect/$api_token_file.ini")); 
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.trim($token),
            'Accept' => 'application/json',
        ])->post($url, $post->toArray());

        return $response;
       
    }
    
    public function indexWeatherWithCity($city)
    {
        if(!WeatherForecast::isValidUKWeatherCity($city))
        {
            return redirect("/"); // Redirect to home page if city query string is not a valid UK City for this application.
        }
        
        self::logPageVisit();        
        return view("weather_city", ["city" => $city]); // Send the class and it's data to the view for processing
    }
    public function indexWeather()
    {
        self::logPageVisit();
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
