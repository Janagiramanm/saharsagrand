@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Notification</span></h1>
                </div>
{{--                <div>--}}
{{--                    <a class="btn btn-primary" href="{{ route('pricing.index') }}"> Back</a>--}}
{{--                </div>--}}

            </div>

        </div>
        <div class="row">
            <div class="col-8">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form action="{{ route('notifications.store') }}" method="POST">
                            @csrf

                            <div class="row">
                               
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                   <label> Notification Send to </label>
                                   <div class="row radio-section">
                                        <div class="form-check col-2" >
                                            <input class="form-check-input" type="radio" name="user_type" required value="all" id="all">
                                            <label class="form-check-label" for="all">
                                                All
                                            </label>
                                        </div >
                                        <div class="form-check col-2" >
                                            <input class="form-check-input" type="radio" name="user_type" required value="owner" id="owner">
                                            <label class="form-check-label" for="owner">
                                                Owner
                                            </label>
                                        </div >
                                        <div class="form-check col-2">
                                            <input class="form-check-input" type="radio" name="user_type" required value="tenant" id="tenant">
                                            <label class="form-check-label" for="tenant">
                                                Tenant
                                            </label>
                                        </div>
                                        @error('user_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="select-user-sec">
                                        <select id="user-selectbox" required name="user_id[]">      
                                        </select>
                                    </div>
                                    <br>
                                    
                                    <div class="col-4">
                                        <select class="form-control" name="template" id="template">
                                             <option value="">Select Template</option>
                                        @foreach($templates as $template)
                                                <option value="{{$template->id}}" @if($template->id == old('template')) selected ="selected" @endif >
                                                    {{$template->name}}
                                                </option>
                                        @endforeach
                                        </select>
                                        
                                    </div>
                                    
                                </div>
                                <br>
                                 <div id="sms-template-show"></div>
                                <br>
                                <div class="col-xs-12 col-sm-12 col-md-12 mt-4 ">
                                    <button type="submit" class="btn btn-primary">{{ 'Send' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script >
        $(document).ready(function () {
            $("#user-selectbox").CreateMultiCheckBox({ width: '230px', defaultText : 'Select User', height:'250px' });
            $(".form-check-input").on('click',function(){
                if( $(this).is(":checked") ){ 
                    var user_type = $(this).val(); // retrieve the value
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: '/admin/select-user-notification',
                        data: {'type': user_type},
                        success: function(resp){
                            $(".select-user-sec").html('<select id="user-selectbox" required name="user_id[]"></select>');
                            if(resp.status == 1){
                                $(".select-user-sec").html(resp.data)
                            }
                            $("#user-selectbox").CreateMultiCheckBox({ width: '230px', defaultText : 'Select '+user_type.charAt(0).toUpperCase() + user_type.slice(1), height:'250px' });
                        
                        }
                    });
                }
            })

         $("#template").change(function(){
            var template_id = $(this).val(); // retrieve the value
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: '/admin/get-sms-template',
                        data: {'id': template_id},
                        success: function(resp){
                            
                            if(resp.status == 1){
                                $("#sms-template-show").show();
                                $("#sms-template-show").html(resp.data)
                            }
                           
                        
                        }
                    });
         });
        });
    </script>
@endsection
