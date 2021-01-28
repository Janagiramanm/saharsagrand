
@extends('layouts.app')

@section('content')
<div class="main-container">
    <div class="container">

        <div class="container-block">
            <div class="row">
                <div class="col-12">
                    <div class="title text-center">
                        <h2>Welcome to <span>Saharsa Grand</span></h2>
                       
                        <div class="row">
                          <div class="col-4">
                          </div>
                          <div class="col-4">

                          <div class="input-group">
                                <input type="text" class="form-control" id="booking-code" placeholder="Search Booking Code">
                                <div class="input-group-append">
                                <button class="btn btn-primary" type="button" id="search-book">
                                    <i class="fa fa-search"></i>
                                </button>
                                </div>
                            </div>
                    
                          
                          <!-- <input class="form-control search-booking" type="text" name="booking_code" id="booking_code" /> -->
                          </div>
                          <div class="col-4">
                          </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="info-card-block">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="info-card active">
                          @guest
                            <div class="image"><img src="{{ asset('/images/login.png') }}"/> </div>
                            <div class="button">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-primary w-100">Login</a>
                            </div>
                            <div class="button">
                                <input type="button" data-bs-toggle="modal" data-bs-target="#registerModal" value="Create an Account" class="btn btn-secondary w-100" />
                                <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal"  class="btn btn-secondary w-100">Create an Account</a> -->
                            </div>
                          @else
                            {{ Auth::user()->name }}
                            <div class="button">
                                <a data-bs-toggle="modal" data-bs-target="#changePasswordModal" href="#" >Change Password</a>
                            </div>
                            <div class="button">
                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </div>
                         @endguest
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="info-card">
                            <div class="image"><img src="images/icon-1.png"/> </div>
                            <div class="button">
                                <h3>Badminton</h3>
                            </div>
                            @guest
                            <div class="button">
                                <a href="#" class="btn btn-secondary w-100">Enroll</a>
                            </div>
                            @else
                            <div class="button">
                                <a href="https://booking.sahasragrand.com?bookingType=badminton&userToken={{Auth::user()->remember_token}}" class="btn btn-secondary w-100">Enroll</a>
                            </div>
                            @endguest
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="info-card ">
                            <div class="image"><img src="images/icon-3.png"/> </div>
                            <div class="button">
                                <h3>Swimming</h3>
                                <span>Coming Soon</span>
                            </div>
                            <div class="button">
                                <a href="#" class="btn btn-secondary w-100">Enroll</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="info-card ">
                            <div class="image"><img src="images/icon-4.png"/> </div>
                            <div class="button">
                                <h3>Gym</h3>
                                <span>Coming Soon</span>
                            </div>
                            <div class="button">
                                <a href="#" class="btn btn-secondary w-100">Enroll</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="info-card ">
                            <div class="image"><img src="images/icon-5.png"/> </div>
                            <div class="button">
                                <h3>Snooker</h3>
                                <span>Coming Soon</span>
                            </div>
                            <div class="button">
                                <a href="#" class="btn btn-secondary w-100">Enroll</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="info-card ">
                            <div class="image"><img src="images/icon-6.png"/> </div>
                            <div class="button">
                                <h3>Table Tennis</h3>
                                <span>Coming Soon</span>
                            </div>
                            <div class="button">
                                <a href="#" class="btn btn-secondary w-100">Enroll</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="info-card ">
                            <div class="image"><img src="images/icon-7.png"/> </div>
                            <div class="button">
                                <h3>Party Hall</h3>
                                <span>Coming Soon</span>
                            </div>
                            <div class="button">
                                <a href="#" class="btn btn-secondary w-100">Book</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="info-card ">
                            <div class="image"><img src="images/icon-8.png"/> </div>
                            <div class="button">
                                <h3>Maintenance Payment</h3>
                                <span>Coming Soon</span>
                            </div>
                            <div class="button">
                                <a href="#" class="btn btn-secondary w-100">Pay Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="info-card ">
                            <div class="image"><img src="images/icon-9.png"/> </div>
                            <div class="button">
                                <h3>Grievance</h3>
                                <span>Coming Soon</span>
                            </div>
                            <div class="button">
                                <a href="#" class="btn btn-secondary w-100">Submit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p>Copyright © 2021 Sahasra Grand</p>
                <p>Designed and Developed by NetiApps</p>

            </div>
        </div>
    </div>
</div>


<div class="modal" tabindex="-1" id="loginModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <form id="login_form" method="post" action="javascript:void(0)">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="text" name="username" id="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                               
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Remember</label>
                            </div>
                            <span class="text-danger invalid-login"></span><br>
                            <button type="submit" id="login-btn" class="btn btn-primary">Login</button>
                        </form>
                    </div>

                </div>


            </div> 
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="changePasswordModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Your Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <form id="login_form" method="post" action="javascript:void(0)">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Password</label>
                                <input type="password" name="change_password" id="change_password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" id="exampleInputPassword1">
                            </div>
                           
                            <span class="text-danger invalid-confirm"></span><br>
                            <span class="alert-success confirm-success"></span><br>
                            <button type="submit" id="change-pwd-btn" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>


<div class="modal"  id="registerModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create an Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12 register-form">
                        

                    <form id="register_form" method="post" action="javascript:void(0)">
                        @csrf
                        <div class="mb-3">
                            <label for="formGroupExampleInput">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Please enter name">
                           
                        </div>
                        <div class="mb-3">
                            <label for="mobile">Mobile<span class="text-danger">*</span></label>
                            <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Please enter mobile number" maxlength="10">
                           
                        </div>
                        <div class="mb-3">
                            <label for="email">Email Address<span class="text-danger">*</span></label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Please enter email id">
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>   
                        <div class="mb-3">
                                <label class="form-label">Block<span class="text-danger">*</span></label>
                                <select  name="block" id="block"  required class="form-control @error('block') is-invalid @enderror">
                                    <option value="">Select Block</option>
                                   @if($blocks)
                                        @foreach($blocks as $block)
                                            <option value="{{ $block->id }}"> {{ $block->name }}  </option>
                                        @endforeach
                                   @endif
                                    
                                </select>
                                <span class="text-danger">{{ $errors->first('block') }}</span>
                             
                              
                        </div>   
                        <div class="mb-3">
                                <label class="form-label">Flat Number*</label>
                                <select class="form-control" style="width:450px;" name="flat_number" id="flat_number" required>
                                    <option value="">Select a Flat </option>
                                   
                                </select>
                                <span id="error-flat" class="text-danger">{{ $errors->first('flat_number') }}</span>
                        </div>
                        <div class="mb-3">
                                <label class="form-label">Type<span class="danger-str">*</span></label>
                                <select  name="type" id="type"  required class="form-control @error('type') is-invalid @enderror">
                                    <option value="">Select Type</option>
                                    <option value="owner">Owner</option>
                                    <option value="tenant">Tenant </option>
                                </select>
                                <span class="text-danger">{{ $errors->first('type') }}</span>
                        </div>
                        
                        <div class="alert alert-success d-none" id="msg_div">
                        <span id="res_message"></span>
                        </div>
                        <div class="form-group">
                        <button type="submit" id="user-reg-submit" class="btn btn-success">Submit</button>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-12 otp-form">
                        <form id="verify_mobile" method="post" action="javascript:void(0)" >
                           @csrf
                            <div class="mb-3">
                                <label class="form-label">Enter Your OTP * </label>
                                <input type="text" name="otp" id="otp" required class="form-control">
                                <span class="text-danger" id="error-otp">{{ $errors->first('otp') }}</span>
                                
                            </div>
                            <input type="hidden" name="user_id" id="user_id" value="" />
                            <button type="submit" id="verify-otp-btn" class="btn btn-primary">Verify Mobile</button>
                        </form>
                    </div>
                    <div class="col-md-12 mobile-verified">
                            <div class="mb-3">
                                <label class="form-label">Your Mobile Number has been verified. <br> Your account will be activate and send your credentials to your mobile. </label>
                              
                            </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> -->

<script>

    // var path = "{{ route('autocomplete') }}";
    
    // $('input.typeahead').typeahead({
    //     //var block = $("#block").val();
    //     source:  function (query, process) {
    //         return $.get(path, { flat: query,block:$("#block").val() }, function (data) {
    //             // if (!data.length) {
    //             //     return 'No Flats Found';
    //             // }
    //             return process(data);
    //         });
    //     }
    // });

   
  
</script>


@endsection

