@extends('layouts.admin')
@section('breadcrum')
   Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row pt-4">
            <div class="col-md-12">


                <main>
                    @php
                        $user = \Illuminate\Support\Facades\Auth::user();
                   @endphp
                  


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
                                <div class="dash-block-card" >
                                    <h2><a href="/admin/bookings" >{{ $bookings->count() }}</a></h2>
                                    <p>Bookings</p>
                                </div>
                            </div>
                           
                            <div class="col-md-3">
                                <div class="dash-block-card" >
                                    <h2><a href="/admin/user-list" > {{ $users->count() }} </a></h2>
                                    <p>Total Users</p>
                                </div>
                            </div>
                         
                        </div>

                    </div>

                    

                   


                   

                </main>
            </div>
        </div>
    </div>
   
@endsection
