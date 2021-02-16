@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Edit Amenity</span></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="">
                            <form id="editAmenity" action="{{ route('amenity.update',$amenity->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Amenity Name</label>
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')?old('name'):$amenity->name }}" required autocomplete="name" autofocus>
                                            
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                            <label colspan="3"> Time Slots is Required  </label> <input id="time-required" type="checkbox" name="time_setting"  @if($amenity->time_slots==1) checked @endif }}  /> 
                                                <table class="time-settings-sec">
                                                <tr></tr>
                                                <tr>
                                                    <th class="day-section"> Day </th>
                                                    <th class="time-section">Start</th>
                                                    <th class="time-section">End</th>
                                                </tr>
                                                @if($times->isEmpty())
                                                   @foreach($days as $day)
                                                      <tr> 
                                                            <td class="day-section"><label>{{ $day }}</label> </td>
                                                            <td class="time-section">
                                                            <input type="time" id="appt" name="start[{{$day}}]" min="06:00" max="22:00" name="start_time" value="06:00" required>
                                                            </td>
                                                            <td class="time-section"><input type="time" id="appt" name="end[{{$day}}]" min="06:00" max="22:00" name="end_time" value="22:00" required>
                                                        </tr>
                                                    @endforeach

                                                @else
                                                    @foreach($times as $time)
                                                    <tr> 
                                                            <td class="day-section"><label>{{ $time->day }}</label> </td>
                                                            <td class="time-section">
                                                            <input type="time" id="appt" name="start[{{$time->id}}]" min="06:00" max="22:00" name="start_time" value="{{ $time->start_time }}" required>
                                                            </td>
                                                            <td class="time-section"><input type="time" id="appt" name="end[{{$time->id}}]" min="06:00" max="22:00" name="end_time" value="{{ $time->end_time }}" required>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                             
                                                </table>
                                            </div>
                                            <div class="form-group time-settings-sec">
                                            <label>Advance Booking </label>
                                            <input id="name" type="number" class="form-control @error('advance_book') is-invalid @enderror" name="advance_book" value="{{ old('advance_book')?old('advance_book'):$amenity->advance_book }}" autofocus>
                                            </div>
                                            <div class="form-group  image-card  ">
                                               <div class="image"><img src="{{URL::to('/images/'.$amenity->logo)}}"/> </div>
                                            </div>
                                            <div class="form-group ">
                                            <label>Change Logo</label>
                                                <input type="file" name="logo" class="form-control">
                                            </div>
                                        </div>
                                    
                                   
                                </div>
                            </form>
                            <div class="pt-lg-2">
                                <button form="editAmenity" type="submit" class="btn btn-primary">{{ 'Update' }}</button>
                                <button class="btn btn-danger mx-sm-2" data-toggle="modal" data-target="#deleteConfirm">{{ 'Delete' }}</button>
                            </div>

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
