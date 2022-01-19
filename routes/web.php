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

Route::get('/', function ( Illuminate\Http\Request $request) {
    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://api.openweathermap.org/',
        // You can set any number of default request options.
        'timeout' => 10.0,
    ]);

    try {
        $API_FORECAST_KEY = "1c6f33573f2f92814803b74cae54cacd";
        $response = $client->get('data/2.5/onecall?lat=41.39&lon=2.15&units=metric&exclude=current,minutely,hourly&appid=' . $API_FORECAST_KEY);
        $forecast = json_decode($response->getBody()->getContents(), true)['daily'];

        foreach ($forecast as &$day){
            $day['date'] = \Carbon\Carbon::createFromTimeStamp($day['dt'])->toDateString();
            $day['min_temp'] = $day['temp']['min'];
            $day['max_temp'] = $day['temp']['max'];

            unset($day['dt']);
            unset($day['temp']);
        }

        $sort_by = $request->input('sortby', 'date');


        $order_of_sort = 1;
        //# ASC order
        if ($sort_by[0] == '-') {
            $order_of_sort = -1;
            // DESC order
            $sort_by = substr($sort_by, 1);
        }

        usort($forecast, function ($a, $b) use ($sort_by, $order_of_sort) {
            if ($a[$sort_by] < $b[$sort_by]) {
                return -1 * $order_of_sort;
            }
            if ($a[$sort_by] > $b[$sort_by]) {
                return 1 * $order_of_sort;
            }
            return 0;
        });

        return view('forecast', ['forecast' => $forecast, 'variables' => ['date',
            'humidity', 'pressure', 'wind_speed', 'clouds', 'min_temp', 'max_temp']]);
    } catch (Exception $e) {
        dump($e->getMessage());
    }

});

