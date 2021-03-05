@extends('layouts.admin')
@section('breadcrum')
     Bookings
@endsection
@section('content')
<div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Bookings</span></h1>

                </div>
                <!-- <div>
                    <a class="btn btn-info" href="{{ route('block.create') }}">Add New Block</a>
                </div> -->
            </div>
        </div>
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
                                       <input class="form-control" type="text" name="reference_code" id="reference_code" placeholder="Reference Code" value="{{ old('reference_code')}}" />
                                        
                                    </div>
                                    <div class="form-group mx-sm-2 mb-2 col-3">
                                        <select class="form-control" name="user_id" id="user_name_filter">
                                              <option value="">Select User</option>
                                              @if($users)
                                                  @foreach($users as $user)
                                                     <option value="{{ $user->id }}"> {{ $user->name }}</option>
                                                  @endforeach
                                              @endif
                                        </select> 
                                        
                                    </div>
                                    <div class="form-group mx-sm-2 mb-2 col-3">
                                        <select class="form-control" name="amenity_id" id="amenity_name_filter">
                                              <option value="">Select Amenity</option>
                                              @if($amenities)
                                                  @foreach($amenities as $amenity)
                                                     <option value="{{ $amenity->id }}"> {{ $amenity->name }}</option>
                                                  @endforeach
                                              @endif
                                        </select> 
                                        
                                    </div>
                                    
                                    <div class="form-group mx-sm-2 mb-2 col-3" id="sandbox-container">
                                                <input class="form-control" type="date" id="book_date" name="book_date"
                                                    value="{{ date('d-m-Y')}}"
                                                    min="date('Y-m-d')" max="2021-12-31">
                                            </div>
                                       
                                            <button type="submit" class="form-group btn btn-primary mr-3 mb-2 col-1">
                                                {{ __('Search') }}
                                            </button>
                                    <a title="Reset" href="{{route('bookings.search')}}" class="form-group btn btn-group btn-outline-dark  mb-2 col-1">Reset</a>
                                    </div>
                                   
                                    
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
                                <td>{{ $booking->amenity->name }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>{{ $booking->start_time }}</td>
                                <td>{{ $booking->end_time }}</td>
                                <td>{{ $booking->total_guests }}</td>
                                <td>{{ $booking->booking_code }}</td>
                             
                            </tr>
                        @endforeach
                    </table>
                    <div>
                            {{ $bookings->links() }}
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