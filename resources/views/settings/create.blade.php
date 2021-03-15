@extends('layouts.admin')
@section('parent_link')
    <a href="{{ route('settings.index') }}" class="breadcrumb-item"> Settings </a>
@endsection
@section('breadcrum')
    Add New Settings
@endsection

@section('content')
    <div class="container">
        <div class="sb-page-header-content py-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="sb-page-header-title"><span>Election Settings</span></h1>
                </div>
        </div>

        </div>
        <div class="row">
            <div class="col-8">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                       <form action="{{ route('settings.store') }}" method="POST">
                            @csrf
                          
                               @forelse($settings as $setting)
                                    <div class="row">
                                         <div class="col-xs-2 col-sm-2 col-md-2">
                                                <div class="form-group setting-lbl">
                                                    <label>{{ ucfirst($setting->name) }}<span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 mt-3">
                                                    <label>Start Date</label>
                                                    <input class="form-control" type="date" id="{{$setting->name}}_start_date" name="{{$setting->name}}[start_date]" 
                                                        value="{{ date('Y-m-d',strtotime($setting->start_date)) }}"
                                                        min="{{ $setting->start_date ? date('Y-m-d',strtotime($setting->start_date)) : date('Y-m-d') }}" max="{{ date('Y-12-31') }}" />
                                            </div>
                                            <div class="form-group col-md-4 mt-3">
                                                <label>End Date</label>
                                                <input class="form-control" type="date" id="{{$setting->name}}_end_date" name="{{$setting->name}}[end_date]"
                                                    value="{{ date('Y-m-d',strtotime($setting->end_date)) }}"
                                                    min="{{ $setting->end_date ? date('Y-m-d',strtotime($setting->end_date)) : date('Y-m-d') }}" max="{{ date('Y-12-31') }}" />
                                            </div>
                                    </div>
                                 
                            

                            @empty
                           
                            <div class="row">
                               
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <div class="form-group setting-lbl">
                                        <label>Nomination<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                        <label>Start Date</label>
                                        <input class="form-control" type="date" id="nominee_start_date" name="nomination[start_date]" 
                                            value="{{ date('d-m-Y') }}"
                                            min="{{ date('Y-m-d') }}" max="{{ date('Y-12-31') }}" />
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    <label>End Date</label>
                                    <input class="form-control" type="date" id="nominee_end_date" name="nomination[end_date]"
                                        value="{{  date('d-m-Y')}}"
                                        min="{{ date('Y-m-d') }}" max="{{ date('Y-12-31') }}" />
                                </div>
                            </div>
                            <div class="row">
                               
                               <div class="col-xs-2 col-sm-2 col-md-2">
                                   <div class="form-group setting-lbl">
                                       <label>Polling<span class="text-danger">*</span></label>
                                   </div>
                               </div>
                               <div class="form-group col-md-4 mt-3">
                                       <label>Start Date</label>
                                       <input class="form-control" type="date" id="polling_start_date" name="polling[start_date]"
                                           value="{{ date('d-m-Y')}}"
                                           min="{{ date('Y-m-d') }}" max="{{ date('Y-12-31') }}" />
                               </div>
                               <div class="form-group col-md-4 mt-3">
                                   <label>End Date</label>
                                   <input class="form-control" type="date" id="polling_end_date" name="polling[end_date]"
                                       value="{{ date('d-m-Y')}}"
                                       min="{{ date('Y-m-d') }}" max="{{ date('Y-12-31') }}"/>
                               </div>
                           </div>
                           <div class="row">
                               
                               <div class="col-xs-2 col-sm-2 col-md-2">
                                   <div class="form-group setting-lbl">
                                       <label>Results<span class="text-danger">*</span></label>
                                   </div>
                               </div>
                               <div class="form-group col-md-4 mt-3">
                                       <label>Start Date</label>
                                       <input class="form-control" type="date" id="result_start_date" name="result[start_date]"
                                           value="{{ date('d-m-Y')}}"
                                           min="{{ date('Y-m-d') }}" max="{{ date('Y-12-31') }}" />
                               </div>
                               <div class="form-group col-md-4 mt-3">
                                   <label>End Date</label>
                                   <input class="form-control" type="date" id="result_end_date" name="result[end_date]"
                                       value="{{ date('d-m-Y')}}"
                                       min="{{ date('Y-m-d') }}" max="{{ date('Y-12-31') }}" />
                               </div>
                           </div>
                           @endforelse
                           <div class="col-xs-12 col-sm-12 col-md-12 mt-4 ">
                                   <button type="submit" class="btn btn-primary">{{ 'Submit' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#nominee_start_date").on('change', function (selected) {
            var fromDate = $(this).val();
            var toDate = $('#nominee_end_date').val();
            if(toDate != ""){
                $('#nominee_end_date').val(fromDate);
            }
            $('#nominee_end_date').attr('min', fromDate);
        });
        $("#polling_start_date").on('change', function (selected) {
            var fromDate = $(this).val();
            var toDate = $('#polling_end_date').val();
            if(toDate != ""){
                $('#polling_end_date').val(fromDate);
            }
            $('#polling_end_date').attr('min', fromDate);
        });
        $("#result_start_date").on('change', function (selected) {
            var fromDate = $(this).val();
            var toDate = $('#result_end_date').val();
            if(toDate != ""){
                $('#result_end_date').val(fromDate);
            }
            $('#result_end_date').attr('min', fromDate);
        });

    });
    </script>
@endsection
