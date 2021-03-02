@extends('layouts.admin')
@section('parent_link')
    <a href="{{ route('tickers') }}" class="breadcrumb-item"> Tickers </a>
@endsection
@section('breadcrum')
    Edit Ticker
@endsection
@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Edit Ticker</span></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="">
                            <form id="editBlock" action="{{ route('ticker.update',$ticker->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 ">
                                        <div class="form-group">
                                        <label>Ticker News</label>
                                        <textarea class="form-control" id="ticker-ckeditor" name="ticker_news" required>{{ $ticker->ticker_news }}</textarea>
                                        @error('ticker_news')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror    
                                    </div>
                                    <div class="form-group col-4 mt-3">
                                        <label>Start Date</label>
                                        <input class="form-control" type="date" id="start_date" name="start_date"
                                            value="{{ $ticker->start_date }}"
                                            min="2021-01-01" max="2021-12-31"  />
                                    </div>
                                    <div class="form-group col-4 mt-3">
                                        <label>End Date</label>
                                        <input class="form-control" type="date" id="end_date" name="end_date"
                                            value="{{ $ticker->end_date }}"
                                            min="2021-01-01" max="2021-12-31" />
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label> Notification Display to </label>
                                    <div class="row radio-section">
                                        <div class="form-check col-2" >
                                            <input class="form-check-input" type="radio" name="role" @if($ticker->role == 'all') checked @endif required value="all" id="all">
                                            <label class="form-check-label" for="all">
                                                All
                                            </label>
                                        </div >
                                        <div class="form-check col-2" >
                                            <input class="form-check-input" type="radio" name="role" @if($ticker->role == 'owner') checked @endif required value="owner" id="owner">
                                            <label class="form-check-label" for="owner">
                                                Owner
                                            </label>
                                        </div >
                                        <div class="form-check col-2">
                                            <input class="form-check-input" type="radio" name="role" @if($ticker->role == 'tenant') checked @endif required value="tenant" id="tenant">
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
                                   
                                     
                                    
                                </div>
                                   
                                </div>
                            </form>
                            <div class="pt-lg-2 mt-4">
                                <button form="editBlock" type="submit" class="btn btn-primary">{{ 'Update' }}</button>
                                <button class="btn btn-danger mx-sm-2" data-toggle="modal" data-target="#deleteConfirm">{{ 'Delete' }}</button>
                            </div>

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    //CKEDITOR.replace( 'ticker-ckeditor' );
    var editor = CKEDITOR.replace( 'ticker-ckeditor', {
        language: 'en',
        extraPlugins: 'notification'
    });

    editor.on( 'required', function( evt ) {
        editor.showNotification( 'This field is required.', 'warning' );
        evt.cancel();
    } );
    </script>
@endsection
