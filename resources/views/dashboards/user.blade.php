@extends('layouts.user')

@section('content')
   
        <div class="col-md-6 col-sm-12 col-lg-3">
            <div class="info-card active">
                <label for="" class="heading-lbl"> Bookings </label>
                <div class="count-lbl">{{ $result['booking_count'] }}</div>
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
                      
@endsection