@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Users</span></h1>

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

                            

                            <div class="card">
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
                                </tr>
                                @php
                                    $index = $users->firstItem()
                                    @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $index++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>{{ $user->block }}</td>
                                        <td>{{ $user->flat_number }}</td>
                                        <td>{{ $user->type }}</td>
                                        <td>
                                            @if($user->active == 1)
                                              <label>Active</label>
                                            @else
                                               <a class="btn btn-secondary btn-sm activate-btn"
                                                   href="#" form-data="{{ $user->id }}" >Activate</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

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
