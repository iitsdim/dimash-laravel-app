<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public $variables = ['date', 'humidity', 'pressure', 'wind_speed', 'clouds', 'min_temp', 'max_temp'];
    public static $order = // '' means next sorting will be increasing, '-' means it will be decreasing
        [
            'date' => '-',
            'humidity' => '',
            'pressure' => '',
            'wind_speed' => '',
            'clouds' => '',
            'min_temp' => '',
            'max_temp' => ''
        ];

    public function show_forecast(Request $request)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.openweathermap.org/',
            // You can set any number of default request options.
            'timeout' => 10.0,
        ]);

        $API_FORECAST_KEY = "1c6f33573f2f92814803b74cae54cacd";
        $response = $client->get('data/2.5/onecall?lat=41.39&lon=2.15&units=metric&exclude=current,minutely,hourly&appid=' . $API_FORECAST_KEY);
        $forecast = json_decode($response->getBody()->getContents(), true)['daily'];

        foreach ($forecast as &$day) {
            $day['date'] = \Carbon\Carbon::createFromTimeStamp($day['dt'])->toDateString();
            $day['min_temp'] = $day['temp']['min'];
            $day['max_temp'] = $day['temp']['max'];
            unset($day['dt']);
            unset($day['temp']);
        }

        $sort_by = $request->input('sortby', null);


        if ($sort_by === null)
            $sort_by = 'date';

        $direction = 'ASC';

        if ($sort_by[0] == '-') {
            $direction = 'DESC';
            $sort_by = substr($sort_by, 1);
            self::$order[$sort_by] = '';
        } else {
            self::$order[$sort_by] = '-';
        }


        usort($forecast, function ($a, $b) use ($sort_by) {
            if ($a[$sort_by] == $b[$sort_by])
                return 0;
            if ($a[$sort_by] < $b[$sort_by])
                return -1;
            return 1;
        });

        if ($direction == 'DESC')
            $forecast = array_reverse($forecast);

        return view('forecast', [
            'forecast' => $forecast,
            'variables' => $this->variables,
            'order' => self::$order
        ]);

    }
}
