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
      @yield("page_content")  
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