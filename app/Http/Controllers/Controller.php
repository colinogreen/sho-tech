<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// Autoload external classes from <root>/Classes folder
require_once dirname(__DIR__, 4)."/Classes/autoloader.php";

use Classes\Messages\LogVisitors;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct()
    {
        self::logSiteVisit();
    }
    public static function logSiteVisit()
    {
        (new LogVisitors())->siteVisit();        
    }
    public static function logPageVisit()
    {
        (new LogVisitors())->pageVisit();        
    } 
    
    public static function logSiteAndPageVisit()
    {
        $logVisitors = new LogVisitors();
        $logVisitors->siteVisit();        
        $logVisitors->pageVisit();        
    } 
}
