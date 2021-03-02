@extends('layouts.user')

@section('content')
                <div class="col-md-6 col-sm-12 col-lg-8">
                    <div class="card">
                    <div>
                        <h2>Nominee Registration</h2>
                    </div>
                    <hr>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                   
                    @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                    @endif                       
                                
                    <form method="POST" action="{{ route('nominees.store') }}" enctype="multipart/form-data">
                        @csrf

                     
                     <div class="user-form-section">
                       
                        <div class="form-group row">
                            <label for="postings" class="col-md-3 col-form-label text-md-right">{{ __('Posting') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="posting_id" id="postings" required>
                                        <option value="">Select Posting</option>
                                        @if($postings)
                                            @foreach($postings as $posting)
                                                <option  value="{{ $posting->id }}"> {{ $posting->name }}</option>
                                            @endforeach
                                        @endif
                                </select> 
                                @error('posting_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Posting') }}</label>
                            <div class="col-md-6">
                                  <input class="form-control" type="text" name="nominee_name" value="{{ $user->name }}" readonly />
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                  <input class="form-control" type="text" name="nominee_name" value="{{ $user->name }}" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-md-3 col-form-label text-md-right">{{ __('Mobile') }}</label>

                            <div class="col-md-6">
                               <input class="form-control" type="text" name="nominee_mobile" value="{{ $user->mobile }}" readonly />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" type="text" name="nominee_email" value="{{ $user->email }}" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nominee_block" class="col-md-3  col-form-label text-md-right">{{ __('Block') }}</label>

                            <div class="col-md-6">
                               <input class="form-control" type="text" name="nominee_block" value="{{  $user->block->name }}" readonly />  
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nominee_flat" class="col-md-3 col-form-label text-md-right">{{ __('Flat Number') }}</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="nominee_flat" value="{{  $user->flat->flat_number }}" readonly />  
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nominee_photo" class="col-md-3 col-form-label text-md-right">{{ __('Photo') }}</label>
                            <div class="col-md-6">
                                <input class="form-control" type="file" name="nominee_photo" required />  
                            </div>
                        </div>
                        <div  class="form-group row">
                           <label for="nominee_photo" class="col-md-12 col-form-label text-md-right">{{ __('In a week how many hours can you contribute in associate ') }}</label>
                            <div class="col-md-6">
                                <select class="form-control select_time" name="contribute_time" id="contribute_time">
                                     <option value="">Hours </option>
                                     @for($i=1; $i < 56; $i++)
                                          <option value="{{ $i }} "> {{ $i }} </option>
                                     @endfor
                                </select>  
                               
                            </div>
                        </div>
                        
                    </div>
                    
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
<style>
.form-group.row {
    margin-bottom: 7px;
}
.select_time {
    width: 23%;
    float: left;
    margin-left: 5px;
}
.select2-container--default .select2-selection--single {
    height: 39px;
    width: 319px;
}
.card {
    padding: 10px;
    margin-bottom: 20px;
}
</style>
@endsection
