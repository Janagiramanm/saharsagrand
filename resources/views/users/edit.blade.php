@extends('layouts.app')

@section('content')
  

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">


            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            

            <div class="card">
                        <div>
                            <h2 class="sb-page-header-title"><span>Edit User</span></h2>
                        </div>
               
                        <form id="user_edit_form" method="post" action="{{ route('user.update',$user->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="formGroupExampleInput">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" placeholder="Please enter name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="mobile">Mobile<span class="text-danger">*</span></label>
                                        <input type="number" name="mobile" class="form-control" id="mobile" value="{{ $user->mobile }}" placeholder="Please enter mobile number" maxlength="10" readonly>
                                    
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email Address</label>
                                        <input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="Please enter email id">
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>   
                                    <div class="mb-3">
                                            <label class="form-label">Block<span class="text-danger">*</span></label>
                                            <select  name="block_id" id="block"  required class="form-control @error('block') is-invalid @enderror" >
                                                <option value="">Select Block</option>
                                            @if($blocks)
                                                    @foreach($blocks as $block)
                                                        <option @if($user->block_id == $block->id ) selected @endif value="{{ $block->id }}"> {{ $block->name }}  </option>
                                                    @endforeach
                                            @endif
                                                
                                            </select>
                                            <span class="text-danger">{{ $errors->first('block') }}</span>
                                        
                                        
                                    </div>   
                                    <div class="mb-3">
                                            <label class="form-label">Flat Number<span class="text-danger">*</span></label>
                                            <select class="form-control"  name="flat_id" id="flat_id" required>
                                                <option value="">Select a Flat </option>
                                                @if($flats)
                                                    @foreach($flats as $flat)
                                                        <option @if($user->flat_id == $flat->id ) selected @endif value="{{ $flat->id }}"> {{ $flat->flat_number }}  </option>
                                                    @endforeach
                                                @endif
                                            
                                            </select>
                                            @error('flat_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                           @enderror
                                            <!-- <span class="text-danger">{{ $errors->first('flat_number') }}</span> -->
                                    </div>
                                    <div class="mb-3">
                                            <label class="form-label">Type<span class="text-danger">*</span></label>
                                            <select  name="type" id="type"  required class="form-control @error('type') is-invalid @enderror">
                                                <option value="">Select Type</option>
                                                <option @if($user->type == 'owner' ) selected @endif value="owner">Owner</option>
                                                <option @if($user->type == 'tenant' ) selected @endif value="tenant">Tenant </option>
                                            </select>
                                            <span class="text-danger">{{ $errors->first('type') }}</span>
                                    </div>
                                    
                                    <div class="alert alert-success d-none" id="msg_div">
                                    <span id="res_message"></span>
                                    </div>
                                    <div class="form-group">
                                    <button type="submit" id="user-reg-submit" class="btn btn-success">Submit</button>
                                    <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#deleteConfirm">{{ 'Delete' }}</button>
                                    </div>
                        </form>
           

            </div>
           
        </div>
    </div>

    <div class="modal fade" id="deleteConfirm"  role="dialog" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{ "Please confirm to delete the record" }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ 'Close' }}</button>
                    <form action="{{ route('user.destroy',$user->id) }}" method="POST" style="display:inline">

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



<style>
h1.sb-page-header-title {
padding-left: 12px;
}
</style>




@endsection