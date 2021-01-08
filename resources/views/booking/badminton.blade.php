@extends('layouts.app')

@section('content')
    <div class="main-container">
        <div class="container">
            <div class="container-block">
                <div class="inner-page">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="title">
                                <h3>Book Badminton</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="calendar"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        var calendar = $("#calendar").calendar(
            {
                tmpl_path: "/tmpls/",
                events_source: function () { return []; }
            });
    </script>

@endsection
