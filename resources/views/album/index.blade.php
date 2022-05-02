@php
if(!isset($apps)){
    $apps = [];
    $std = new \stdClass;
    $std->image = "covid_1_225h.jpg";
    $std->route = "cstats_index";
    $std->description = "Testing \stdClass supply";
     $apps[] = $std;
}
$offset_md = 2;
$cols_md = isset($cols_md)? " col-md-". $cols_md ." ": " col-md-5 ";
@endphp
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Technohelp - Useful Apps for the modern age</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">

    

    <!-- Bootstrap core CSS -->
<link href="/css/app.css?v=0.67" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
  </head>
  <body>
    
<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="text-white col-sm-8 col-md-7 py-4">
        <h4>This is a website that showcases Colin's skills in web design.</h4><p>Technologies used include JavaScript, PHP, React.js, HTML, CSS and JQuery</p>
        <p>See the code repository for the apps on this site at the following location:<br>
        <a href="https://github.com/colinogreen/sho-tech">Colins Showcase code on Github</a></p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contact</h4>
          <ul class="text-white list-unstyled">
            <li>Contacts to be confirmed...</li>
           <?php /* <li><a href="#" class="text-white">Follow on Twitter</a></li>
            <li><a href="#" class="text-white">Like on Facebook</a></li>
            <li><a href="#" class="text-white">Email me</a></li> */ ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="{{ route("site_index") }}" class="navbar-brand d-flex align-items-center">
    <img src="/img/technohelp1.svg" width="20" height="20" /> 
        &#160;<strong>Technohelp</strong>

      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
    
</header>

<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Technohelp</h1>
        <p class="lead text-muted">Useful applications for the 21st Century.</p>
        <p>
          <a href="{{ route('site_index_old') }}" class="btn btn-primary my-2">Original Menu</a>
          <?php //<a href="#" class="btn btn-secondary my-2">Secondary action</a> ?>
        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    @foreach($apps as $app)

        <div class="col{{$app->col_class}}">
          <div class="card shadow-sm">
             @if(isset($app->image) && !empty($app->image))
            <img src="/img/{{ $app->image }}" />
            @else
             <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
             <title>Coming Soon</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Other Content to appear here</text></svg> 
            @endif
            <div class="card-body">
              <p class="card-text">{{ $app->description }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="{{ route($app->route) }}">View</a></button>
                  <?php //<button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> ?>
                </div>
                <small class="text-muted"></small>
              </div>
            </div>
          </div>
        </div>    
    @endforeach     
        
      </div>
    </div>
  </div>

</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
    <p class="mb-1">Expand the menu at the top right of the screen for further information on this web site!</p>

  </div>
</footer>


    <script src="/js/app.js"></script>

      
  </body>
</html>
