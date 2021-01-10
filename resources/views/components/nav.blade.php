    @php
        $user = \Illuminate\Support\Facades\Auth::user();
    @endphp
      
    <nav class="navbar side-bar">

        <div class="logo">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{URL::to('/')}}/images/logo-white.png" />
            </a>
            @if(isset($user->username))
              <div class="user-cls"> {{ $user->username }} </div>
           @endif
        </div>
        
        <nav class="side-bar-link w-100">
        
        </nav>

        <nav class="side-bar-link logout w-100">
            <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </nav> 


{{--    <nav class="logout">--}}
{{--        <!-- Left Side Of Navbar -->--}}
{{--        <ul class="navbar-nav mr-auto ">--}}

{{--        </ul>--}}

        <!-- Right Side Of Navbar -->
{{--        <ul class="navbar-nav ml-auto">--}}
{{--            <!-- Authentication Links -->--}}
{{--            @guest--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                </li>--}}
{{--                @if (Route::has('register'))--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                    </li>--}}
{{--                @endif--}}
{{--            @else--}}
{{--                <li class="nav-item">--}}
{{--                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                        {{ Auth::user()->name }} <span class="caret"></span>--}}
{{--                    </a>--}}

{{--                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                        <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                           onclick="event.preventDefault();--}}
{{--                                                         document.getElementById('logout-form').submit();">--}}
{{--                            {{ __('Logout') }}--}}
{{--                        </a>--}}

{{--                        <form id="logout-form" action="{{ route('logout') }}" method="POST">--}}
{{--                            @csrf--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            @endguest--}}
{{--        </ul>--}}
{{--    </div>--}}

    </nav>
    <style>
    .user-cls{
        color:white;
        text-align:center;
    }
    </style>

    <script>
        $(document).ready(function () {
            $('.child-nav').each(function () {
                if ($(this).hasClass('active')) {
                    $(this).parent().removeClass('collapse');
                }
            });
        });

        // $('.collapse').collapse();
        // $('.collapse1').collapse();
        // $('.collapsemnfst').collapse();

    </script>


