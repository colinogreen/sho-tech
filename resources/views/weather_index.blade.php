@php

        $precip = "fas fa-tint";
        $temph = "fas fa-temperature-high";
        $templ = "fas fa-temperature-low";
        $wind = "fas fa-wind";
@endphp
@extends ("template.weathertemplate")

@section("page_content")
<div class="container">
 <h3>Five Day Forecast</h3> 
        <div id="div_clock"></div>
        <div id="div_weather_data"></div>
        <div id="div_test"></div>
 

</div>
@endsection


<?php 
/*
 * <script type="text/babel">
class ShoppingList extends React.Component {
  render() {
    return (
      <div className="shopping-list">
        <h1>Shopping List for {this.props.name}</h1>
        <ul>
          <li>Instagram</li>
          <li>WhatsApp</li>
          <li>Oculus</li>
        </ul>
      </div>
    );
  }
}
ReactDOM.render(<ShoppingList />, document.getElementById('div_test'));
</script>

 * <div class="container">
     <div class="" style="border:2px solid #ccc; border-radius: 8px">
     <div class="row">
         <div class="col-12 offset-md-8 col-md-4">
             <h5 style=""><i class="fas fa-clock"></i>Last Update:{{$cityWeather->getDailyForecastLastUpdate()}}</h5>
         </div>
     </div>
    <div class="weather_table">
    <div class="row">
       <div class="offset-1 col-2"><h4>{{$cityWeather->getDayOfWeek(1)}}</h4><span>{{$cityWeather->getDaySignificantWeatherCode(1)}}</span></div>  <div class="col-2">
           <h4>{{$cityWeather->getDayOfWeek(2)}}</h4><span>{{$cityWeather->getDaySignificantWeatherCode(2)}}</span></div> 
           <div class="col-2"><h4>{{$cityWeather->getDayOfWeek(3)}}</h4><span>{{$cityWeather->getDaySignificantWeatherCode(3)}}</span></div> 
           <div class="col-2"><h4>{{$cityWeather->getDayOfWeek(4)}}</h4><span>{{$cityWeather->getDaySignificantWeatherCode(4)}}</span></div> <div class="col-2"><h4>{{$cityWeather->getDayOfWeek(5)}}</h4>
               <span>{{$cityWeather->getDaySignificantWeatherCode(5)}}</span></div> 
    </div>
    <div class="row temp-high">
       <div class="offset-1 col-2"><i class="{{$temph}}"></i> &#160;<span>{{$cityWeather->getDayHighestTemp(1)}} &deg;</span></div>  <div class="col-2"><i class="{{$temph}}"></i> &#160;<span>{{$cityWeather->getDayHighestTemp(2)}} &deg;</span></div> 
           <div class="col-2"><i class="{{$temph}}"></i> &#160;<span>{{$cityWeather->getDayHighestTemp(3)}} &deg;</span></div> <div class="col-2"><i class="{{$temph}}"></i> &#160;<span>{{$cityWeather->getDayHighestTemp(4)}} &deg;</span></div> 
               <div class="col-2"><i class="{{$temph}}"></i> &#160;<span>{{$cityWeather->getDayHighestTemp(5)}} &deg;</span></div> 
    </div>
    <div class="row temp-low">
       <div class="offset-1 col-2"><i class="{{$templ}}"></i> &#160;<span>{{$cityWeather->getDayLowestTemp(1)}} &deg;</span></div>  <div class="col-2"><i class="{{$templ}}"></i> &#160;<span>{{$cityWeather->getDayLowestTemp(2)}} &deg;</span></div> 
           <div class="col-2"><i class="{{$templ}}"></i> &#160;<span>{{$cityWeather->getDayLowestTemp(3)}} &deg;</span></div>
           <div class="col-2"><i class="{{$templ}}"></i> &#160;<span>{{$cityWeather->getDayLowestTemp(4)}} &deg;</span></div> <div class="col-2"><i class="{{$templ}}"></i> &#160;<span>{{$cityWeather->getDayLowestTemp(5)}} &deg;</span></div> 
    </div>
    <div class="row">
       <div class="offset-1 col-2"><i class="{{$precip}}"></i> &#160;{{$cityWeather->getDayChanceOfRain(1)}}%</div>  <div class="col-2"><i class="{{$precip}}"></i> &#160;{{$cityWeather->getDayChanceOfRain(2)}}%</div> 
           <div class="col-2"><i class="{{$precip}}"></i> &#160;{{$cityWeather->getDayChanceOfRain(3)}}%</div> <div class="col-2"><i class="{{$precip}}"></i> &#160;{{$cityWeather->getDayChanceOfRain(4)}}%</div> 
               <div class="col-2"><i class="{{$precip}}"></i> &#160; {{$cityWeather->getDayChanceOfRain(5)}}%</div> 
    </div> 
    <div class="row">
       <div class="offset-1 col-2"><i class="{{$wind}}"></i> &#160;{{$cityWeather->getDayWindSpeed(1)}} mph</div>  <div class="col-2"><i class="{{$wind}}"></i> &#160;{{$cityWeather->getDayWindSpeed(2)}} mph</div> 
           <div class="col-2"><i class="{{$wind}}"></i> &#160;{{$cityWeather->getDayWindSpeed(3)}} mph</div> <div class="col-2"><i class="{{$wind}}"></i> &#160;{{$cityWeather->getDayWindSpeed(4)}} mph</div> 
               <div class="col-2"><i class="{{$wind}}"></i> &#160;{{$cityWeather->getDayWindSpeed(5)}} mph</div> 
    </div>   
    </div>

     </div>
          @php
         if($cityWeather->getLastApiUpdate())
         {
            print("<p style=\"font-size:0.8em; font-style:italic\">Last api update: ".$cityWeather->getLastApiUpdate()."</p>");
         }
         @endphp
 </div>
 */

?>
