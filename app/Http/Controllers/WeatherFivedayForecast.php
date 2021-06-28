<?php

namespace App\Http\Controllers;

use App\Library\WeatherDataForCity;
use App\Console\Commands\GetWeatherData;

use Illuminate\Http\Request;

class WeatherFivedayForecast extends Controller
{
 public function index()
    {
        $cityWeather = new WeatherDataForCity();
        if($this->setWeatherData())
        {
            \Log::debug("Had to set cached weather data file for the first time.");
        }
        $cityWeather->setData();

        return view("weather_index", ["last_update"=> $cityWeather->getDailyForecastLastUpdate(),"weather_data"=>$this->getWeatherTable($cityWeather)]);

    }
    
    private function getWeatherTable(WeatherDataForCity $cityWeather):string
    {
        // getDailyForecastDisplay() - day_of_week, significant_weather_code, day_highest_temp, day_lowest_temp, day_change_of_rain, day_wind_speed
        $precip = "fas fa-tint";
        $temph = "fas fa-temperature-high";
        $templ = "fas fa-temperature-low";
        $wind = "fas fa-wind";

        $string = <<<TABLE
    <div class="row">
       <div class="offset-1 col-2"><h4>{$cityWeather->getDayOfWeek(1)}</h4><span>{$cityWeather->getDaySignificantWeatherCode(1)}</span></div>  <div class="col-2">
           <h4>{$cityWeather->getDayOfWeek(2)}</h4><span>{$cityWeather->getDaySignificantWeatherCode(2)}</span></div> 
           <div class="col-2"><h4>{$cityWeather->getDayOfWeek(3)}</h4><span>{$cityWeather->getDaySignificantWeatherCode(3)}</span></div> 
           <div class="col-2"><h4>{$cityWeather->getDayOfWeek(4)}</h4><span>{$cityWeather->getDaySignificantWeatherCode(4)}</span></div> <div class="col-2"><h4>{$cityWeather->getDayOfWeek(5)}</h4>
               <span>{$cityWeather->getDaySignificantWeatherCode(5)}</span></div> 
    </div>
    <div class="row temp-high">
       <div class="offset-1 col-2"><i class="$temph"></i> &#160;<span>{$cityWeather->getDayHighestTemp(1)} &deg;</span></div>  <div class="col-2"><i class="$temph"></i> &#160;<span>{$cityWeather->getDayHighestTemp(2)} &deg;</span></div> 
           <div class="col-2"><i class="$temph"></i> &#160;<span>{$cityWeather->getDayHighestTemp(3)} &deg;</span></div> <div class="col-2"><i class="$temph"></i> &#160;<span>{$cityWeather->getDayHighestTemp(4)} &deg;</span></div> 
               <div class="col-2"><i class="$temph"></i> &#160;<span>{$cityWeather->getDayHighestTemp(5)} &deg;</span></div> 
    </div>
    <div class="row temp-low">
       <div class="offset-1 col-2"><i class="$templ"></i> &#160;<span>{$cityWeather->getDayLowestTemp(1)} &deg;</span></div>  <div class="col-2"><i class="$templ"></i> &#160;<span>{$cityWeather->getDayLowestTemp(2)} &deg;</span></div> 
           <div class="col-2"><i class="$templ"></i> &#160;<span>{$cityWeather->getDayLowestTemp(3)} &deg;</span></div>
           <div class="col-2"><i class="$templ"></i> &#160;<span>{$cityWeather->getDayLowestTemp(4)} &deg;</span></div> <div class="col-2"><i class="$templ"></i> &#160;<span>{$cityWeather->getDayLowestTemp(5)} &deg;</span></div> 
    </div>
    <div class="row">
       <div class="offset-1 col-2"><i class="$precip"></i> &#160;{$cityWeather->getDayChanceOfRain(1)}%</div>  <div class="col-2"><i class="$precip"></i> &#160;{$cityWeather->getDayChanceOfRain(2)}%</div> 
           <div class="col-2"><i class="$precip"></i> &#160;{$cityWeather->getDayChanceOfRain(3)}%</div> <div class="col-2"><i class="$precip"></i> &#160;{$cityWeather->getDayChanceOfRain(4)}%</div> 
               <div class="col-2"><i class="$precip"></i> &#160; {$cityWeather->getDayChanceOfRain(5)}%</div> 
    </div> 
    <div class="row">
       <div class="offset-1 col-2"><i class="$wind"></i> &#160;{$cityWeather->getDayWindSpeed(1)} mph</div>  <div class="col-2"><i class="$wind"></i> &#160;{$cityWeather->getDayWindSpeed(2)} mph</div> 
           <div class="col-2"><i class="$wind"></i> &#160;{$cityWeather->getDayWindSpeed(3)} mph</div> <div class="col-2"><i class="$wind"></i> &#160;{$cityWeather->getDayWindSpeed(4)} mph</div> 
               <div class="col-2"><i class="$wind"></i> &#160;{$cityWeather->getDayWindSpeed(5)} mph</div> 
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
