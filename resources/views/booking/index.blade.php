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

                     <div class="filter_form">
                           <form class="form-inline"  action="{{ route('bookings.search') }}">
                                <div class="row">
                                    <div class="form-group mx-sm-2 mb-2 col-3">
                                        <select class="form-control" name="user_id" id="user_name_filter">
                                              <option>Select User</option>
                                              @if($users)
                                                  @foreach($users as $user)
                                                     <option value="{{ $user->id }}"> {{ $user->name }}</option>
                                                  @endforeach
                                              @endif
                                        </select> 
                                        <!-- <input type="text" placeholder="User Name" class="form-control" id="branch_code" name="user_name" value="{{ request()->input('branch_code') }}"> -->
                                    </div>
                                    <div class="form-group mx-sm-2 mb-2 col-3">
                                        <select class="form-control" name="amenity_name" id="amenity_name_filter">
                                              <option>Select Amenity</select>
                                        </select> 
                                        <!-- <input type="text" placeholder="Branch Name" class="form-control" id="branch_name" name="branch_name" value="{{ request()->input('branch_name') }}"> -->
                                    </div>
                                    <div class="form-group mx-sm-2 mb-2 col-3" id="sandbox-container">
                                        <div class="input-group date">
                                            <input type="text" class="form-control" value="">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="input-sm form-control" name="booking_date" placeholder="Date" value="{{ request()->input('start_date') }}">
                                        </div> -->
                                    </div>
                                    <!-- <div class="form-group mx-sm-2 mb-2 col-3">
                                        <input type="text" placeholder="Pincode" class="form-control" id="pincode" name="pincode" value="{{ request()->input('pincode') }}">
                                    </div> -->


                                <!-- </div>
                                <div class="row btn-section"> -->
                                    <button type="submit" class="form-group btn btn-primary mr-3 mb-2 col-1">
                                                {{ __('Search') }}
                                            </button>
                                    <a title="Reset" href="{{route('bookings.search')}}" class="form-group btn btn-group btn-outline-dark  mb-2 col-1">Reset</a>
                                </div>
                            </form>

                    </div>


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

@endsection