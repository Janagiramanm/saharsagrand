@extends('layouts.app')

@section('content')
<div class="main-container">
        <div class="container">
            <div class="container-block">
                <div class="inner-page">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="title">
                                <h3>Bookings</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="row justify-content-center">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">


            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            

            <div class="card">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>User Name</th>
                            <th>Booking Type</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Total Guest</th>
                            <th>Reference Code</th>
                           
                        </tr>
                        @php
                            $index = $bookings->firstItem()
                            @endphp
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $index++ }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->booking_type }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>{{ $booking->start_time }}</td>
                                <td>{{ $booking->end_time }}</td>
                                <td>{{ $booking->total_guests }}</td>
                                <td>{{ $booking->booking_code }}</td>
                             
                            </tr>
                        @endforeach
                    </table>

            </div>
           
        </div>
    </div>

</div>
</div>
                </div>

            </div>
        </div>
    </div>

@endsection