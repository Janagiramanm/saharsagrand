@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Notifications</span></h1>

                </div>
                <div>
                    <a class="btn btn-info" href="{{ route('notifications.create') }}">Send Notification</a>
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
                                    $index = $notifications->firstItem()
                                    @endphp
                                @foreach ($notifications as $notification)
                                    <tr>
                                        <td>{{ $index++ }}</td>
                                        <td>{{ $notification->user_id }}</td>
                                        <td>{{ $notification->message_id }}</td>
                                       
                                       
                                    </tr>
                                @endforeach
                            </table>

                            
                           
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
