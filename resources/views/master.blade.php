<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
{{--
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap-grid.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">--}}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/mystyle.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.css') }}">


        <!-- Pre Template Themes -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/csscustom.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/overrides.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.cssemoticons.css') }}">
        
        
        <!-- Scripts -->

        @include('partials.myjs')
        @stack('topscripts')
    </head>
    <body>
        @if(Session::has('successMessage'))
        <script type="text/javascript">
            toastr["success"]("{{ Session::get('successMessage')}}");
        </script>
        @endif
        @if(Session::has('errorMessage'))
        <script type="text/javascript">
            toastr["error"]("{{ Session::get('errorMessage')}}");
        </script>
        @endif
        @if(Session::has('popupMessage'))
        <script type="text/javascript">
        $(document).ready(function() {
            $("#{{ Session::get('popupMessage')}}").modal("show");
        });
        </script>
        @endif
        


  <style>



.navlink{   clear: both;color: white;display: block;font-weight: bold;line-height: 1.42857;padding: 1px 8px;white-space: nowrap;}

.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus {

    background-color: #c60000;

    color: #ffffff;

    text-decoration: none;

}



.nav > li > a {

color: black;

    display: block;

    font-weight: normal;

    margin-left: 10px;

    padding: 0 14px;

    position: relative;

    font-size: 16px;

}



.nav-menu li{



    margin-left: 0px;



}



.dropdown-menu > li > a {

    width: 240px;

    padding: 0 15px;

    line-height: 24px;

     font-size: 14px;

}



.sidebar-nav {

    padding: 9px 0;

}



.dropdown-menu .sub-menu {

    left: 100%;

    position: absolute;

    top: 0;

    visibility: hidden;

    margin-top: -1px;

}



.dropdown-menu li:hover .sub-menu {

    visibility: visible;

}



.dropdown:hover .dropdown-menu {

    display: block;

}



.nav-tabs .dropdown-menu, .nav-pills .dropdown-menu, .navbar .dropdown-menu {

    margin-top: 0;

}





.dropdown-menu {

    background-color: #white;

    border:none;

    box-shadow:none;

    }



@if (Auth::guest())

@if (Request::path() == "/")



.arrow_box {

    border: 4px solid #ffffff;

}

.arrow_box:after, .arrow_box:before {

    bottom: 100%;

    left: 50%;

    border: solid transparent;

    content: " ";

    height: 0;

    width: 0;

    position: absolute;

    pointer-events: none;

}



.arrow_box:after {

    border-color: rgba(0, 0, 0, 0);

    border-bottom-color: #;

    border-width: 7px;

    margin-left: -7px;

}

.arrow_box:before {

    border-color: rgba(255, 255, 255, 0);

    border-bottom-color: #ffffff;

    border-width: 13px;

    margin-left: -13px;

}

@else

.arrow_box {

    border: 2px solid #29af97;

}

.arrow_box:after, .arrow_box:before {

    bottom: 100%;

    left: 50%;

    border: solid transparent;

    content: " ";

    height: 0;

    width: 0;

    position: absolute;

    pointer-events: none;

}



.arrow_box:after {

    border-color: rgba(0, 0, 0, 0);

    border-bottom-color: #;

    border-width: 7px;

    margin-left: -7px;

}

.arrow_box:before {

    border-color: rgba(41, 175, 151, 0);

    border-bottom-color: #29af97;

    border-width: 13px;

    margin-left: -13px;

}

@endif

@else

.arrow_box {

    border: 2px solid #29af97;

}

.arrow_box:after, .arrow_box:before {

    bottom: 100%;

    left: 50%;

    border: solid transparent;

    content: " ";

    height: 0;

    width: 0;

    position: absolute;

    pointer-events: none;

}



.arrow_box:after {

    border-color: rgba(0, 0, 0, 0);

    border-bottom-color: #;

    border-width: 7px;

    margin-left: -7px;

}

.arrow_box:before {

    border-color: rgba(41, 175, 151, 0);

    border-bottom-color: #29af97;

    border-width: 13px;

    margin-left: -13px;

}

@endif



.redsmall{color:red;padding-left: 15px;font-size: 11px;}





a.btn_login{background:#c60000; color:#fff; border:none; border-radius:3px; padding:6px 16px;}

a.btn_login:hover{background:#005baa; color:#fff;}

a.btn_login:focus{background:#c60000; color:#fff;}



a.btn_sign_up{background:#005baa; color:#fff; border:none; border-radius:3px; padding:6px 16px;}

a.btn_sign_up:hover{background:#c60000; color:#fff;}

.nav-pills > li + li{margin-top:-3px;}

 </style>







<style>

   @media (max-width: 767px){

       .navbar-default .navbar-brand{top: 16%!important;}

   .search_bar {top: 45%!important;} }

    </style>


<span id='topnavloader'>

  <input name="go_to_after_login" id="go_to_after_login" type="hidden" value="">

  <nav class="navbar navbar-default" style="height: 70px;">

    <div class="container headerpadding">

      <div class="row">

        <div class="col-md-3">

          <a href="{{ route('dashboard') }}" class="navbar-brand"><img style="margin-left: 5px;" src="{{ asset('img/logo.png') }}" alt="" border="0"></a>

        </div>

        <div class="col-md-9" id="div_f068_0">

          <div class="search_bar">

            <div class="dropdown">

              <div class="search_icon edu-bg-blue dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img id="imgnav" src="{{ asset('img/icons/1.png') }}" alt="" border="0">
              </div>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a onclick="switchSearch('6')" href="#"><img src="{{ asset('img/icons/1.png') }}" alt="" border="0"> All</a></li>
                <li><a nclick="switchSearch('0')" href="#"><img src="{{ asset('img/icons/2.png') }}" alt="" border="0"> MarketPlace</a></li>
                <li><a onclick="switchSearch('1')" href="#"><img src="{{ asset('img/icons/3.png') }}" alt="" border="0"> Students</a></li>
                <li><a onclick="switchSearch('2')" href="#"><img src="{{ asset('img/icons/4.png') }}" alt="" border="0"> Teachers</a></li>
                <li><a onclick="switchSearch('3')" href="#"><img src="{{ asset('img/icons/5.png') }}" alt="" border="0"> Institutes</a></li>
                <li><a onclick="switchSearch('4')" href="#"><img src="{{ asset('img/icons/6.png') }}" alt="" border="0"> Groups</a></li>
                <li><a onclick="switchSearch('5')" href="#"><img src="{{ asset('img/icons/7.png') }}" alt="" border="0"> Scholarships</a></li>
                <li><a onclick="switchSearch('7')" href="#"><img src="{{ asset('img/icons/8.png') }}" alt="" border="0"> Internships</a></li>
              </ul>

            </div>

            <div id="custom-search-input">
              <div class="input-group col-md-9">

                {!! Form::open(array('route' => 'home', 'method' => 'get' , 'id' =>'searchfrm')) !!}
                    <input  name="query" style="font-family: 'pt sans';font-size: 17px;" type="text" class="query form-control form-control-nc" placeholder="Search for Books , Teacher , School ..." />
                    <input name="search_type" id="search_type" type="hidden" value="6">
                {!! Form::close() !!}

                <span class="input-group-btn">
                    <div class="search_icon edu-bg-blue"><a href="#" onclick="$('#searchfrm').submit()"><img src="{{ asset('img/icons/search.png') }}" alt="" border="0"></a></div>
                </span>

              </div>
            </div>
         </div>

         <script>
          function switchSearch(id) {
            $("#search_type").val(id);
            $(".query").focus();
            $('#imgnav').attr("src", "{{asset('img/icons/')}}/"+id+".png");
            }
         </script>
            <ul>
              <li class="pull-right">
                  @if (Auth::check()) 
                    <div class="light-em-up">
                      <div class="liem-content">
                         <div class="avatar-wrapper" id="nav1">
                           <a href="#">
                             <img class="img-rounded" src="{{asset('img/profile')}}/{{ $user->account_image ? $user->account_image : "blank.png" }}">
                           </a>
                         </div>
                          <div class="opensans block-links" id="nav2">
                           <a href="#">{{ $user->name }}</a>
                           <a href="{{ route('logoutMethod') }}">Logout</a>
                        </div>
                      </div>
                    </div>
                  @else
                    <div id="mainlogin" class="text-right header-buttons light-em-up">
                      <a class="btn btn-default btn-sm btn_login" data-toggle="modal" data-target="#nav-login-dialog">Login</a>
                      <a class="btn btn-default btn-sm btn_sign_up" data-toggle="modal" data-target="#nav-signup-dialog">Sign Up</a>
                    </div>                  
                  @endif
              </li>
            </ul>
          </div>
        </div>
      </div>
  </nav>
</span>


{{-- End Of Header--}}
@yield('content')
{{-- Start Of Footer--}}
@include('partials.header_modals')

        <!-- Bottom Scripts -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="{{ asset('js/toastr.js') }}"></script>
        <!-- Pre Template Theme -->
        <script src="{{ asset('js/morphext.js') }}"></script>
        <script src="{{ asset('js/ekko-lightbox.min.js') }}"></script>
        <script src="{{ asset('js/jquery.timeago.js') }}"></script>
        <script src="{{ asset('js/jquery.form.js') }}"></script>
        <script src="{{ asset('js/flip.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="{{ asset('js/jquery.cssemoticons.js') }}"></script>


        <!-- End Pre Template Theme -->

        
        @include('partials.analyticstracking')
        @stack('bottomscripts')
        <script>
          $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
          });
        </script>
    </body>
</html>
