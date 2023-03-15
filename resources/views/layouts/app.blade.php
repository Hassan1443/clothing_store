<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
  <link rel="icon" href="{{ asset('assets/images/cshop_icon.jpeg') }}" type="image/icon type">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">


    {{-- <script src="//cdn.jsdelivr.net/npm/eruda"></script>
    <script>eruda.init();</script> --}}
    <!-- Bootstrap core CSS -->
    <link href='{{asset("vendor/bootstrap/css/bootstrap.min.css")}}' rel="stylesheet">


    <!-- Styles -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">

<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset("assets/css/fontawesome.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/templatemo-sixteen.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/owl.css") }}">

  </head>
<style>
.center {
  margin: auto;
  width: 60%;

  padding: 10px;
}
</style>

<script>

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 5000);
</script>
  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
          <div class="container">

              <a class="navbar-brand" href="{{ url('home') }}"><h2>Raza & Sons <em>Fabrics</em></h2></a>



          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>

          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('home') }}">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item {{ (request()->is('products')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('products') }}">Our Products</a>
              </li>
              <li class="nav-item {{ (request()->is('about')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('about')  }}">About Us</a>
              </li>

              @if( Auth::user())
              <li class="nav-item">
                 <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
               </li>
               @endif
              <li class="nav-item">

                            <form id="logout-frm" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                <input type="submit" class="nav-item" name="logout" value="Logout">
                            </form>
              </li>
              @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif

              @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                    <!--   </li>
                    <li class="nav-item">
                                         -->    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

              @endguest
              <li class="nav-item">
                <a class="nav-link" href="{{ url('cart') }}" style="text-decoration: none; color:orange;">Cart {{ Cart::getTotalQuantity() }}<span class="glyphicon glyphicon-shopping-cart"></span></a>
              </li>

            </ul>
          </div>
        </div>
      </nav>

    </header>

    <div class="container">
        <br><br><br><br>

@if (session('addCrtScs'))
   <div class="alert alert-success" role="alert" style="float:right;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong>  {{ session('addCrtScs') }}
</div>
@endif

@if (session('status'))
   <div class="alert alert-success" role="alert" style="float:right;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong>  {{ session('status') }}
</div>

@endif

@if (session('remScs'))
   <div class="alert alert-success" role="alert" style="float:right;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong>  {{ session('remScs') }}
</div>

@endif

@if (session('updScs'))
   <div class="alert alert-success" role="alert" style="float:right;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong>  {{ session('updScs') }}
</div>

@endif

@if (session('clrScs'))
   <div class="alert alert-success" role="alert" style="float:right;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong>  {{ session('clrScs') }}
</div>

@endif
@if (session('ordRcvd'))
   <div class="alert alert-success" role="alert" style="float:right;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong>  {{ session('ordRcvd') }}
</div>

@endif



        @yield('content')
    </div>

    <div class="container">
        @yield('products')
    </div>










  <!-- <div class="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <div class="row">
                <div class="col-md-8">
                  <h4>Creative &amp; Unique <em>Sixteen</em> Products</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque corporis amet elite author nulla.</p>
                </div>
                <div class="col-md-4">
                  <a href="#" class="filled-button">Purchase Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  -->


    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <p>Copyright &copy; 2022
            - Design: </p>
            </div>
          </div>
        </div>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset("vendor/jquery/jquery.min.js") }}"></script>
    <script src="{{ asset("vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>


    <!-- Additional Scripts -->
    <script src="{{ asset("assets/js/custom.js") }}"></script>
    <script src="{{ asset("assets/js/owl.js") }}"></script>
    <script src="{{ asset("assets/js/slick.js") }}"></script>
    <script src="{{ asset("assets/js/isotope.js") }}"></script>
    <script src="{{ asset("assets/js/accordions.js") }}"></script>
    <script src="{{ asset('js/app.js') }}" ></script>



    <script language = "text/Javascript">
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>


  </body>

</html>
