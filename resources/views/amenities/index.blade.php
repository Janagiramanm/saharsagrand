@extends('layouts.app')

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

                            

                            <div class="card">
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
