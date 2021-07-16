<?php

namespace app\Library;

Final class WeatherDataForCity
{
    private $dayHighestTemp = [];
    private $dayLowestTemp = [];
    private $dayChanceRain = [];
    private $dayWindSpeed = [];
    private $dayOfWeek = [];
    private $dayWeatherDesc = [];
    private $dayWeatherIcon = [];
    
    private $maxUvIndex = [];
    private $dayMaxFeelsLikeTemp = [];
    
    private $location = "unknown location";
    private $lastApiUpdate;
    
    //private $dailyForecastDisplay = [];
    
    private $lastUpdate = "N/A";
    
    //private $data_name = "api_weather_data";
    
    public function __construct($data)
    {
        $this->setData($data);
    }
    
    
    private function setData($api_data):void
    {
        //$api_data = $this->getCachedData();
        $data = json_decode($api_data);
        $this->setDailyForecastParameters($data->features[0]->properties->timeSeries);
        $this->setLastApiUpdate($data);
        if(isset($data->features[0]->properties->modelRunDate))
        {
            $this->setDailyForecastLastUpdate($data->features[0]->properties->modelRunDate);
        }
        if(isset($data->features[0]->properties->location->name))
        {
            $this->setLocation($data->features[0]->properties->location->name);
        }  
    }
    /**
     * 
     * @param string $location
     */
    private function setLocation(string $location):void
    {
        $this->location = $location;
    }
    /**
     * 
     * @return string
     */
    public function getLocation():string
    {
        return $this->location;
    }
    /**
     * 
     * @param object $data
     */ 
    private function setLastApiUpdate(object $data):void
    {
        if(isset($data->api_query->last_update))
        {
            $this->lastApiUpdate = $data->api_query->last_update;
        }

    }
    /**
     * 
     * @return string|NULL
     */
    public function getLastApiUpdate():?string
    {
        return $this->lastApiUpdate;
    }

    /**
     * Array order appears to match the numbers in the 'Weather types' table at:
     * https://www.metoffice.gov.uk/services/data/datapoint/code-definitions
     * @return array
     */
    private function getDayWeatherIcon():array
    {
        return ["fas fa-moon","fas fa-sun","fas fa-cloud-moon","fas fa-cloud-sun","Not used","Mist","Fog","fas fa-cloud","Overcast",
            "Light rain shower (night)","Light rain shower (day)","Drizzle","Light rain","fas fa-cloud-moon-rain","fas fa-cloud-sun-rain",
            "fas fa-cloud-rain","Sleet shower (night)","Sleet shower (day)","Sleet","Hail shower (night)","Hail shower (day)","Hail","fas fa-snow",
            "fas fa-snow","fas fa-snow","fas fa-snow","fas fa-snow","fas fa-snow","Thunder shower (night)","fas fa-bolt"];

    }
    
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
            $this->lastUpdate = $last_update;
        }
        
    }

    public function getDailyForecastLastUpdate():?string
    {
        return date("H:i - d-m-Y", strtotime($this->lastUpdate));
    } 
    
    private function setDaySignificantWeatherDesc(string $code)
    {
        $this->dayWeatherDesc[] = $this->getDayWeatherLabel()[$code];
    }
    private function setDaySignificantWeatherIcon(string $icon)
    {
        $this->dayWeatherIcon[] = $this->getDayWeatherIcon()[$icon];
    }
    public function getDaySignificantWeatherDesc($code)
    {
        return $this->dayWeatherDesc[$code];
    }
    
    public function getDaySignificantWeatherIcon($code)
    {
        return $this->dayWeatherIcon[$code];
    }
    
    private function setDayMaxUvIndex(string $maxUvIndex)
    {
        $this->maxUvIndex[] = $maxUvIndex;
    }
    
    public function getDayMaxUvIndex($day)
    {
        return $this->maxUvIndex[$day];
    }
    
    private function setDayMaxFeelsLikeTemp(string $dayMaxFeelsLikeTemp)
    {
        $this->dayMaxFeelsLikeTemp[] = $dayMaxFeelsLikeTemp;
    }
    
    public function getDayMaxFeelsLikeTemp(string $dayMaxFeelsLikeTemp)
    {
        return $this->dayMaxFeelsLikeTemp[$dayMaxFeelsLikeTemp];
    }
    private function setDailyForecastParameters(array $timeseries):void
    {
        for($i = 0; $i < 6; $i++)
        {
            if(isset($timeseries[$i]))
            {
                $this->setDayOfWeek($timeseries[$i]->time);
                $this->setDaySignificantWeatherDesc($timeseries[$i]->daySignificantWeatherCode);
                $this->setDaySignificantWeatherIcon($timeseries[$i]->daySignificantWeatherCode);
                $this->setDayHighestTemp(round($timeseries[$i]->dayUpperBoundMaxTemp));
                $this->setDayLowestTemp(round($timeseries[$i]->nightLowerBoundMinTemp));
                $this->setDayChanceOfRain(round($timeseries[$i]->dayProbabilityOfPrecipitation));
                
                $this->setDayMaxUvIndex(round($timeseries[$i]->maxUvIndex)); // Added 2021-07-14
                $this->setDayMaxFeelsLikeTemp(round($timeseries[$i]->dayMaxFeelsLikeTemp)); // Added 2021-07-14
               
                $this->setDayWindSpeed(round($this->convertWindSpeed10msToMph($timeseries[$i]->midday10MWindSpeed)));                
            }

        }
    }
    /**
     * 
     * @param string $windspeed
     * @return type
     */
    private function convertWindSpeed10msToMph(string $windspeed)
    {       
        $metres_per_mile = 1609.344;
        $sec_per_hour = (60*60); // 3600
        $met_per_sec_in_mph = $metres_per_mile / $sec_per_hour; // 0.44704

        return ($windspeed / $met_per_sec_in_mph);
    }

    
    private function setDayOfWeek(string $date):void
    {
        $this->dayOfWeek[] = date("D", strtotime($date));
    }
    
    public function getDayOfWeek($day):?string
    {
        return $this->dayOfWeek[$day];
    }    
    private function setDayHighestTemp(string $data):void
    {
        $this->dayHighestTemp[] = $data;
    }
    
    public function getDayHighestTemp($day):?string
    {
        return $this->dayHighestTemp[$day];
    }
    
    private function setDayLowestTemp(string $data):void
    {
        $this->dayLowestTemp[] = $data;
    }
    
    public function getDayLowestTemp($day):?string
    {
        return $this->dayLowestTemp[$day];
    }
    private function setDayChanceOfRain(string $data):void
    {
        $this->dayChanceRain[] = $data;
    }
    
    public function getDayChanceOfRain($day):?string
    {
        return $this->dayChanceRain[$day];
    }    
    private function setDayWindSpeed(string $data):void
    {
        $this->dayWindSpeed[] = $data;
    }
    
    public function getDayWindSpeed($day):?string
    {
        return $this->dayWindSpeed[$day];
    }  
}