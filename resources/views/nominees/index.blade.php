@extends('layouts.admin')

@section('breadcrum')
     Nominees
@endsection

@section('content')

    <div class="container">
        <div class="sb-page-header-content">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Nominees</span></h1>

                </div>
               
            </div>
        </div>

        <div class="row justify-content-center">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif

                            <table class="table table-bordered">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nominee Photo</th>
                                                    <th>Nominee Name</th>
                                                    <th>Posting</th>
                                                    <th>Contribute Time ( Hours )   </th>
                                                    <th>Action</th>
                                                </tr>
                                                @php
                                                    $index = $nominees->firstItem()
                                                @endphp
                                                @forelse ($nominees as $nominee)
                                                    <tr>
                                                        <td>{{ $index++ }}</td>
                                                        <td><img class="nominee_photo" src="{{URL::to('/images/nominees/'.$nominee->photo)}}"/></td>
                                                        <td>{{ $nominee->user->name }}</td>
                                                        <td>{{ $nominee->posting->name }}</td>
                                                        <td>{{ $nominee->contribute_time }}</td>
                                                        @if($nominee->status == 1)
                                                        <td>
                                                            <div class="btn-group">
                                                                <div class="button">
                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#acceptModal"  class="btn btn-primary w-100 nominee-validate" data-act="Accept " data-id="{{ $nominee->id }}">Accept</a>
                                                                </div>
                                                            </div>
                                                            <div class="btn-group">
                                                                <div class="button">
                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#acceptModal"  class="btn btn-danger w-100 nominee-validate" data-act="Reject " data-id="{{ $nominee->id }}">Reject</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @elseif($nominee->status == 2)
                                                          <td><label for="" class="accept-lbl"><i class="fa fa-check" aria-hidden="true"></i></label> Accepted </td>
                                                        @else
                                                           <td><label for="" class="reject-lbl">X</label> Rejected </td>
                                                        @endif
                                                    
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="9">No User Found</td>
                                                    </tr>
                                                @endforelse
                                    </table>

   
                          
                        </div>
                    </div>
                 
            </div>
        </div>
    </div>

    <div class="modal"   id="acceptModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure, want to <label id="act_lbl"></label> ? </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12 register-form">
                        

                    <form id="update_form" method="post" action="javascript:void(0)">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                           
                            <input type="hidden" name="nominee_id" class="form-control" id="nominee_id" placeholder="Please enter name" autocomplete="no-fill">
                            <input type="hidden" name="nominee_act" class="form-control" id="nominee_act" placeholder="Please enter mobile number" maxlength="10" autocomplete="no-fill">
                           
                        </div>
                        <button class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <button type="submit" id="nominee-validate-submit" class="btn btn-success">Yes</button>
                        </div>
                        </form>
                    </div>
                    
                    <div class="col-md-12 mobile-verified">
                            <div class="mb-3">
                                <label class="form-label">Your Mobile Number has been verified. <br> Your account will be activate and send your credentials to your mobile. </label>
                              
                            </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
    
<style>
img.nominee_photo {
    width: 100px;
}
.accept-lbl {
    background: green;
    color: white;
    padding: 5px 10px 5px 10px;
    border-radius: 23px;
}
.reject-lbl {
    background: red;
    color: white;
    padding: 2px 10px 2px 10px;
    border-radius: 23px;
    font-size: 19px;
    font-weight: bolder;
}
</style>

@endsection
