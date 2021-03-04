@extends('layouts.admin')
@section('breadcrum')
     Users
@endsection


@section('content')
    <div class="container">
        <div class="sb-page-header-content">
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

                        <div class="filter_form">
                           <form class="form-inline" method="get"  action="{{ route('users.list') }}">
                                <div class="row">
                                   
                                    <div class="form-group mx-sm-2 mb-2 col-3">
                                       
                                        <input type="text" placeholder="Search" class="form-control" id="search" name="search" value="{{ request()->input('search') }}">
                                    </div>
                                        <button type="submit" class="form-group btn btn-primary mr-3 mb-2 col-1">
                                                {{ __('Search') }}
                                            </button>
                                    <a title="Reset" href="{{route('users.list')}}" class="form-group btn btn-group btn-outline-dark  mb-2 col-1">Reset</a>
                                </div>
                            </form>

                        </div>
                            

                           
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
                                
                                @forelse($users as $user)

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
                                @empty
                                    <tr>
                                        <td colspan="9">No User Found</td>
                                    </tr>
                                @endforelse
                               
                            </table>
                            <div>
                            {{ $users->links() }}
                            </div>

                           
                           
                        </div>
                    </div>

                 

            </div>
        </div>
    </div>

@endsection
