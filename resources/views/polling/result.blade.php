@extends('layouts.user')

@section('content')
   
       @php
          $posting_name = '';
       @endphp
        <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Winners
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row text-center">
                              @if($winners)
                                @foreach($winners as $key => $value)
                                       @php
                                            $user = App\User::find($value);
                                            $photo = App\Nominee::where('user_id','=',$value)->first()->photo;
                                           
                                       @endphp
                                            <div class="col-md-6">
                                                <div for="" class="posting-name"> {{ ucwords($key) }} Candidate </div>
                                                <div class="info-card  col-md-6 active">
                                                   
                                                    <div class="candidate-img">
                                                    <img class="photo" src="{{URL::to('/images/nominees/'.$photo)}}"/>
                                                    </div>
                                                    <div class="candidate-name">
                                                        {{ $user->name }}
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                   @endforeach
                              @endif
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Candidate Votes   
                        </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row" >
                                <!-- <table class="table table-borderless"> -->
                                    
                                    @foreach ($candidates as $candidate)
                                        @php
                                            $voteCount =  App\Polling::where('vote','=',$candidate->user_id)->get()->count();
                                        @endphp
                                        @if($candidate->posting->name !=  $posting_name )
                                            <div for="" class="posting-name"> {{ ucwords($candidate->posting->name) }} Candidates </div>
                                             
                                        @endif
                                                <div class="col-md-3">
                                                    <div class="info-card active">
                                                        <div class="candidate-img">
                                                        <img class="photo" src="{{URL::to('/images/nominees/'.$candidate->photo)}}"/>
                                                        </div>
                                                        <div class="candidate-name">
                                                            {{ $candidate->user->name }}
                                                        </div>
                                                        <div class="votes-count">
                                                            Votes - {{ $voteCount }}
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                        
                                        @php  
                                            $posting_name = $candidate->posting->name;
                                        @endphp
                                    @endforeach
                                <!-- </table> -->
                       
                        </div>
                        </div>
                    </div>
                    
        </div>

        <style>
.candidate-img {
    height: 140px;
    width: 150px;
}
.candidate-img img.photo {
    object-fit: cover;
    width: 100%;
    height: 100%;
}
.posting-name {
    background: #FAFAFA;
    padding: 5px;
    margin-bottom: 10px;
    margin-left: 13px;
    text-align: center;
    font-weight: bolder;
    font-size: 22px;
}

</style>

                      
@endsection