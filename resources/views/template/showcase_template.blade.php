<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? "Showcase" }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}?v=1" rel="stylesheet">
    </head>   
    <body>
    
<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link @yield('home_link_active')" href="{{ route('showcaseindex') }}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @yield('weather_link_active')" href="{{ route('weatherindex') }}">Weather Data</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <h5 class="card-title">@yield('page_title', 'Default Title')</h5>
    @yield("page_content") 
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
       
      <script src="{{ asset('js/app.js') }}?v=1"></script>

    <script type="text/babel">
/*
      class Hello extends React.Component {
        render() {
          return <h1>Hello World!</h1>;
        }
      };

      ReactDOM.render(<Hello />, document.getElementById('mydiv'))
*/
    </script>

    </body>
</html>