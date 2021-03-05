@extends('layouts.user')

@section('content')
   
        <div class="col-md-6 col-sm-12 col-lg-3">
            <div class="info-card active">
                <label for="" class="heading-lbl"> Bookings </label>
                @if($result['booking_count'] > 0)
                <div class="count-lbl"><a href="/user/bookings">{{ $result['booking_count'] }}</a></div>
                @else
                <div class="count-lbl">{{ $result['booking_count'] }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-lg-3">
            <div class="info-card active">
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-lg-3">
            <div class="info-card active">
                </div>
        </div>
        <div class="col-md-6 col-sm-12 col-lg-3">
            <div class="info-card active">
                </div>
        </div>  
<style>
.count-lbl a{
    text-decoration:none;
}
</style>
                      
@endsection