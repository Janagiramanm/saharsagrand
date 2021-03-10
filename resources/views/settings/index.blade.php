@extends('layouts.admin')
@section('breadcrum')
     Settings
@endsection

@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Settings</span></h1>

                </div>
                <div>
                    <a class="btn btn-info" href="{{ route('settings.create') }}">Add New Setting</a>
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
                           
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif

                            

                           
                            <table class="table table-bordered">
                                <tr>
                                    
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                                
                                @foreach ($settings as $setting)
                                    <tr>
                                        <td>{{ $setting->name }}</td>
                                        <td>{{ $setting->start_date }}</td>
                                        <td>{{ $setting->end_date }}</td>
                                        <!-- <td>
                                            <div class="btn-group">
                                            <a title="Edit" href="{{ route('settings.create',$setting->id)}}" class="btn btn-secondary btn-sm">Edit</a>
                                            </div>
                                        </td> -->
                                       
                                    </tr>
                                @endforeach
                            </table>
                            <div class="btn-group">
                                <a title="Edit" href="{{ route('settings.create'    )}}" class="btn btn-secondary btn-sm">Edit</a>
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
