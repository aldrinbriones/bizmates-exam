<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Collection;

class WeatherController extends Controller
{    
    public function index()
    {
      return redirect('/weather/tokyo');
    }

    public function find(Request $req, $city){      
      $places = [
        [ 'active' => '', 'name' => 'Tokyo'],
        [ 'active' => '', 'name' => 'Yokohama' ],
        [ 'active' => '', 'name' => 'Kyoto' ],
        [ 'active' => '', 'name' => 'Osaka' ],
        [ 'active' => '', 'name' => 'Sapporo' ],
        [ 'active' => '', 'name' => 'Nagoya']        
      ];      
      
      $city = $city ? $city : 'tokyo';

      foreach($places as $key => $place){
        if(strtolower($place['name']) === strtolower($city)){
          $places[$key]['active'] = 'active'; 
        }
      }
      
      /*
       * Current
       */
      $current = self::getWeather('weather', $city);
      $current->date = carbon::createFromTimeStamp($current->dt)
        ->setTimezone('Asia/Tokyo')
        ->toDayDateTimeString();
      $forecast = self::getWeather('forecast', $city);      

      /*
       *
       */
      $forecasts = self::getWeather('forecast', $city);

      $forecasts = collect($forecasts->list)->take(4)->map(function($value) {        
        $value->date = carbon::createFromTimeStamp($value->dt)
          ->setTimezone('Asia/Tokyo')
          ->toDayDateTimeString();
        return $value;
      });

      return view('index', [
        'places' => $places,
        'current' => $current,
        'forecasts' => $forecasts
      ]);      
    }

    static private function getWeather(String $link, String $city){
      $url = 'http://api.openweathermap.org/data/2.5/'.$link.'?q='.$city.',jp&APPID=1413aeabd7f0c3894a96b4e3ca3edc5d&units=metric&imperial=miles/hour';
      $client = new \GuzzleHttp\Client();
      $response = $client->request('GET', $url);          
      return json_decode($response->getBody());
    }

    
}
