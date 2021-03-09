<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
   

    
    
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
                        <div class="col-md-6">
                            <div class="logo">
                               <a href="/"> <img src="{{ asset('/images/logo.png') }}"/></a>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4 filter-book align-items-center justify-content-end">
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
                                        
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                

                            </div>
                            <div class="info-card-block user-blade">
                                <div class="row">

                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
                                        </ol>
                                    </nav>
                                   
                                    @yield('content')
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
   
    <div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p>Copyright © 2021 Sahasra Grand</p>
                <p>Designed and Developed by NetiApps</p>

            </div>
        </div>
    </div>
</div>

</body>
<style>
    li.breadcrumb-item {
    border: 1px solid gainsboro;
    padding: 0px 10px;
    margin-left: 4px;
    cursor: pointer;
    
}
li.breadcrumb-item a{
text-decoration:none !important;
}
.user-blade .info-card.active {
    box-shadow: none;
    min-height: 230px;
}
.count-lbl {
    font-size: 50px;
    text-align: center;
}
label.heading-lbl {
    font-size: 22px;
    text-align: center;
}
</style>
</html>
