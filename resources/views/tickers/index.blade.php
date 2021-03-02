@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Tickers</span></h1>

                </div>
                <div>
                    <a class="btn btn-info" href="{{ route('ticker.create') }}">Add New Ticker</a>
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
                                    <th>Ticker News</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                                @php
                                    $index = $tickers->firstItem()
                                    @endphp
                                @foreach ($tickers as $ticker)
                                    <tr>
                                        <td>{{ $index++ }}</td>
                                        <td style="width:770px;">{{ strip_tags($ticker->ticker_news) }}</td>
                                        <td>{{ $ticker->start_date }}</td>
                                        <td>{{ $ticker->end_date }}</td>
                                        <td>
                                            <div class="btn-group">
                                            <a title="Edit" href="{{ route('ticker.edit',$ticker->id)}}" class="btn btn-secondary btn-sm">Edit</a>
                                            </div>
                                        </td>
                                       
                                    </tr>
                                @endforeach
                            </table>
                            <div>
                            {{ $tickers->links() }}
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
