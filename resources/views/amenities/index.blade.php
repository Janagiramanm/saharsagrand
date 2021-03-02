@extends('layouts.admin')
@section('breadcrum')
     Amenities
@endsection
@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Amenities</span></h1>

                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('amenity.create') }}">Add New Amenity</a>
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
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                @php
                                    $index = $amenities->firstItem()
                                    @endphp
                                @foreach ($amenities as $amenity)
                                    <tr>
                                        <td>{{ $index++ }}</td>
                                        <td>{{ $amenity->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                  <a title="Edit" href="{{ route('amenity.edit',$amenity->id)}}" class="btn btn-secondary btn-sm">Edit</a>
                                            </div>
                                            @if($amenity->active==1)
                                            <div class="btn-group">
                                                <a id="{{$amenity->id}}" data-bs-toggle="modal" class="btn btn-secondary btn-sm block-amenity" data-bs-target="#blockAmenityModal" href="#" >Block</a>
                                            </div>
                                            @else
                                            <div class="btn-group">
                                                <a id="{{$amenity->id}}" data-name="{{ $amenity->name }}" data-bs-toggle="modal" data-bs-target="#unblockAmenityModal" class="btn btn-secondary btn-sm un-block-amenity" href="#" >Un-Block</a>
                                            </div>
                                            @endif
                                            
                                        </td>
                                       
                                    </tr>
                                @endforeach
                            </table>
                            <div>
                            {{ $amenities->links() }}
                            </div>

                           
                           
                        </div>
                    </div>

            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="blockAmenityModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Block Amenity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <form id="login_form" method="post" action="javascript:void(0)">

                            <div class="form-group col-md-6">
                                <p>Start Date </p>
                                <div class="input-group">
                                    <input class="form-control" type="date" id="start_date" name="start_date"
                                        value="{{ date('d-m-Y')}}"
                                        min="2021-01-01" max="2021-12-31">
                                </div>
                              
                            </div>
                            <br>
                            <div class="form-group col-md-6">
                                <p>End Date </p>
                                <div class="input-group">
                                <input class="form-control" type="date" id="end_date" name="end_date"
                                        value="{{ date('d-m-Y')}}"
                                        min="2021-01-01" max="2021-12-31">
                                </div>
                            </div>
                           
                           
                            <span class="text-danger invalid-confirm"></span><br>
                            <span class="alert-success confirm-success"></span><br>
                            <input type="hidden" id="amenity_id" name="amenity_id" value="" />
                            <button type="button" id="block-amenity-btn" class="btn btn-primary">Block</button>
                        </form>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>

<div class="modal" id="unblockAmenityModal" tabindex="-1"  role="dialog" aria-labelledby="unblockAmenityModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {{ "Please confirm to un-block " }} <span id="name-amenity"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ 'Close' }}</button>
                <input type="hidden" name="unblock_amenity_id" id="unblock_amenity_id" value=""/>
                <button type="button" class="btn btn-secondary" id="unblock-confirm" >{{ 'Confirm' }}</button>
              
            </div>
        </div>
</div>


<style>
    h1.sb-page-header-title {
    padding-left: 12px;
}
</style>
<script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                
                $(".un-block-amenity").click(function(){
                     $("#name-amenity").text($(this).data('name'));
                     $("#unblock_amenity_id").val($(this).attr('id'));
                })


                $('.block-amenity').click(function(){
                    var amenityId = $(this).attr('id');
                    $("#amenity_id").val(amenityId);
                });

                $('#block-amenity-btn').click(function(){
                    
                    var amenityId = $("#amenity_id").val();
                    var start_date = $("#start_date").val();
                    var end_date = $("#end_date").val();

                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });
                    $.ajax({
                                url: "/admin/amenities/block" ,
                                type: "POST",
                                data: { amenityId: amenityId, start_date:start_date, end_date:end_date },
                                success: function( response ) {
                                    if(response.status == 1){
                                       $('.confirm-success').text(response.message);
                                       setTimeout(function(){
                                        location.reload();
                                       },1000)
                                    }
                                }
                            });
                });

                $("#unblock-confirm").click(function(){
                    var amenityId = $("#unblock_amenity_id").val();
                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });
                    $.ajax({
                                url: "/admin/amenities/unblock" ,
                                type: "POST",
                                data: { amenityId: amenityId },
                                success: function( response ) {
                                    if(response.status == 1){
                                      //     $('.confirm-success').text(response.message);
                                       setTimeout(function(){
                                        location.reload();
                                       },1000)
                                    }
                                }
                            });
                });
                
                
            
            });
</script>



@endsection
