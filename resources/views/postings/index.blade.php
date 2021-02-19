@extends('layouts.admin')

@section('breadcrum')
     Postings
@endsection

@section('content')

    <div class="container">
        <div class="sb-page-header-content">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Postings</span></h1>

                </div>
                <div>
                    <a class="btn btn-info" href="{{ route('postings.create') }}">Add Posting</a>
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
                                    $index = $postings->firstItem()
                                @endphp
                                @foreach ($postings as $posting)
                                    <tr>
                                        <td>{{ $index++ }}</td>
                                        <td>{{ $posting->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                            <a title="Edit" href="{{ route('postings.edit',$posting->id)}}" class="btn btn-secondary btn-sm">Edit</a>
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







@endsection
