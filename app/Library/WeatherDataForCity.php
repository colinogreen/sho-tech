<?php

namespace app\Library;

Final class WeatherDataForCity
{
    private $day_highest_temp = [];
    private $day_lowest_temp = [];
    private $day_chance_rain = [];
    private $day_wind_speed = [];
    private $day_of_week = [];
    private $day_weather_code = [];
    
    private $dailyForecastDisplay = [];
    
    private $last_update = "N/A";
    
    public function __construct()
    {

    }
    public function setData():void
    {
        $api_data = $this->getCachedData();
        $this->setDailyForecastParameters($api_data->features[0]->properties->timeSeries);
        if(isset($api_data->features[0]->properties->modelRunDate))
        {
            $this->setDailyForecastLastUpdate($api_data->features[0]->properties->modelRunDate);
        }        
    }
    private function dataFilePath():string
    {
        return app_path()."/Data/forecast_latest.txt";
    }
    /**
     * Array order appears to match the numbers in the 'Weather types' table at:
     * https://www.metoffice.gov.uk/services/data/datapoint/code-definitions
     * @return array
     */
    private function getDayWeatherLabel():array
    {
        return ["Clear night","Sunny day","Partly cloudy (night)","Partly cloudy (day)","Not used","Mist","Fog","Cloudy","Overcast",
            "Light rain shower (night)","Light rain shower (day)","Drizzle","Light rain","Heavy rain shower (night)","Heavy rain shower (day)",
            "Heavy rain","Sleet shower (night)","Sleet shower (day)","Sleet","Hail shower (night)","Hail shower (day)","Hail","Light snow shower (night)",
            "Light snow shower (day)","Light snow","Heavy snow shower (night)","Heavy snow shower (day)","Heavy snow","Thunder shower (night)","Thunder shower (day)","Thunder"];
    }
    
    public function setCachedData(string $result)
    {
        return file_put_contents($this->dataFilePath(), $result);
    }
    public function getCachedData()
    {
        if(file_exists($this->dataFilePath()))
        {
           return json_decode(file_get_contents($this->dataFilePath())); 
        }
        
        exit("Error: make sure that the data file, '" .$this->dataFilePath()." has been created." );
        
    } 
    
    private function setDailyForecastLastUpdate(String $last_update):void
    {
        if(!empty($last_update))
        {
            $this->last_update = $last_update;
        }
        
    }

    public function getDailyForecastLastUpdate():?string
    {
        return date("H:i - d-m-Y", strtotime($this->last_update));
    } 
    
    private function setDaySignificantWeatherCode(string $code)
    {
        $this->day_weather_code[] = $this->getDayWeatherLabel()[$code];
    }
    
    public function getDaySignificantWeatherCode($code)
    {
        return $this->day_weather_code[$code];
    }
    private function setDailyForecastParameters(array $timeseries):void
    {
        for($i = 0; $i < 6; $i++)
        {
            if(isset($timeseries[$i]))
            {
                $this->setDayOfWeek($timeseries[$i]->time);
                $this->setDaySignificantWeatherCode($timeseries[$i]->daySignificantWeatherCode);
                $this->setDayHighestTemp(round($timeseries[$i]->dayUpperBoundMaxTemp));
                $this->setDayLowestTemp(round($timeseries[$i]->nightLowerBoundMinTemp));
                $this->setDayChanceOfRain(round($timeseries[$i]->dayProbabilityOfPrecipitation));
                $this->setDayWindSpeed(round($timeseries[$i]->midday10MWindSpeed));                
            }

        }
    }

    
    private function setDayOfWeek(string $date):void
    {
        $this->day_of_week[] = date("D", strtotime($date));
    }
    
    public function getDayOfWeek($day):?string
    {
        return $this->day_of_week[$day];
    }    
    private function setDayHighestTemp(string $data):void
    {
        $this->day_highest_temp[] = $data;
    }
    
    public function getDayHighestTemp($day):?string
    {
        return $this->day_highest_temp[$day];
    }
    
    private function setDayLowestTemp(string $data):void
    {
        $this->day_lowest_temp[] = $data;
    }
    
    public function getDayLowestTemp($day):?string
    {
        return $this->day_lowest_temp[$day];
    }
    private function setDayChanceOfRain(string $data):void
    {
        $this->day_chance_rain[] = $data;
    }
    
    public function getDayChanceOfRain($day):?string
    {
        return $this->day_chance_rain[$day];
    }    
    private function setDayWindSpeed(string $data):void
    {
        $this->day_wind_speed[] = $data;
    }
    
    public function getDayWindSpeed($day):?string
    {
        return $this->day_wind_speed[$day];
    }  
}