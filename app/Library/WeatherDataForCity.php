<?php

namespace app\Library;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
//use App\Http\Controllers\WeatherFivedayForecast;
Final class WeatherDataForCity
{
    private $dayHighestTemp = [];
    private $dayLowestTemp = [];
    private $dayChanceRain = [];
    private $dayWindSpeed = [];
    private $dayOfWeek = [];
    private $dayWeatherCode = [];
    
    //private $dailyForecastDisplay = [];
    
    private $lastUpdate = "N/A";
    
    private $data_name = "api_weather_data";
    
    public function __construct()
    {

    }
    
    
    private function setData($api_data):void
    {
        //$api_data = $this->getCachedData();
        $data = json_decode($api_data);
        $this->setDailyForecastParameters($data->features[0]->properties->timeSeries);
        if(isset($data->features[0]->properties->modelRunDate))
        {
            $this->setDailyForecastLastUpdate($data->features[0]->properties->modelRunDate);
        }        
    }
    private function getAPICredentials()
    {
        return parse_ini_file(dirname(__FILE__, 4)."/connect/met_office_api.ini");        
    }   
    
    public function queryAPIOrGetData()
    {
        if($this->getDataFromCache() ||$this->getDataFromApi())
        {
            return true;
        }
        
        return false;
    }
    
    private function getDataFromCache()
    {
        if (Cache::has($this->data_name)) {

            $this->setData(Cache::get($this->data_name));
            if(env('APP_DEBUG'))
            {
               print("Data is cached!"); 
            }
            
            return true;

        } 
        return false;
    }
    private function getDataFromApi()
    {
        $api_cred = $this->getAPICredentials();
        $response = Http::acceptJson()->withHeaders([
        'X-IBM-Client-Id' => $api_cred['X-IBM-Client-Id'],
        'X-IBM-Client-Secret' => $api_cred['X-IBM-Client-Secret']
        ])->get('https://api-metoffice.apiconnect.ibmcloud.com/metoffice/production/v0/forecasts/point/daily', [
            'latitude' => '56.460925484470174', // Dundee latitude
            'longitude' => '-2.9706113751332133',  // Dundee longitude
        ]);
        
        if(!empty($response->json()))
        {
            $api_data = json_encode($response->json());

            $this->setData($api_data);
            
            Cache::put($this->data_name, $api_data, 3600); //3600 = 1 hour

            return true;
        }

        return false;

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
            $this->lastUpdate = $last_update;
        }
        
    }

    public function getDailyForecastLastUpdate():?string
    {
        return date("H:i - d-m-Y", strtotime($this->lastUpdate));
    } 
    
    private function setDaySignificantWeatherCode(string $code)
    {
        $this->dayWeatherCode[] = $this->getDayWeatherLabel()[$code];
    }
    
    public function getDaySignificantWeatherCode($code)
    {
        return $this->dayWeatherCode[$code];
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