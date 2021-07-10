<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\WeatherFivedayForecast;

class GetWeatherData extends Command
{
    private $data_name = "api_weather_data";
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

    private function getAPICredentials()
    {
        return parse_ini_file(dirname(__FILE__, 5)."/connect/met_office_api.ini");        
    }   
   
    public function queryAPIOrGetData()
    {
        if($this->setDataInCache() ||$this->getDataFromApi(false))
        {
            return true;
        }
        
        return false;
    }
    
    public function getDataFromCache():?string
    {
        if (Cache::has($this->data_name)) 
        {
            \Log::debug(__CLASS__. "::".__FUNCTION__." - Attempt to get the data from the cache!");
            WeatherFivedayForecast::logMessage("Data was retrieved from cache!"); 

        }
        else
        {
            // Get data from the API if the cache has expired before the next task API  (service interruption, etc.)
            \Log::debug(__CLASS__. "::".__FUNCTION__." - Attempt to get the data from the API endpoint!");
            $this->getDataFromApi(true);           
        }
        //exit ("<p>Debug</p><pre>".print_r(json_decode(Cache::get($this->data_name)), true)."</pre>");
        return Cache::get($this->data_name);      
    }
    private function setDataInCache()
    {
        if (Cache::has($this->data_name)) 
        {
            \Log::debug(__CLASS__. "::".__FUNCTION__." - Cache has the weather data!");
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
        ])->get('https://api-metoffice.apiconnect.ibmcloud.com/metoffice/production/v0/forecasts/point/daily', [
            'latitude' => '56.460925484470174', // Dundee latitude
            'longitude' => '-2.9706113751332133',  // Dundee longitude
        ]);
        
        if(!empty($response->json()))
        {
            $response_data = $response->json();
           
            $response_data['api_query_details'] = [];
            $response_data['api_query']['last_update'] = date("Y-m-d H:i:s");
            //exit ("<p>Debug \$response_data</p><pre>".print_r($response_data, true)."</pre>");
            $api_data = json_encode($response_data);

            //$this->setData($api_data);
            
            Cache::put($this->data_name, $api_data, 7200); //3600 = 1 hour
            $msg = ($cache_empty)? "Note: Data was retrieved from the API as the data cache was empty at this time.": "Data was retrieved following a successful API query!";
            WeatherFivedayForecast::logMessage($msg);
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
        
        $res = $this->queryAPIOrGetData();
        $msg = ($res)?"* Processed automated weather data update attempt.": "* NOTICE: The automated weather data update attempt failed.";
        \Log::debug(__CLASS__."::".__FUNCTION__." - ". $msg);
        //WeatherFivedayForecast::logMessage($msg);
        //\Log::debug("*Processed automated weather data update attempt.");
        return 0;
    }
}
