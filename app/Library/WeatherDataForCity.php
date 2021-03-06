<?php

namespace app\Library;

Final class WeatherDataForCity
{
    private $dayDate = [];
    private $dayHighestTemp = [];
    private $dayLowestTemp = [];
    private $dayChanceRain = [];
    private $dayWindSpeed = [];
    private $dayOfWeek = [];
    private $dayWeatherDesc = [];
    private $nightWeatherDesc = [];
    private $dayWeatherIcon = [];
    private $nightWeatherIcon = [];
    
    private $maxUvIndex = [];
    private $dayMaxFeelsLikeTemp = [];
    private $nightMinFeelsLikeTemp = [];
    
    private $location = "unknown location";
    private $lastApiUpdate;
    
    private $lastUpdate = "N/A";
    
    private $errorMessage;
    
    public function __construct($data)
    {
        $this->setData($data);
    }    
    
    private function setData($api_data):void
    {

        $data = json_decode($api_data);

        $errors = [];
        // Display error message(s) if the _embedded errors json value was set in the json data retrieved from the api
        if(isset($data->_embedded->errors) && count($data->_embedded->errors)>0)
        {
            
            foreach($data->_embedded->errors as $err)
            {
                $errors[] = $err->message;
            }

        }

        // if no errors, the features json branch will be set hopefully with correct data.
        else if(isset($data->features))
        {
            if(isset($data->features[0]) && isset($data->features[0]->properties->timeSeries))
            {
                $this->setDailyForecastParameters($data->features[0]->properties->timeSeries);
            }
            else
            {
                $errors[] = "Could not set Timeseries weather data.";
            }
            
            $this->setLastApiUpdate($data);
            if(isset($data->features[0]) && isset($data->features[0]->properties->modelRunDate))
            {
                $this->setDailyForecastLastUpdate($data->features[0]->properties->modelRunDate);
            }
            else
            {
                $errors[] = "Could not set Last update data.";
            }
            
            if(isset($data->features[0]) && isset($data->features[0]->properties->location->name))
            {
                $this->setLocation($data->features[0]->properties->location->name);
            } 
            else
            {
                $errors[] = "Could not set location name. data";
            }
        }
        // ... or ensure that a default error message is sent to the screen.
        if(count($errors)> 0)
        {            
            $this->setErrorMessage(implode("<br />", $errors));
        }
    }
    
    
    public function setErrorMessage(string $message):void
    {
        $this->errorMessage = $message;
    }
    
    public function getErrorMessage()
    {
        return $this->errorMessage;
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
        return ["fas fa-moon","far fa-sun","fas fa-cloud-moon","fas fa-cloud-sun","Not used","fas fa-smog","fas fa-smog","fas fa-cloud","fas fa-cloud", //9
            "fas fa-cloud-moon-rain","fas fa-cloud-sun-rain","fas fa-cloud","fas fa-cloud-rain","fas fa-cloud-showers-heavy","fas fa-cloud-showers-heavy", //15
            "fas fa-cloud-showers-heavy","far fa-snowflake","far fa-snowflake","far fa-snowflake","Hail shower (night)","Hail shower (day)","Hail","fas fa-snowflake", //23
            "fas fa-snowflake","fas fa-snowflake","fas fa-snowflake","fas fa-snowflake","fas fa-snowflake","fas fa-bolt","fas fa-bolt", "fas fa-bolt", "fas fa-exclamation"]; // 32 Items

    }
    
    private function getDayWeatherLabel():array
    {

        return ["Clear night","Sunny day","Partly cloudy (night)","Partly cloudy (day)","Not used","Mist","Fog","Cloudy","Overcast", //9
            "Light rain shower (night)","Light rain shower (day)","Drizzle","Light rain","Heavy rain shower (night)","Heavy rain shower (day)",//15
            "Heavy rain","Sleet shower (night)","Sleet shower (day)","Sleet","Hail shower (night)","Hail shower (day)","Hail","Light snow shower (night)", //23
            "Light snow shower (day)","Light snow","Heavy snow shower (night)","Heavy snow shower (day)","Heavy snow","Thunder shower (night)","Thunder shower (day)","Thunder", "unknown"]; //32 Items
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

    private function setDayDate(string $date)
    {
        $this->dayDate[] = $date;
    }
    
    public function getDayDate($date):?string
    {
        if(isset($this->dayDate[$date]))
        {
            return $this->dayDate[$date];
        }       
        return null;       
    }
    
    private function setDaySignificantWeatherDesc(string $code)
    {
        //\Log::debug("Debug Attempt to set setDaySignificantWeatherDesc ". count($this->getDayWeatherLabel()));
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

    private function setNightSignificantWeatherDesc(string $code)
    {
        $this->nightWeatherDesc[] = $this->getDayWeatherLabel()[$code];
    }
    
    private function setNightSignificantWeatherIcon(string $icon)
    {
        $this->nightWeatherIcon[] = $this->getDayWeatherIcon()[$icon];
    }
    
    public function getNightSignificantWeatherDesc($code)
    {
        return $this->nightWeatherDesc[$code];
    }
    
    public function getNightSignificantWeatherIcon($code)
    {
        return $this->nightWeatherIcon[$code];
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
    
    public function getDayMaxFeelsLikeTemp(string $day)
    {
        return $this->dayMaxFeelsLikeTemp[$day];
    }
    
    private function setNightMinFeelsLikeTemp(string $nightMinFeelsLikeTemp)
    {
        $this->nightMinFeelsLikeTemp[] = $nightMinFeelsLikeTemp;
    }
    
    public function getNightMinFeelsLikeTemp(string $day)
    {
        return $this->nightMinFeelsLikeTemp[$day];
    }
    
    private function setDailyForecastParameters(array $timeseries):void
    {
        $ofs = date("I"); //* Added Nov 2021: Set hour offset for if Daylight saving time on (1) or off (0)
        for($i = 0; $i < 8; $i++)
        {
            if(isset($timeseries[$i]) && strtotime($timeseries[$i]->time) < strtotime("now -2 days $ofs hour 1 second"))
            {
                // It takes a while, seemingly for Met office data to update after midnight due to UTC time;...
                // ... so if the first day forecast in the array (usually previous day) becomes two days old at midnight, ...
                // ... discard that entry, so that the next/current day forecast shows up at midnight (or early morning), as expected.
                // Note: Current strtotime calc based on $ofs (offset) variable
                continue;
            }
            else if(isset($timeseries[$i]))
            {
                $this->setDayOfWeek($timeseries[$i]->time);
                $this->setDayDate($timeseries[$i]->time);
                $daysignificantweathercode = isset($timeseries[$i]->daySignificantWeatherCode)? $timeseries[$i]->daySignificantWeatherCode: (count($this->getDayWeatherLabel()) - 1);
                $this->setDaySignificantWeatherDesc($daysignificantweathercode);
                
                $nightSignificantWeatherCode = isset($timeseries[$i]->nightSignificantWeatherCode)? $timeseries[$i]->nightSignificantWeatherCode: (count($this->getDayWeatherLabel()) - 1);
                $this->setNightSignificantWeatherDesc($nightSignificantWeatherCode);
                
                $this->setDaySignificantWeatherIcon($daysignificantweathercode);
                $this->setNightSignificantWeatherIcon($nightSignificantWeatherCode);
                $dayMaxScreenTemperature = isset($timeseries[$i]->dayMaxScreenTemperature)? $timeseries[$i]->dayMaxScreenTemperature: 0;
                $this->setDayHighestTemp(round($dayMaxScreenTemperature));

                $this->setDayLowestTemp(round($timeseries[$i]->nightMinScreenTemperature));

                $dayProbabilityOfPrecipitation = isset($timeseries[$i]->dayProbabilityOfPrecipitation)? $timeseries[$i]->dayProbabilityOfPrecipitation: 0;
                $this->setDayChanceOfRain(round($dayProbabilityOfPrecipitation));
                
                $maxUvIndex = isset($timeseries[$i]->maxUvIndex)? $timeseries[$i]->maxUvIndex: 0;
                $this->setDayMaxUvIndex(round($maxUvIndex)); // Added 2021-07-14
                
                $dayMaxFeelsLikeTemp = isset($timeseries[$i]->dayMaxFeelsLikeTemp)? $timeseries[$i]->dayMaxFeelsLikeTemp: 0;
                $nightMinFeelsLikeTemp= isset($timeseries[$i]->nightMinFeelsLikeTemp)? $timeseries[$i]->nightMinFeelsLikeTemp: 0;
                $this->setDayMaxFeelsLikeTemp(round($dayMaxFeelsLikeTemp)); // Added 2021-07-14
                $this->setNightMinFeelsLikeTemp(round($nightMinFeelsLikeTemp)); // Added 2021-07-28
                $midday10MWindSpeed = isset($timeseries[$i]->midday10MWindSpeed)? round($this->convertWindSpeed10msToMph($timeseries[$i]->midday10MWindSpeed)): 0;                
                $this->setDayWindSpeed($midday10MWindSpeed);                
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