@extends('layouts.admin')
@section('parent_link')
    <a href="{{ route('tickers') }}" class="breadcrumb-item"> Tickers </a>
@endsection
@section('breadcrum')
    Add New Ticker
@endsection
@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Add Ticker</span></h1>
                </div>


            </div>

        </div>
        <div class="row">
            <div class="col-8">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form action="{{ route('ticker.store') }}" method="POST">
                            @csrf

                            <div class="row">
                               
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>Ticker News</label>
                                        <!-- <input id="ticker_news" type="text" class="form-control @error('ticker_news') is-invalid @enderror" name="ticker_news" value="{{ old('ticker_news') }}" required autocomplete="name" autofocus> -->
                                       <textarea class="form-control" id="ticker-ckeditor" name="ticker_news" required></textarea>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-4 mt-3">
                                        <label>Start Date</label>
                                        <input class="form-control" type="date" id="start_date" name="start_date"
                                            value="{{ date('d-m-Y')}}"
                                            min="{{ date('Y-m-d') }}" max="{{ date('Y-12-31') }}" />
                                    </div>
                                    <div class="form-group col-4 mt-3">
                                        <label>End Date</label>
                                        <input class="form-control" type="date" id="end_date" name="end_date"
                                            value="{{ date('d-m-Y')}}"
                                            min="{{ date('Y-m-d') }}" max="{{ date('Y-12-31') }}" />
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label> Notification Display to </label>
                                    <div class="row radio-section">
                                        <div class="form-check col-2" >
                                            <input class="form-check-input" type="radio" name="role" required value="all" id="all">
                                            <label class="form-check-label" for="all">
                                                All
                                            </label>
                                        </div >
                                        <div class="form-check col-2" >
                                            <input class="form-check-input" type="radio" name="role" required value="owner" id="owner">
                                            <label class="form-check-label" for="owner">
                                                Owner
                                            </label>
                                        </div >
                                        <div class="form-check col-2">
                                            <input class="form-check-input" type="radio" name="role" required value="tenant" id="tenant">
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
