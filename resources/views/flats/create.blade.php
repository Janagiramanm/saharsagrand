@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Add Flat</span></h1>
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
                        <form action="{{ route('flat.store') }}" method="POST">
                            @csrf

                            <div class="row">
                               
                                <div class="col-xs-12 col-sm-12 col-md-12">

                                    <div class="mb-3">
                                            <label class="form-label">Block*</label>
                                            <select  name="block" id="block"  required class="form-control @error('block') is-invalid @enderror">
                                                <option value="">Select Type</option>
                                            @if($blocks)
                                                    @foreach($blocks as $block)
                                                             @if(old('block'))
                                                                            <option value="{{$block->id}}" @if($block->id == old('block')) selected ="selected" @endif >
                                                                            {{$block->name}}
                                                                            </option>
                                                    @else
                                                          <option value="{{ $block->id }}"> {{ $block->name }}  </option>

                                                    @endif
                                                       
                                                    @endforeach
                                            @endif
                                                
                                            </select>
                                            <span class="text-danger">{{ $errors->first('block') }}</span>
                                    </div> 

                                    <div class="form-group">
                                        <label>Flat Number</label>
                                        <input id="flat_number" type="text" class="form-control @error('flat_number') is-invalid @enderror" name="flat_number" value="{{ old('flat_number') }}" required autocomplete="name" autofocus>
                                       
                                        @error('flat_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="col-xs-12 col-sm-12 col-md-12 ">
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
