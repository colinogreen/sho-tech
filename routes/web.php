<?php
use App\Library\WeatherForecast;
use App\Http\Controllers\Showcase;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Showcase::class, 'index'])->name("showcaseindex");

Route::get('/greeting', function () {
    return 'Hello World';
});

//Route::get('/{city}', [WeatherFivedayForecast::class, 'myGreeting']);
    Route::get('weather/{city}', [Showcase::class, 'indexWeatherWithCity']); // indexWeatherWithCity dataWithoutCityParameter data
    Route::get('weather', [Showcase::class, 'indexWeather'])->name("weatherindex");

    Route::get('forecast_data', [Showcase::class, 'dataWithoutCityParameter']); // 
    //Route::get('forecast_data', [WeatherForecast::class, 'dataWithoutCityParameter']);
    Route::get('forecast_data/{city}', [Showcase::class, 'data']);
    //Route::get('forecast_data/{city}', [WeatherForecast::class, 'data']);
