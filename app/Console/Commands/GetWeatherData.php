<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\WeatherFivedayForecast;

class GetWeatherData extends Command
{
    private $cachedDataName = "api_weather_data";
    private $latitude;
    private $longitude;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getweatherdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    
    public function setCityDetails(?object $cityLatitudeAndLongitude)
    {
        if(!is_null($cityLatitudeAndLongitude))
        {
            $this->setCachedDataName($cityLatitudeAndLongitude->name);
            $this->setLatitude($cityLatitudeAndLongitude->latitude);
            $this->setLongitude($cityLatitudeAndLongitude->longitude);
        }
        
        
    }
    
    private function setCachedDataName(string $dataName):void
    {
        $this->cachedDataName = "api_weather_data_". $dataName;
//         if($this->cachedDataName === "api_weather_data" & !empty($dataName))
//         {
//             $this->cachedDataName .= "_". $dataName;
//         }
//         else if(!empty($dataName) && $this->cachedDataName !== "api_weather_data_".$dataName)
//         {
//             $this->cachedDataName .= "api_weather_data_". $dataName;
//         }
//         else if($this->cachedDataName !== "api_weather_data")
//         {
//             $this->cachedDataName = "api_weather_data"; // reset to usual string
//         }
        // if here, do nothing.
    }
       
    private function getCachedDataName():string
    {
        return $this->cachedDataName;
    }
    
    private function setLatitude(string $latitude):void
    {
        $this->latitude = $latitude;
    }
    
    public function getLatitude():?string
    {
        return $this->latitude;
    }
    private function setLongitude(string $longitude):void
    {
        $this->longitude = $longitude;
    }
    
    public function getLongitude():?string
    {
        return $this->longitude;
    }

    private function getAPICredentials()
    {
        return parse_ini_file(dirname(__FILE__, 5)."/connect/met_office_api.ini");        
    }
    /**
     * Refresh cache on scheduled interval initiated by call from App\Console\Commands\GetWeatherData.php ...
     * ... to App\Console\Kernel.php
     * @return boolean
     */
    public function queryAPIOrGetDataMultiple()
    {
        //if($this->checkDataIsInCache() ||$this->getDataFromApi(false))
        $cities = array_keys((new WeatherFivedayForecast())->getCityLatitudeAndLongitudeArray());
        
        foreach($cities as $city)
        {
            $this->setCachedDataName($city);
            \Log::debug(__CLASS__. "::".__FUNCTION__." - Attempt to update cache (".$this->getCachedDataName(). ") via the API endpoint!");
            
            if(!$this->queryAPIOrGetData())
            {
                return false;
            }
        }

        return true;
    }
    
    /**
     * Individual city page version of queryAPIOrGetDataMultiple() method
     * @return boolean
     */
    public function queryAPIOrGetData()
    {
        //if($this->checkDataIsInCache() ||$this->getDataFromApi(false))
        if($this->checkDataIsInCache())
        {
            $this->getDataFromCache();
            return true;
        }
        return $this->getDataFromApi(true);
        //return false;
    }
    
    public function getDataFromCache():?string
    {
        if (Cache::has($this->getCachedDataName())) 
        {
            \Log::debug(__CLASS__. "::".__FUNCTION__." - Attempt to get the data from the cache!");
            //WeatherFivedayForecast::logMessage("Data (". $this->getCachedDataName().") was retrieved from cache!: ".print_r(Cache::get($this->getCachedDataName(), true))); 
            return Cache::get($this->getCachedDataName()); 

        }
//         else
//         {
            // Get data from the API if the cache has expired before the next task API  (service interruption, etc.)
        \Log::debug(__CLASS__. "::".__FUNCTION__." - Attempt to get the data (".$this->getCachedDataName(). ") from the API endpoint!");
        $this->getDataFromApi(true);           
//         }
        //exit ("<p>Debug</p><pre>".print_r(json_decode(Cache::get($this->data_name)), true)."</pre>");
        return Cache::get($this->getCachedDataName());      
    }
    private function checkDataIsInCache()
    {
        if (Cache::has($this->getCachedDataName())) 
        {
            \Log::debug(__CLASS__. "::".__FUNCTION__." - Cache (".$this->getCachedDataName(). ") has the weather data!");
            return true;

        } 
        return false;
    }
    private function getDataFromApi(bool $cache_empty)
    {
        
        $api_cred = $this->getAPICredentials();
        $response = Http::acceptJson()->withHeaders([
        'X-IBM-Client-Id' => $api_cred['X-IBM-Client-Id'],
        'X-IBM-Client-Secret' => $api_cred['X-IBM-Client-Secret']
        ])->get("https://api-metoffice.apiconnect.ibmcloud.com/metoffice/production/v0/forecasts/point/daily", [
            'includeLocationName' => 'true',
            'excludeParameterMetadata' => 'true', 
            //'latitude' => '56.46913', // Dundee latitude
            'latitude' => $this->getLatitude(), // Dundee latitude
            //'longitude' => '-2.97489',  // Dundee longitude
            'longitude' => $this->getLongitude(),  // Dundee longitude
        ]);
        \Log::debug(__CLASS__. "::".__FUNCTION__." | Latitude: " . $this->getLatitude());
        \Log::debug(__CLASS__. "::".__FUNCTION__." | Longitude: " . $this->getLongitude());
        // https://latitudelongitude.org
        // Dundee: 56.46913, -2.97489
        // Manchester: 53.48095, -2.23743
        if(!empty($response->json()))
        {
            $response_data = $response->json();
            //exit("<pre>". print_r($response_data, true)."</pre>");
           
            $response_data['api_query_details'] = [];
            $response_data['api_query']['last_update'] = date("Y-m-d H:i:s");
            //exit ("<p>".__CLASS__. "::".__FUNCTION__." Enter into cache (".$this->getCachedDataName().") - Debug \$response_data</p><pre>".print_r($response_data, true)."</pre>");
            $api_data = json_encode($response_data);

            //$this->setData($api_data);
            
            Cache::put($this->getCachedDataName(), $api_data, 21600); //3600 = 1 hour | 21600 = 6 hours
            $msg = ($cache_empty)? "Note: Data was retrieved from the API as the data cache was empty at this time.": "Data was retrieved following a successful API query!";
            \Log::debug(__CLASS__. "::".__FUNCTION__.$msg);
            //WeatherFivedayForecast::logMessage($msg);
            return true;
        }

        return false;

    }    
    

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $res = $this->queryAPIOrGetDataMultiple();
        $msg = ($res)?"* Processed automated weather data update attempt.": "* NOTICE: The automated weather data update attempt failed.";
        \Log::debug(__CLASS__."::".__FUNCTION__." - ". $msg);
        //WeatherFivedayForecast::logMessage($msg);
        //\Log::debug("*Processed automated weather data update attempt.");
        return 0;
    }
}
