<?php
//use App\Library\WeatherForecast;
use App\Http\Controllers\Showcase;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/index-old', [Showcase::class, 'indexOld'])->name("site_index_old");
Route::get('/', [Showcase::class, 'index'])->name("site_index");

Route::get('/greeting', function () {
    return 'Hello World';
});

// May 2024 - Get Software version
Route::get('ccm-soft-ver', 
function()
{ 
    return view("ccm-software-version");
});

//** sb-admin-2 based bootstrap template view
Route::get('cstats', function () 
{
    Controller::logSiteAndPageVisit();

    return view("cstats_index");
})->name("cstats_index");



//route::get('index-new', function(){
//    return view('album.index');
//})->name('index_new');

Route::get('weather/{city}', [Showcase::class, 'indexWeatherWithCity']);

Route::get('weather', [Showcase::class, 'indexWeather'])->name("weatherindex");

Route::get('covidstatsuk', [Showcase::class, 'covidStatsUk'])->name("covidstatsukindex");

// * Calls the cms API endpoint for stats data, retrieving a secret Bearer token for authentication outside of this folder structure.
Route::post('cvstats', [Showcase::class, 'cvStatsUK'])->name("cvd_stats"); //->middleware('auth');
Route::get('cvstats', function () {
    return redirect("/"); // Redirect to home page if endpoint post url is called in browser or from app using get request, etc.
});

Route::get('/forecast_data', [Showcase::class, 'weatherDataWithoutCityParameter']); // 
//Route::get('forecast_data', [WeatherForecast::class, 'dataWithoutCityParameter']);
Route::get('/forecast_data/{city}', [Showcase::class, 'weatherData']);

//** Redirect to home if URL string is not recognised instead of 404-ing **//
Route::any('/{notrecognised?}', function(){ return redirect("/");})->where('notrecognised', '.*');
