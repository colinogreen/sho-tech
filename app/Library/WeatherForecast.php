<?php

namespace app\Library;

use App\Library\WeatherDataForCity;

use App\Console\Commands\GetWeatherData;
use Illuminate\Support\Facades\Cache;

/**
 * @author Colin M.
 * @package App
 */
class WeatherForecast{
    
    private $cityLatitudeAndLongitude = [];
    private $city_links =[];
    
    public function __construct()
    {
        $this->setCityLatitudeAndLongitude();
    }
    
    public function myGreeting(string $city)
    {
        return view("weather_index", ["city" => $city]);
    }

    private function setCityLatitudeAndLongitude()
    {
        $this->cityLatitudeAndLongitude = self::getCityLatAndLongInfo();
    }
    /**
     * Array of Valid UK Cities and their Latitude and Longitude that can be queried by the app.
     * Made static so that both class instance AND static calls can access the data.
     * @return Array of Cities
     */
    private static function getCityLatAndLongInfo()
    {
        return [
            
            "belfast"=>[
                "name" => "belfast",
                "latitude"=>"54.58333",
                "longitude"=>"-5.93333"],

            "birmingham"=>[
                "name" => "birmingham",
                "latitude"=>"52.48142",
                "longitude"=>"-1.89983"],
            
            "bristol"=>[
                "name" => "bristol",
                "latitude"=>"51.45523",
                "longitude"=>"-2.59665"],
            
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
            
            "plymouth"=>[
                "name" => "plymouth",
                "latitude"=>"50.37153",
                "longitude"=>"-4.14305"], 
            
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
            
        ];
    }
    
    private static function getValidListOfUKCities():array
    {
        return array_keys(self::getCityLatAndLongInfo());
    }
    
    public static function isValidUKWeatherCity($city):bool
    {
        return in_array($city, self::getValidListOfUKCities());
    }
    
    public function getWeatherForecastCities():array
    {
        $cities = array_keys($this->getCityLatitudeAndLongitudeArray());
        asort($cities); // Sort cities, if necessary.
        $CitySummary = new \stdClass();
        array_walk($cities, [$this,'createWeatherLinks' ],$CitySummary);
        
        return $this->city_links;
        //$city_links = [];
        
    }
    
    private function createWeatherLinks($city, $CitySummary)
    {
        $this->city_links[]['link'] = '<a href="/weather/'. $city . '" class="card-link" >' . ucfirst($city). '</a>';
        $data = json_decode($this->data($city));
        if(isset($data->api_query->day[1]))
        {
            $this->city_links[(count($this->city_links)-1)]['data'] = $data->api_query->day[1];
        }
        else
        {
            $this->city_links[(count($this->city_links)-1)]['data'] =[];
        }
        
        return $this->city_links;
        
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
    
    public function dataWithoutCityParameter()
    {
        return $this->data("dundee");

    }
    public function data(string $city)
    {
        $stdClass = $this->getCityLatitudeAndLongitude(strtolower($city));
        $getWeatherData = new GetWeatherData();
        $getWeatherData->setCityDetails($stdClass);

        $cityWeather = new WeatherDataForCity($getWeatherData->getDataFromCache());

        $data = new \stdClass;
        $data->api_query = new \stdClass;
        $data->api_query->last_api_update = $cityWeather->getLastApiUpdate();
        $data->api_query->last_forecast_update = $cityWeather->getDailyForecastLastUpdate();
        $data->api_query->location = $cityWeather->getLocation();
        $data->api_query->message = $cityWeather->getErrorMessage();
        //$data->api_query->location = "Feeblesticks";
        $data->api_query->day = [];
        
        if(!empty($data->api_query->message))
        {
            $key = $getWeatherData->getCachedDataName();
            $value = Cache::get($getWeatherData->getCachedDataName());
            Cache::put($key,$value, now()->addMinutes(3)); // Refresh the existing cached item for another attempt in three minutes. Avoids multiple API calls.
            return json_encode($data); // Go no further.
        }

        for($i = 0; $i<7;$i++)
        {
            $data->api_query->day[$i] = new \stdClass;
            
            $utcnextdaytimeminus7hours = !is_null($cityWeather->getDayDate(($i +1)))?strtotime($cityWeather->getDayDate($i +1)."- 7 hours"): "";
            
            // See if current day is within seven hours of the Met Office next day start time. If so, show night time weather symbol.
            if($i === 1 && strtotime("now")> $utcnextdaytimeminus7hours)
            {
                $data->api_query->day[$i]->day_weather_desc = $cityWeather->getNightSignificantWeatherDesc($i);
                $data->api_query->day[$i]->day_weather_icon = $cityWeather->getNightSignificantWeatherIcon($i);
                $data->api_query->day[$i]->day_period_temp = $cityWeather->getDayLowestTemp($i);
                //$data->api_query->day[$i]->day_period = "Tonight (".$cityWeather->getDayOfWeek($i).")";
                $data->api_query->day[$i]->day_period = "Tonight";
                $data->api_query->day[$i]->feels_like_temp = $cityWeather->getNightMinFeelsLikeTemp($i);

            }
            else 
            {
                $data->api_query->day[$i]->day_weather_desc = $cityWeather->getDaySignificantWeatherDesc($i);
                $data->api_query->day[$i]->day_weather_icon = $cityWeather->getDaySignificantWeatherIcon($i);
                $data->api_query->day[$i]->day_period_temp = $cityWeather->getDayHighestTemp($i);
                //$data->api_query->day[$i]->day_period = "Today (".$cityWeather->getDayOfWeek($i).")";
                $data->api_query->day[$i]->day_period = "Today";
                $data->api_query->day[$i]->feels_like_temp = $cityWeather->getDayMaxFeelsLikeTemp($i);
            }
            
            $data->api_query->day[$i]->day_of_week = $cityWeather->getDayOfWeek($i);
            $data->api_query->day[$i]->day_highest_temp = $cityWeather->getDayHighestTemp($i);
            $data->api_query->day[$i]->day_lowest_temp = $cityWeather->getDayLowestTemp($i);
            $data->api_query->day[$i]->day_chance_rain = $cityWeather->getDayChanceOfRain($i);
            $data->api_query->day[$i]->day_wind_mph = $cityWeather->getDayWindSpeed($i);
            $data->api_query->day[$i]->max_uv_index = $cityWeather->getDayMaxUvIndex($i);
            $data->api_query->day[$i]->max_feels_like_temp = $cityWeather->getDayMaxFeelsLikeTemp($i);
            $data->api_query->day[$i]->min_feels_like_temp = $cityWeather->getNightMinFeelsLikeTemp($i);
        }
        return json_encode($data);
    }
}