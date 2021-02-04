@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Add Amenity</span></h1>
                </div>


            </div>

        </div>
        <div class="row ">
            <div class="col-12">
                <div class="row ">
                    <div class="col-md-4">
                        <form action="{{ route('amenity.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                               
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>Amenity Name</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                       
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                    <label colspan="3"> Time Slots is Required  </label> <input id="time-required" type="checkbox" name="time_setting" checked /> 
                                        <table class="time-settings-sec">
                                          <tr></tr>
                                          <tr>
                                               <th class="day-section"> Day </th>
                                               <th class="time-section">Start</th>
                                               <th class="time-section">End</th>
                                         </tr>

                                        @foreach($days as $day)
                                            <tr> 
                                                 <td class="day-section"><label>{{ $day }}</label> </td>
                                                 <td class="time-section">
                                                 <input type="time" id="appt" name="start[{{$day}}]" min="06:00" max="22:00" name="start_time" value="06:00" required>
                                                   
                                                 </td>
                                                 <td class="time-section"><input type="time" id="appt" name="end[{{$day}}]" min="06:00" max="22:00" name="end_time" value="20:00" required>
                                            </tr>
                                        @endforeach
                                        </table>
                                    </div>
                                    <div class="form-group">
                                    <label>Advance Booking </label>
                                    <input id="name" type="number" class="form-control @error('advance_book') is-invalid @enderror" name="advance_book" value="{{ old('advance_book') }}"  autofocus>
                                    </div>
                                    <div class="form-group">
                                    <label>Logo</label>
                                        <input type="file" name="logo" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                                    <button type="submit" class="btn btn-primary">{{ 'Submit' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
