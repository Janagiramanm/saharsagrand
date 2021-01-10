@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pt-4">
            <div class="col-md-12">


                <main>
                    @php
                        $user = \Illuminate\Support\Facades\Auth::user();
                    @endphp
                    @if (Request::is('admin/*'))
                        <div class="navigation">
                            @component('components.nav')
                            @endcomponent
                        </div>
                    @endif



                    {{--                <main>--}}
                    {{--                    <div class="sb-page-header">--}}
                    {{--                        <div class="container-fluid text-center">--}}
                    {{--                            <div class="d-flex justify-content-center align-items-center">--}}
                    {{--                                <div class="dash-block">--}}
                    {{--
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                </main>--}}


                    <div class="dashboard-header-block">

                        <div class="row pb-4 pt-2">
                            <div class="col-6">
                                <h5>Today's Booking</h5>
                            </div>
                            <div class="col-6 text-right">
                                <p> 
                                </p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="dash-block-card" style="background: #fb875d">
                                    <h2>10</h2>
                                    <p>Bookings</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dash-block-card" style="background: #8c6ded">
                                    <h2>10</h2>
                                    <p>Transit</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dash-block-card" style="background: #34cac1">
                                    <h2>20</h2>
                                    <p>Delivered</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dash-block-card" style="background: #e56de6">
                                    <h2>40</h2>
                                    <p>Returned/Cancel</p>
                                </div>
                                <a href="{{ url('/').'/admin/bookings?start_date='.date('d/m/Y').'&end_date='.date('d/m/Y') }}" class=""> Show More... </a>
                            </div>
                         
                        </div>

                    </div>

                    

                   


                   

                </main>
            </div>
        </div>
    </div>
   
@endsection
