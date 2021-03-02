@extends('layouts.admin')
@section('parent_link')
    <a href="{{ route('messages.index') }}" class="breadcrumb-item"> SMS Templates </a>
@endsection
@section('breadcrum')
    Add New Template
@endsection
@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Add Template</span></h1>
                </div>


            </div>

        </div>
        <div class="row">
            <div class="col-8">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form action="{{ route('messages.store') }}" method="POST">
                            @csrf

                            <div class="row">
                               
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>Template Name</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 mt-3">
                                        <label>SMS Content</label>
                                        <textarea class="form-control" id="sms-ckeditor" name="sms"></textarea>
                                    </div>
                                    <div class="form-group col-12 mt-3">
                                        <label>Email Content</label>
                                        <textarea class="form-control" id="email-ckeditor" name="email"></textarea>
                                       
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="col-xs-12 col-sm-12 col-md-12 mt-4 ">
                                    <button type="submit" class="btn btn-primary">{{ 'Submit' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    CKEDITOR.replace( 'sms-ckeditor' );
    CKEDITOR.replace( 'email-ckeditor' );
    </script>
@endsection
