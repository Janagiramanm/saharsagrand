
@extends('layouts.app')

@section('content')
<div class="main-container">
    <div class="container">
        <div class="container-block">
            <div class="row">
                <div class="col-12">
                    <div class="title text-center">
                        <h2>Welcome to <span>Saharsa Grand</span></h2>
                    </div>
                </div>
            </div>
            <div class="info-card-block">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="info-card active">
                            <div class="image"><img src="images/login.png"/> </div>
                            <div class="button">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-primary w-100">Login</a>
                            </div>
                            <div class="button">
                                <input type="button" data-bs-toggle="modal" data-bs-target="#registerModal" value="Create an Account" class="btn btn-secondary w-100" />
                                <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal"  class="btn btn-secondary w-100">Create an Account</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="info-card">
                            <div class="image"><img src="images/icon-1.png"/> </div>
                            <div class="button">
                                <h3>Badminton</h3>
                            </div>
                            <div class="button">
                                <a href="#" class="btn btn-secondary w-100">Enroll</a>
                            </div>
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
                        <form>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Remember</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>


<div class="modal" tabindex="-1" id="registerModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create an Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12 register-form">
                        <!-- <form method="POST" action="#" id="register_form">
                            <div class="mb-3">
                                <label class="form-label">Full Name <span class="danger-str">*</span></label>
                                <input type="text" name="name" id="name" required class="form-control">
                                <span class="text-danger" id="error-name"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mobile Number*</label>
                                <input type="number" name="mobile" id="mobile" required class="form-control">
                                 <span class="text-danger" id="error-mobile"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address*</label>
                                <input type="email" name="email" id="email" required class="form-control">
                                <span class="text-danger" id="error-email"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Block*</label>
                                <select  name="block" id="block"  required class="form-control @error('block') is-invalid @enderror">
                                    <option value="">Select Type</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                                <span class="text-danger" id="error-block"></span>
                              
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Flat Number*</label>
                                <input type="text" name="flat_number" id="flat_number" required class="form-control">
                                <span class="text-danger" id="error-flat_number"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Type*</label>
                                <select  name="type" id="type"  required class="form-control @error('type') is-invalid @enderror">
                                    <option value="">Select Type</option>
                                    <option value="owner">Owner</option>
                                    <option value="tenant">Tenant </option>
                                </select>
                                <span class="text-danger" id="error-type"></span>
                            </div>

                            <button type="button" id="user-reg-submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div> -->

                    <form id="register_form" method="post" action="javascript:void(0)">
                        @csrf
                        <div class="mb-3">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Please enter name">
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="mb-3">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Please enter mobile number" maxlength="10">
                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email Address</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Please enter email id">
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>   
                        <div class="mb-3">
                                <label class="form-label">Block*</label>
                                <select  name="block" id="block"  required class="form-control @error('block') is-invalid @enderror">
                                    <option value="">Select Type</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('block') }}</span>
                             
                              
                        </div>   
                        <div class="mb-3">
                                <label class="form-label">Flat Number*</label>
                                <input type="text" name="flat_number" id="flat_number" required class="form-control">
                                <span class="text-danger">{{ $errors->first('flat_number') }}</span>
                        </div>
                        <div class="mb-3">
                                <label class="form-label">Type*</label>
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

                    <div class="col-md-12 otp-form">
                        <form method="POST" action="#" id="register_form">
                            <div class="mb-3">
                                <label class="form-label">Enter Your OTP * </label>
                                <input type="text" name="otp" id="otp" required class="form-control">
                            </div>
                            <button type="button" id="user-reg-submit" class="btn btn-primary">Verify Mobile</button>
                        </form>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
<script>
    

</script>
@endsection

