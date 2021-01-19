
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
                    
                    <div class=" col-sm-12 ">
                       
                            <div class="button">
                            <label class="form-label"> <h3>Your Mobile Number has been verified. Your account will be activate and send your credentials to your mobile. </h3></label>
                            </div>
                            <div class="button">
                                <a href="{{ url('/') }}" class="btn btn-secondary ">click here to login</a>
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





@endsection

