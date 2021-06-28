<?php
//  <p>Min temp: <?= $city_weather->getDayLowestTemp(0) </p>
/*    <p>Data</p><pre><?= $result ?></pre> */
?>
@extends ("template.weathertemplate")

@section("page_content")
<div class="container">
 <h3>Five Day Forecast</h3>  


 <div class="container">
     <div clas="" style="border:2px solid #ccc; border-radius: 8px">
     <div class="row">
         <div class="col-12 offset-md-8 col-md-4">
             <h5 style=""><i class="fas fa-clock"></i> Last Update: <?= $last_update ?></h5>
         </div>
     </div>
    <div class="weather_table">
        
        <?= $weather_data ?>
    </div>
     </div>
 
 </div>

</div>


@endsection