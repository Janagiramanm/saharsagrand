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
                                                @foreach ($nominees as $nominee)
                                                    <tr>
                                                        <td>{{ $index++ }}</td>
                                                        <td><img class="nominee_photo" src="{{URL::to('/images/nominees/'.$nominee->photo)}}"/></td>
                                                        <td>{{ $nominee->user->name }}</td>
                                                        <td>{{ $nominee->posting->name }}</td>
                                                        <td>{{ $nominee->contribute_time }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                            <button type="button" class="btn btn-primary nominee-validate" data-act="accept " data-id="{{ $nominee->id }}" >Accept</button>
                                                            <!-- <a title="Accept" href="#" id="{{ $nominee->id }}" class="btn btn-secondary btn-sm accept-btn">Accept</a> -->
                                                            </div>
                                                            <div class="btn-group">
                                                            <button type="button" class="btn btn-danger nominee-validate" data-act="reject" data-id="{{ $nominee->id }}" >Reject</button>
                                                            <!-- <a title="Reject" href="{{ route('nominees.edit',$nominee->id)}}" class="btn btn-secondary btn-sm">Reject</a> -->
                                                            </div>
                                                        </td>
                                                    
                                                    </tr>
                                                @endforeach
                                    </table>


                            <!-- <div id="tabs">
                                    <ul>
                                        <li><a href="#new">New Nominees</a></li>
                                        <li><a href="#selected">Selected Nominees</a></li>
                                        <li><a href="#rejected">Rejected Nominees</a></li>
                                    </ul>
                                    <div id="new">
                                    <table class="table table-bordered">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nominee Photo</th>
                                                    <th>Nominee Name</th>
                                                    <th>Posting</th>
                                                    <th>Action</th>
                                                </tr>
                                                @php
                                                    $index = $nominees->firstItem()
                                                @endphp
                                                @foreach ($nominees as $nominee)
                                                    <tr>
                                                        <td>{{ $index++ }}</td>
                                                        <td><img class="nominee_photo" src="{{URL::to('/images/nominees/'.$nominee->photo)}}"/></td>
                                                        <td>{{ $nominee->user->name }}</td>
                                                        <td>{{ $nominee->posting->name }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>
                                                       
                                                            </div>
                                                            <div class="btn-group">
                                                            <a title="Reject" href="{{ route('nominees.edit',$nominee->id)}}" class="btn btn-secondary btn-sm">Reject</a>
                                                            </div>
                                                        </td>
                                                    
                                                    </tr>
                                                @endforeach
                                    </table>
                                    </div>
                                    <div id="selected">
                                    <table class="table table-bordered">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nominee Photo</th>
                                                    <th>Nominee Name</th>
                                                    <th>Posting</th>
                                                    <th>Action</th>
                                                </tr>
                                                @php
                                                    $index = $nominees->firstItem()
                                                @endphp
                                                @foreach ($nominees as $nominee)
                                                   @if($nominee->status == 2)
                                                    <tr>
                                                        <td>{{ $index++ }}</td>
                                                        <td><img class="nominee_photo" src="{{URL::to('/images/nominees/'.$nominee->photo)}}"/></td>
                                                        <td>{{ $nominee->user->name }}</td>
                                                        <td>{{ $nominee->posting->name }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                            <a title="Accept" href="#" id="{{ $nominee->id }}"  class="btn btn-secondary btn-sm accept-btn">Accept</a>
                                                            </div>
                                                            <div class="btn-group">
                                                            <a title="Reject" href="{{ route('nominees.edit',$nominee->id)}}" class="btn btn-secondary btn-sm">Reject</a>
                                                            </div>
                                                        </td>
                                                    
                                                    </tr>
                                                    @endif
                                                @endforeach
                                    </table>
                                    </div>
                                    <div id="rejected">
                                    <table class="table table-bordered">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nominee Photo</th>
                                                    <th>Nominee Name</th>
                                                    <th>Posting</th>
                                                    <th>Action</th>
                                                </tr>
                                                @php
                                                    $index = $nominees->firstItem()
                                                @endphp
                                                @foreach ($nominees as $nominee)
                                                   @if($nominee->status == 0)
                                                    <tr>
                                                        <td>{{ $index++ }}</td>
                                                        <td><img class="nominee_photo" src="{{URL::to('/images/nominees/'.$nominee->photo)}}"/></td>
                                                        <td>{{ $nominee->user->name }}</td>
                                                        <td>{{ $nominee->posting->name }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                            
                                                            
                                                            </div>
                                                            <div class="btn-group">
                                                            <a title="Reject" href="{{ route('nominees.edit',$nominee->id)}}" class="btn btn-secondary btn-sm">Reject</a>
                                                            </div>
                                                        </td>
                                                    
                                                    </tr>
                                                    @endif
                                                @endforeach
                                    </table>
                                    </div>
                                    </div>  -->
                        </div>
                    </div>
                 
            </div>
        </div>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
   

   <style>
   img.nominee_photo {
    width: 100px;
}
   </style>
<script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>



@endsection
