
<?php
/**
 * May 2024 | Display page version.
 */

 //echo phpversion();
?>
@extends ("template.showcase_template")

@section("page_content")
    <div class="container">

        <ul class="nav nav-tabs">

    </ul>

     <div class="row">
         <div class="col-sm-12">
             <br><h3>CMS index</h3>
                 <p style="font: italic 600 0.9em arial,sans-serif;color:#595959">Laravel version: {{ app()->version() }}</p>
                 PHP version:{{ phpversion()}}
         </div>

     </div>
 </div>
@endsection
