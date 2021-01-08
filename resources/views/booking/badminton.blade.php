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
                       <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="act-cont">
                                <div class="user-details">
                                    <div class="user-name"><h4>Janakiraman</h4></div>
                                    <div class="user-name"><h6>Flat No. 1232</h6></div>
                                </div>
                                <div class="activity-container">
                                    <div class="custom-control custom-radio custom-control-inline">

                                        <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline1">Family Members</label>

                                        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input ml-4">
                                        <label class="custom-control-label" for="customRadioInline2">Apartment Members</label>
                                    </div>
                                </div>
                                <div class="activity-member">
                                    <h4>Add Members Details</h4>
                                    <p>Min 2 and Max 6 Players are allowed per Slot</p>

                                    <div class="members">
                                        <div class="input-group pb-4">
                                            <input type="text" class="form-control" placeholder="Player Name" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button">Remove</button>
                                                <button class="btn btn-outline-secondary" type="button">Add More</button>
                                            </div>
                                        </div>
                                        <div class="input-group pb-4">
                                            <input type="text" class="form-control" placeholder="Player Name" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button">Remove</button>
                                                <button class="btn btn-outline-secondary" type="button">Add More</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
