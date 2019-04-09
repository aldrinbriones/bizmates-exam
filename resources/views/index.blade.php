<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>OpenWeatherMap</title>

    <meta name="Description" content="PitchTimer is a simple countdown timer.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="title" content="PitchTimer">
    <link rel="stylesheet" href={{ asset('css/app.css')}} type="text/css" media="screen" title="Normal">
    <link rel="stylesheet" href={{ asset('css/custom.css')}} type="text/css" media="screen" title="Normal">
  </head>

  <body>    
    <div class="container">
      <nav class="navbar">
        <span class="navbar-brand">Japan Weather Forecast</span>
      </nav>    

      <div class="jumbotron">
        <div class="row">
          <div class="col-md-3 col-xs-4">
            <div class="list-group" id="cities">
              <a class="list-group-item disabled text-center" href="#">SELECT A CITY</a>  
              @foreach($places as $place)
              <a class="list-group-item {{$place['active']}}" href="/weather/{{ strtolower($place['name']) }}">{{ $place['name'] }}</a>              
              @endforeach              
            </div>
          </div>

          <div class="col-md-9 col-xs-8" id="current">
            <div class="card header">
              <div class="card-header text-center"><h4>NOW</h4> at {{ $current->name}} , Japan</div>
            </div>
            <div class="card flex-row flex-wrap">
              <div class="card-header col-md-4 col-sm-6 card-img">
                <img style="width:100%" src="{{ sprintf('https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/widgets/%s.png', $current->weather[0]->icon) }}" alt="">                
              </div>
              <div class="card-body col-md-8 col-sm-6">                
                <h4 class="card-title text-center mt-2 title">{{ $current->weather[0]->description }}</h4>
                <h5 class="card-title text-center">{{ $current->date }}<h5>
                <p class="card-text mt-2"><strong>Temperature:</strong> {{ $current->main->temp }} &#8451;</p>
                <p class="card-text"><strong>Humidity:</strong> {{ $current->main->humidity }} &#37;</p>
                <p class="card-text"><strong>Wind:</strong> {{ $current->wind->speed }} m/s</p>                                    
              </div>              
            </div>
          </div>  

          <div class="col-sm-12">
            <h1 class="forecast-header mt-2"> Next Forecasts</h1>
          </div>          
        </div>


        <div class="row" id="forecast">            
            @foreach($forecasts as $forecast)
            <div class="col-sm-6 mt-3">            
              <div class="card flex-row flex-wrap">
                <div class="card-header col-md-4 col-sm-6 card-img">
                  <img src="{{ sprintf('https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/widgets/%s.png', $forecast->weather[0]->icon) }}" alt="">                
                </div>
                <div class="card-body col-md-8 col-sm-6">                
                  <h4 class="card-title text-center title">{{ $forecast->weather[0]->description }}</h4>
                  <h5 class="card-title text-center">{{ $forecast->date }}<h5>
                  <p class="card-text"><strong>Temperature:</strong> {{ $forecast->main->temp }} &#8451;</p>
                  <p class="card-text"><strong>Humidity:</strong> {{ $forecast->main->humidity }} &#37;</p>
                  <p class="card-text"><strong>Wind:</strong> {{ $forecast->wind->speed }} m/s</p>                                    
                </div>              
              </div>   
            </div>
            @endforeach
            
          </div>



      </div>
    </div>
  </body>
</html>
