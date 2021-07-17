<?php
use App\Http\Controllers\WeatherFivedayForecast;
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

Route::get('/', [WeatherFivedayForecast::class, 'index']);
Route::get('city/{city}', [WeatherFivedayForecast::class, 'indexWithCity']);
Route::get('forecast_data', [WeatherFivedayForecast::class, 'dataWithoutCityParameter']);
Route::get('forecast_data/{city}', [WeatherFivedayForecast::class, 'data']);
