<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sahasra Grand</title>
   

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
   
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <!-- <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  -->
    

    
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>    
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <!-- <script src="{{ asset('js/datepicker.js') }}" defer></script> -->
 
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <!-- Bootstrap core CSS -->
     <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/calendar.css') }}" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
              
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <div class="logo">
                               <a href="/"> <img src="{{ asset('/images/logo.png') }}"/></a>
                            </div>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-4 d-flex align-items-center justify-content-end">
                        <div class="input-group">
                                <input type="text" class="form-control" id="booking-code" placeholder="Search Booking Code">
                                <div class="input-group-append">
                                <button class="btn btn-primary" type="button" id="search-book">
                                    <i class="fa fa-search"></i>
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Request::is('admin/*'))
                        <div class="navigation">
                            @component('components.nav')
                            @endcomponent
                        </div>
            @endif
          
            <main class="py-4">
                <div class="main-container">
                    <div class="container">

                        <div class="container-block">
                            <div class="row">
                                <div class="col-12">
                                    <div class="title text-center">
                                        <h2>Welcome to <span>Saharsa Grand</span></h2>
                                    
                                        <div class="row">
                                        <div class="col-2">
                                        </div>
                                        <div class="col-8">

                                        @guest
                                        @else
                                            <marquee style="  scrollamount="6" scrolldelay="90" direction="left" onmouseover="this.stop()" onmouseout="this.start()">
                                            @php
                                                $role = Auth::user()->role;
                                                $tickers = Session::get('tickers');
                                            @endphp
                                            @foreach($tickers as $ticker)
                                                @if($ticker->role == $role || $ticker->role=='all' || $role == 'superadmin')
                                                    <label>{!! html_entity_decode($ticker->ticker_news) !!}
                                                    </label> &emsp; 
                                                @endif
                                            @endforeach
                                            </marquee>
                                        @endguest
                                        
                                        <!-- <input class="form-control search-booking" type="text" name="booking_code" id="booking_code" /> -->
                                        </div>
                                        <div class="col-2">
                                        </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="info-card-block">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-lg-4">
                                        <div class="info-card active">
                                            @guest
                                                <div class="image"><img src="{{ asset('/images/login.png') }}"/> </div>
                                                <div class="button">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-primary w-100">Login</a>
                                                </div>
                                                <div class="button">
                                                
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal"  class="btn btn-secondary w-100">Create an Account</a>
                                                </div>
                                            @else
                                                {{ Auth::user()->role }}
                                                @if(Auth::user()->role == 'superadmin')
                                                    <div class="button">
                                                        <a  href="/admin/home" >Dashboard</a>
                                                    </div>
                                                @endif
                                                <div class="button">
                                                    <a data-bs-toggle="modal" data-bs-target="#changePasswordModal" href="#" >Change Password</a>
                                                </div>
                                                <div class="button">
                                                    <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                </div>
                                            @endguest
                                        </div>
                                    </div>
                                    @yield('content')
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>



</body>
</html>
