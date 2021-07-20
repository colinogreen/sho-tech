@php

        $precip = "fas fa-tint";
        $temph = "fas fa-temperature-high";
        $templ = "fas fa-temperature-low";
        $wind = "fas fa-wind";
@endphp
@extends ("template.showcase_template")

@section("page_content")
<div class="container">

@if(isset($indexcontent) && $indexcontent === "general")
    @section('page_title')
    Welcome visitor.
    @endsection
    @section('home_link_active')
    active
    @endsection 
<p>This is Colin's Showcase pages.</p>
<p>Click on any links you can see on the top tab to view existing apps.</p>
@endif

@if(isset($weather_links)) 
    @section('page_title')
    Weather Data - Selected UK Towns and Cities
    @endsection
    @section('weather_link_active')
    active
    @endsection 
<div class="card bg-light mb-3" style="max-width: 24rem;">
  <div class="card-header">UK Five Day Weather</div>
  <div class="card-body">

    <p class="card-text">View weather data for the following UK places:</p>
    <ul class="list-group">

  
     @foreach($weather_links as $link)
     <li class="list-group-item">{!! $link !!}</li>
	@endforeach
     </ul>
  </div>

    
    </div>
    </div>
@endif
@endsection


<?php 
/* 
  //print("<pre>".print_r($weather_links, true)."</pre>");
 * <script>
	var url_string = window.location.pathname.split("/city/")[0];
	console.log("url string in blade: " + url_string);
	
	url_string = window.location.pathname.split("/city/")[1];
	console.log("url string in blade: " + url_string);
	console.log(window.location.pathname.split("/city/"));
</script>

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
