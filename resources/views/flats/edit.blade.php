@extends('layouts.admin')
@section('parent_link')
    <a href="{{ route('flats') }}" class="breadcrumb-item"> Flats </a>
@endsection
@section('breadcrum')
    Edit Flat
@endsection
@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Edit Flat</span></h1>
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
                        <form action="{{ route('flat.update',$flat->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                               
                                <div class="col-xs-12 col-sm-12 col-md-12">

                                    <div class="mb-3">
                                            <label class="form-label">Block <span class="text-danger">*</span></label>
                                            <select  name="block" id="block"  required class="form-control @error('block') is-invalid @enderror">
                                                <option value="">Select Type</option>
                                            @if($blocks)
                                                    @foreach($blocks as $block)
                                                        <option value="{{ $block->id }}" 
                                                             @if(isset($flat)){{ ($flat->block_id) == $block->id ? 'selected':'' }} @endif > 
                                                             {{ $block->name }} 
                                                       </option>
                                                    @endforeach
                                            @endif
                                                
                                            </select>
                                            <span class="text-danger">{{ $errors->first('block') }}</span>
                                    </div> 

                                    <div class="form-group">
                                        <label>Flat Name <span class="text-danger">*</span></label>
                                        <input id="flat_number" type="text" class="form-control @error('flat_number') is-invalid @enderror" name="flat_number" value="{{ $flat->flat_number }}" required autocomplete="name" autofocus>
                                       
                                        @error('flat_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                                    <button type="submit" class="btn btn-primary">{{ 'Update' }}</button>
                                    <input type="button" data-bs-toggle="modal" data-bs-target="#deleteConfirm" value="Delete" class="btn btn-danger" />   
                                </div>
                            </div>
                        </form>

                        <div class="modal" id="deleteConfirm" tabindex="-1"  role="dialog" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        {{ "Please confirm to delete the record" }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ 'Close' }}</button>
                                        <form action="{{ route('flat.destroy',$flat->id) }}" method="POST" style="display:inline">

                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger btn-ok" value="{{ 'Confirm' }}" />
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
