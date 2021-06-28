<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\WeatherDataForCity;

use App\Console\Commands\GetWeatherData;

class WeatherFivedayForecast extends Controller
{
    public function index()
    {
        $city_weather = new WeatherDataForCity();
        if($this->setWeatherData())
        {
            \Log::debug("Had to set cached weather data file for the first time.");
        }
        $city_weather->setData();

        return view("weather_index", ["last_update"=> $city_weather->getDailyForecastLastUpdate(),"weather_data"=>$this->getWeatherTable($city_weather)]);

    }
    
    private function getWeatherTable($city_weather)
    {
        // getDailyForecastDisplay() - day_of_week, significant_weather_code, day_highest_temp, day_lowest_temp, day_change_of_rain, day_wind_speed
        $precip = "fas fa-tint";
        $temph = "fas fa-temperature-high";
        $templ = "fas fa-temperature-low";
        $wind = "fas fa-wind";
        
        //$display = $city_weather->getDailyForecastDisplay();
//        $string = "";
//
//        for($i = 1; $i < count($display) ; $i++)
//        {
//            $string .= "<div class=\"row\">";
//            $string .= "<div class=\"col-2\">".$display[$i][1]."</div>";
//            $string .= "<div class=\"col-2\">".$display[$i][2]."</div>";
//            $string .= "<div class=\"col-2\">".$display[$i][3]."</div>";
//            $string .= "<div class=\"col-2\">".$display[$i][4]."</div>";
//            $string .= "<div class=\"col-2\">".$display[$i][5]."</div>";
//            $string .= "</div>";
//        }
//    
        $string = <<<TABLE
    <div class="row">
       <div class="offset-1 col-2"><h4>{$city_weather->getDayOfWeek(1)}</h4><span>{$city_weather->getDaySignificantWeatherCode(1)}</span></div>  <div class="col-2">
           <h4>{$city_weather->getDayOfWeek(2)}</h4><span>{$city_weather->getDaySignificantWeatherCode(2)}</span></div> 
           <div class="col-2"><h4>{$city_weather->getDayOfWeek(3)}</h4><span>{$city_weather->getDaySignificantWeatherCode(3)}</span></div> 
           <div class="col-2"><h4>{$city_weather->getDayOfWeek(4)}</h4><span>{$city_weather->getDaySignificantWeatherCode(4)}</span></div> <div class="col-2"><h4>{$city_weather->getDayOfWeek(5)}</h4>
               <span>{$city_weather->getDaySignificantWeatherCode(5)}</span></div> 
    </div>
    <div class="row temp-high">
       <div class="offset-1 col-2"><i class="$temph"></i> &#160;<span>{$city_weather->getDayHighestTemp(1)} &deg;</span></div>  <div class="col-2"><i class="$temph"></i> &#160;<span>{$city_weather->getDayHighestTemp(2)} &deg;</span></div> 
           <div class="col-2"><i class="$temph"></i> &#160;<span>{$city_weather->getDayHighestTemp(3)} &deg;</span></div> <div class="col-2"><i class="$temph"></i> &#160;<span>{$city_weather->getDayHighestTemp(4)} &deg;</span></div> 
               <div class="col-2"><i class="$temph"></i> &#160;<span>{$city_weather->getDayHighestTemp(5)} &deg;</span></div> 
    </div>
    <div class="row temp-low">
       <div class="offset-1 col-2"><i class="$templ"></i> &#160;<span>{$city_weather->getDayLowestTemp(1)} &deg;</span></div>  <div class="col-2"><i class="$templ"></i> &#160;<span>{$city_weather->getDayLowestTemp(2)} &deg;</span></div> 
           <div class="col-2"><i class="$templ"></i> &#160;<span>{$city_weather->getDayLowestTemp(3)} &deg;</span></div>
           <div class="col-2"><i class="$templ"></i> &#160;<span>{$city_weather->getDayLowestTemp(4)} &deg;</span></div> <div class="col-2"><i class="$templ"></i> &#160;<span>{$city_weather->getDayLowestTemp(5)} &deg;</span></div> 
    </div>
    <div class="row">
       <div class="offset-1 col-2"><i class="$precip"></i> &#160;{$city_weather->getDayChanceOfRain(1)}%</div>  <div class="col-2"><i class="$precip"></i> &#160;{$city_weather->getDayChanceOfRain(2)}%</div> 
           <div class="col-2"><i class="$precip"></i> &#160;{$city_weather->getDayChanceOfRain(3)}%</div> <div class="col-2"><i class="$precip"></i> &#160;{$city_weather->getDayChanceOfRain(4)}%</div> 
               <div class="col-2"><i class="$precip"></i> &#160; {$city_weather->getDayChanceOfRain(5)}%</div> 
    </div> 
    <div class="row">
       <div class="offset-1 col-2"><i class="$wind"></i> &#160;{$city_weather->getDayWindSpeed(1)} mph</div>  <div class="col-2"><i class="$wind"></i> &#160;{$city_weather->getDayWindSpeed(2)} mph</div> 
           <div class="col-2"><i class="$wind"></i> &#160;{$city_weather->getDayWindSpeed(3)} mph</div> <div class="col-2"><i class="$wind"></i> &#160;{$city_weather->getDayWindSpeed(4)} mph</div> 
               <div class="col-2"><i class="$wind"></i> &#160;{$city_weather->getDayWindSpeed(5)} mph</div> 
    </div>                
                               
TABLE;

        return $string;
    }

    /**
     * Run app/Console/Commands/WeatherData.php if file does not exist. Usually updated by artisan schedule
     * @return bool
     */
    public function setWeatherData():bool
    {
        $set_data = new GetWeatherData();
        if(!$set_data->checkDataFileExists())
        {
            
            $set_data->handle();
            return true;
        }
        
        return false;

    }
}
