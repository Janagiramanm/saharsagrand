@extends('layouts.admin')
@section('parent_link')
    <a href="{{ route('blocks') }}" class="breadcrumb-item"> Blocks </a>
@endsection
@section('breadcrum')
    Edit Block
@endsection

@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Edit Block</span></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="">
                            <form id="editBlock" action="{{ route('block.update',$block->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                        <label>Block Name <span class="text-danger">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $block->name }}" required autocomplete="name" autofocus>
                                        @error('name')
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
                                <input type="button" data-bs-toggle="modal" data-bs-target="#deleteConfirm" value="Delete" class="btn btn-danger" />   
                            </div>

                            <div class="modal" id="deleteConfirm" tabindex="-1"  role="dialog" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        {{ "Please confirm to delete the record" }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ 'Close' }}</button>
                                        <form action="{{ route('block.destroy',$block->id) }}" method="POST" style="display:inline">

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
    </div>

@endsection
