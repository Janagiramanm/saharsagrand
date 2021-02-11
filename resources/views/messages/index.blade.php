@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Templates</span></h1>

                </div>
                <div>
                    <a class="btn btn-info" href="{{ route('messages.create') }}">Add New Template</a>
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
                                    <th>Template Name </th>
                                    <th>SMS Content</th>
                                    <th>Email Content</th>
                                    <th>Action</th>
                                </tr>
                                @php
                                    $index = $messages->firstItem()
                                    @endphp
                                @foreach ($messages as $message)
                                    <tr>
                                        <td>{{ $index++ }}</td>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ strip_tags($message->sms) }}</td>
                                        <td>{{ strip_tags($message->email) }}</td>
                                        
                                        <td>
                                            <div class="btn-group">
                                            <a title="Edit" href="{{ route('messages.edit',$message->id)}}" class="btn btn-secondary btn-sm">Edit</a>
                                            </div>
                                        </td>
                                       
                                    </tr>
                                @endforeach
                            </table>
                            <div>
                            {{ $messages->links() }}
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
