    @php
        $user = \Illuminate\Support\Facades\Auth::user();
    @endphp
      
    <nav class="navbar side-bar">

<div class="logo">
    

<nav class="side-bar-link w-100">
        <a class="nav-link active" href="/admin/home"><img src="/images/dashboard.png"> Dashboard</a>
        <a class="nav-link " href="/admin/user-list"><img src="/images/master.png"><span class="text-capitalize"> Users</span></a>
        <a class="nav-link " href="/admin/blocks"><img src="/images/dashboard.png"><span class="text-capitalize"> Blocks</span></a>
        <a class="nav-link " href="/admin/flats"><img src="/images/master.png"><span class="text-capitalize"> Flats</span></a>
        <a class="nav-link " href="/admin/user-list"><img src="/images/dashboard.png"><span class="text-capitalize"> Bookings</span></a>
        <a class="nav-link" data-toggle="collapse" href="#collapsemanifests" role="button" aria-expanded="false" aria-controls="collapsemanifests">
        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
</nav>


<style>
nav.side-bar-link {
    background: #EEEEEE;
    margin-top: -351px;
}
.navbar {
    float: left;
    height: 800px;
    background: #EEE;
    width: 11%;
}
</style>








<!-- Right Side Of Navbar -->

































</nav>

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


