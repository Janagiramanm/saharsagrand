@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Users</span></h1>
                    <label class="success-msg"></label>
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
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Block</th>
                                    <th>Flat Number</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                    <th>Edit</th>
                                </tr>
                                @php
                                    $index = $users->firstItem()
                                    @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $index++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@if(isset($user->block->name)){{ $user->block->name }} @endif</td>
                                        <td>@if(isset($user->flat->flat_number)){{ $user->flat->flat_number }} @endif</td>
                                        <td>{{ $user->type }}</td>
                                        <td>
                                          
                                            <input data-id="{{$user->id}}" class="toggle-class user-change-status" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ ($user->active == 1) ? 'checked' : '' }}>
                                           
                                        </td>
                                        <td>
                                                <div class="btn-group">
                                                    <a title="Edit" href="{{route('user.edit',$user->id)}}" class="btn btn-secondary btn-sm">Edit</a>
                                                </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                           
                           
                        </div>
                    </div>

                    <div class="modal" id="de-active-confirm" tabindex="-1"  role="dialog" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
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
