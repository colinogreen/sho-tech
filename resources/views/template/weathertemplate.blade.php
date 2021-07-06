<?php

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Weather: Five day forecast</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>   
    <body>
      @yield("page_content")  
      <script src="{{ asset('js/app.js') }}"></script>
      
  <?php // <script src="https://unpkg.com/react@16/umd/react.production.min.js"></script> ?>
  <?php // <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script> ?>
 <?php // <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script> ?>
    <script type="text/babel">

      class Hello extends React.Component {
        render() {
          return <h1>Hello World!</h1>;
        }
      };

      ReactDOM.render(<Hello />, document.getElementById('mydiv'))
    </script>
    </body>
</html>