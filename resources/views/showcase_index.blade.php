
@extends ("template.showcase_template")

@section("page_content")


@if(isset($indexcontent) && $indexcontent === "general")
    @php $homelink_active = true; @endphp
    @section('page_title')
    <h1>Colins Showcase</h1>
    <h2>Welcome visitors</h2>
    @endsection
    
<div class="row"> <!-- index row | START -->
    <div class="col-12 order-2 order-sm-1">
        <h3 id="index-title">This is a website that showcases Colin's skills in web design.</h3><h4>Technologies used include JavaScript, PHP, React.js, HTML, CSS and JQuery</h4>
        <p>See the code repository for the apps on this site at the following location:<br>
        <a href="https://github.com/colinogreen/sho-tech">Colins Showcase code on Github</a></p>
        <hr>
    </div>    
    <div class="col-12 order-1 order-sm-2">
        <p class="d-md-none d-block"><a href="#index-title">More information and a link to<br>the Github repository for this site</a></p>
        <p>View weather data for the UK with this weather application. It uses React.js and JavaScript to display data driven from a PHP back end:<br><a href="{{ route('weatherindex') }}" class="btn btn-weather">Weather for the UK</a></p>
        <hr>
        <p>Using the following application, you can view Covid infection statistics for England, currently updated once a week from the public API at <a href="https://coronavirus.data.gov.uk/">https://coronavirus.data.gov.uk</a>. The data is generated by JavaScript code that processes the data sent from a PHP back end.<br>
            The open source Bootstrap template, sbadmin2 is used as a base design.<br>
            <a href="{{ route("cstats_index") }}" class="btn btn-cstats">Covid Statistics for England</a></p>        
        
    </div>    
</div> <!-- index row | END -->
@endif

@if(isset($weather_links)) 
    @php $weatherlink_active = true; @endphp
    
    <div class="row" style="">
      <div class="col-12 col-sm-offset-2 col-sm-8">
        <h5 class="card-title">UK Five Day Weather Forecast</h5>
        <h6 class="card-subtitle mb-2 text-muted">View weather data for the following areas</h6>

             @foreach($weather_links as $wl)
             <p class="weather_data" style="">{!! $wl['link'] !!} &#160;{!! isset($wl['data'])? '<i class="'.$wl['data']->day_weather_icon.'"></i>' :"" !!}
             {!! isset($wl['data'])? $wl['data']->day_period_temp."&deg;c" :"" !!}</p>
            @endforeach


      </div>
    </div>

@endif

@endsection