<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Library\WeatherForecast;

class GetWeatherData extends Command
{
    private $cachedDataName = "api_weather_data";
    private $latitude;
    private $longitude;
    
    private static $cacheLengthHours = 3;
    
    private $clearCacheDataFirst = false;
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
    
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(!env('APP_DEBUG'))
        {
            $this->clearCacheDataFirst(); // Called by scheduled task, so clear cached city data first as cache timeout may not be reached for whatever reason
        }
        $res = $this->queryAPIOrGetDataMultiple();
        $msg = ($res)?"* Processed automated weather data update attempt.": "* NOTICE: The automated weather data update attempt failed.";
        \Log::debug(__CLASS__."::".__FUNCTION__." - ". $msg);
        return 0;
    }
    
    public static function getCacheLengthHours()
    {
        return self::$cacheLengthHours;
    }
    
    /**
     * 
     * @return int
     */
    private static function getCacheLengthSeconds():int
    {
        return (self::getCacheLengthHours() * 60 * 60);
    }   
    
    private function clearCacheDataFirst()
    {
        return $this->clearCacheDataFirst = true;
    }
    
    private function clearCacheDataIfNecessary()
    {
        if($this->clearCacheDataFirst())
        {
            Cache::forget($this->getCachedDataName());
        }
    }
    
    
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
    }
       
    public function getCachedDataName():string
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
        $weatherFivedayForecast = new WeatherForecast();
        $cities = array_keys($weatherFivedayForecast->getCityLatitudeAndLongitudeArray());

        foreach($cities as $city)
        {
            $stdClassLatAndLong = $weatherFivedayForecast->getCityLatitudeAndLongitude($city);
            $this->setCityDetails($stdClassLatAndLong);
            $this->clearCacheDataIfNecessary(); // Usually true if handle() method is invoked by scheduled command.

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

        if($this->checkDataIsInCache())
        {
            $this->getDataFromCache();
            return true;
        }
        return $this->getDataFromApi(true);
    }
    
    public function getDataFromCache():?string
    {
        if (Cache::has($this->getCachedDataName())) 
        {
            $this->expectedDataInCache();
            return Cache::get($this->getCachedDataName()); 
        }

        $this->getDataFromApi(true);           

        return Cache::get($this->getCachedDataName());      
    }
   /**
    * Check the data in the cache. If not ok, delete it and try again
    * @todo reduce the amount of times this can be done to save Met office data allowance per day.
    * @return boolean
    */ 
    private function expectedDataInCache()
    {
        $checkdata = json_decode(Cache::get($this->getCachedDataName()));
        
        if(isset($checkdata->message))
        {
            Cache::forget($this->getCachedDataName());
            \Log::debug("Error retrieving cached data for ".$this->getCachedDataName()."\n".  $checkdata->message);
            return false;
        }
        
        return true;

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

            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(), 
        ]);

        // https://latitudelongitude.org

        if(!empty($response->json()))
        {
            $response_data = $response->json();
            //exit("<pre>". print_r($response_data, true)."</pre>");
           
            $response_data['api_query_details'] = [];
            $response_data['api_query']['last_update'] = date("Y-m-d H:i:s");
            //exit ("<p>".__CLASS__. "::".__FUNCTION__." Enter into cache (".$this->getCachedDataName().") - Debug \$response_data</p><pre>".print_r($response_data, true)."</pre>");
            $api_data = json_encode($response_data);

            
            Cache::put($this->getCachedDataName(), $api_data, self::getCacheLengthSeconds()); //3600 = 1 hour | 21600 = 6 hours
            $msg = ($cache_empty)? "Note: Data was retrieved from the API as the data cache was empty at this time.": "Data was retrieved following a successful API query!";
            //\Log::debug(__CLASS__. "::".__FUNCTION__.$msg);

            return true;
        }

        return false;

    }    

}
