<?php

?>
@extends ("template.showcase_template")

@section("page_content")
<div class="container">
    
    <h3>Covid Stats</h3>
    <div id="covid_data"></div>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    //$("#covid_data").html("Changed by JQuery");
      $.ajax({url: "/cvstats", dataType:"json", success: function(result){
         console.log(result);
         console.log(result.data[0].date);
        $("#covid_data").html($("#covid_data").html() + result);
  }});
});

    
    
    </script>

</div>
@endsection