<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? "Showcase" }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}?v={{ config('app.cssversion') }}" rel="stylesheet">
    </head>   
    <body>
 
<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link{{ isset($homelink_active)? " active": "" }}" href="{{ route('site_index') }}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link{{ isset($weatherlink_active)? " active": "" }}" href="{{ route('weatherindex') }}">Weather Data</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('cstats_index') }}">Covid Stats UK</a>
      </li>

     <?php /*  <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> */?>
    </ul>
  </div>
  <div class="card-body card-body-showcase">
    <div class="container">  
    @hassection('page_title')
        @yield('page_title')
    @endif
    
    @if(env('APP_DEBUG'))
    
    <p style="font-weight:bold; font-style:italic; color:orangered"><br>Laravel v.{{app()->version()}}</p>
    @endif
    @hassection('page_content')
        @yield("page_content") 
    
    @endif
     </div>  
  </div>
</div>
      <script src="{{ asset('js/app.js') }}?v={{ config('app.jsversion') }}"></script>

    </body>
</html>