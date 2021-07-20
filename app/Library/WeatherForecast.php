<?php

namespace app\Library;

use App\Library\WeatherDataForCity;

use App\Console\Commands\GetWeatherData;

class WeatherForecast{
    
    private $cityLatitudeAndLongitude = [];
    private $city_links =[];
    
    public function __construct()
    {
        $this->setCityLatitudeAndLongitude();
    }
//     public function index()
//     {
//         //print("Debug: env('APP_DEBUG'): ". env('APP_DEBUG'));
//         //$getWeatherData = new GetWeatherData();
//         //$cityWeather = new WeatherDataForCity($getWeatherData->getDataFromCache());
        
//         //return view("weather_index", ["cityWeather"=> $cityWeather]); // Send the class and it's data to the view for processing
//         $weather_links = $this->getWeatherForecastCities();
//         return view("showcase_index", ["weather_links"=>$weather_links]); // Send the class and it's data to the view for processing
        
//     }
    
    public function myGreeting(string $city)
    {
        //return "Hello Greeting $param!";
        return view("weather_index", ["city" => $city]);
    }

    /*
     *             'latitude' => '56.46913', // Dundee latitude
     'longitude' => '-2.97489',  // Dundee longitude
     */
    
    private function setCityLatitudeAndLongitude()
    {
        $this->cityLatitudeAndLongitude = [
            
            "belfast"=>[
                "name" => "belfast",
                "latitude"=>"54.58333",
                "longitude"=>"-5.93333"],
            
            "cardiff"=>[
                "name" => "cardiff",
                "latitude"=>"51.48",
                "longitude"=>"-3.18"],
            
            "dundee"=>[
                "name" => "dundee",
                "latitude"=>"56.46913",
                "longitude"=>"-2.97489"],
            
            "glasgow"=>[
                "name" => "glasgow",
                "latitude"=>"55.86515",
                "longitude"=>"-4.25763"],
            
            "liverpool"=>[
                "name" => "liverpool",
                "latitude"=>"53.41058",
                "longitude"=>"-2.97794"],
            
            "london"=>[
                "name" => "london",
                "latitude"=>"51.50853",
                "longitude"=>"-0.12574"],
            
            "manchester"=>[
                "name" => "manchester",
                "latitude"=>"53.48095",
                "longitude"=>"-2.23743"],
            
            "norwich"=>[
                "name" => "norwich",
                "latitude"=>"52.62783",
                "longitude"=>"1.29834"],
            
            "newcastle"=>[
                "name" => "newcastle",
                "latitude"=>"54.97328",
                "longitude"=>"-1.61396"],
            
            "southampton"=>[
                "name" => "southampton",
                "latitude"=>"50.90395",
                "longitude"=>"-1.40428"],
            
            "york"=>[
                "name" => "york",
                "latitude"=>"53.95763",
                "longitude"=>"-1.08271"],
            
            // Belfast - 54.58333, -5.93333
            // Birmingham - 52.48142, -1.89983
            // Cardiff - 51.48, -3.18
            // Glasgow - 55.86515, -4.25763
            // Liverpool ropewalks? - 53.41058, -2.97794
            // London - 51.50853, -0.12574
            // Manchester - 53.48095, -2.23743
            // newcastle - 54.97328, -1.61396
            // norwich - 52.62783, 1.29834
            // Southampton - 50.90395, -1.40428
            // York - 53.95763, -1.08271
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
    public function getCityLatitudeAndLongitudeArray():array
    {
        return $this->cityLatitudeAndLongitude;
    }
    public function getCityLatitudeAndLongitude($city):object
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
        //exit(__CLASS__. "::".__FUNCTION__." - DEBUG Trying to get city data for $city: ".print_r($stdClass, true));
        $getWeatherData = new GetWeatherData();
        $getWeatherData->setCityDetails($stdClass);
        //exit( __CLASS__. "::".__FUNCTION__." - Data from cache: <pre> - ".print_r($getWeatherData->getDataFromCache(), true)."</pre>");
        //exit(__CLASS__. "::".__FUNCTION__. ":". __LINE__." - DEBUG Trying to get city data for $city: ".print_r($stdClass, true));
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
        //exit( __CLASS__. "::".__FUNCTION__." - Data:<pre>". print_r($data, true)."</pre>");
        return json_encode($data);
        //return $getWeatherData->getDataFromCache();
    }
}