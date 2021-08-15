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

    @section('weather_link_active')
    active
    @endsection 
    
<div class="row" style="">
  <div class="col-12 col-sm-offset-2 col-sm-8">
    <h5 class="card-title">UK Five Day Weather</h5>
    <h6 class="card-subtitle mb-2 text-muted">View weather data for the following UK places</h6>

         @foreach($weather_links as $wl)
         <p class="weather_data" style="">{!! $wl['link'] !!} &#160;{!! isset($wl['data'])? '<i class="'.$wl['data']->day_weather_icon.'"></i>' :"" !!}
         {!! isset($wl['data'])? $wl['data']->day_period_temp."&deg;c" :"" !!}</p>
	@endforeach


  </div>
</div>



    
@endif
 </div>
@endsection