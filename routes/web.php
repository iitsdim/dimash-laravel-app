<?php

use GuzzleHttp\Client;
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

Route::get('/', function () {

    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://api.openweathermap.org/',
        // You can set any number of default request options.
        'timeout'  => 10.0,
    ]);

    try {
        $API_FORECAST_KEY = "1c6f33573f2f92814803b74cae54cacd";
        $response = $client->get('data/2.5/onecall?lat=41.39&lon=2.15&units=metric&exclude=current,minutely,hourly&appid='. $API_FORECAST_KEY);
        $forecast = json_decode($response->getBody()->getContents(), true);

        return view('forecast', ['forecast' => $forecast['daily'], 'variables' => ['date',
            'humidity', 'pressure', 'wind_speed', 'clouds', 'min_temp', 'max_temp']]);
    } catch (Exception $e){
        dump($e->getMessage());
    }

});

