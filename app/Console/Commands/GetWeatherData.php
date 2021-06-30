<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetWeatherData extends Command
{
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
     * Create a new command instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        parent::__construct();
//    }
    private function getAPICredentials()
    {
        return parse_ini_file(dirname(__FILE__, 5)."/connect/met_office_api.ini");        
    }   
    
//    public function checkDataFileExists()
//    {
//        return file_exists($this->getDataFilePath());
//    }
    
    private function getDataFolderPath()
    {
        $data_folder = app_path()."/Data";
        if(!file_exists($data_folder))
        {
            mkdir($data_folder, 775);
        }
        
        return $data_folder;
    }
    
    private function getDataFilePath()
    {
        return $this->getDataFolderPath()."/forecast_latest.txt";
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //\Log::debug("** Attempting to get weather data update.***\n");
        $this->queryAPIAndGetData();

        return 0;
    }
}
