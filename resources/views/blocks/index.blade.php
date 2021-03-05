@extends('layouts.admin')
@section('breadcrum')
     Blocks
@endsection

@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Blocks</span></h1>

                </div>
                <div>
                    <a class="btn btn-info" href="{{ route('block.create') }}">Add New Block</a>
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
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                @php
                                    $index = $blocks->firstItem()
                                    @endphp
                                @foreach ($blocks as $block)
                                    <tr>
                                        <td>{{ $index++ }}</td>
                                        <td>{{ $block->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                            <a title="Edit" href="{{ route('block.edit',$block->id)}}" class="btn btn-secondary btn-sm">Edit</a>
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


<style>
    h1.sb-page-header-title {
    padding-left: 12px;
}
</style>




@endsection
