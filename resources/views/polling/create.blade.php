@extends('layouts.user')

@section('content')
   
       @php
          $posting_name = '';
       @endphp
        @foreach ($candidates as $candidate)
                 @if($candidate->user->active == 1)
           
                    @if($candidate->posting->name !=  $posting_name )
                        <div for="" class="posting-name"> {{ ucwords($candidate->posting->name) }} Candidates </div>
                    @endif
                    
                        
                            <div class="col-md-3 col-sm-12 col-lg-3">
                                <div class="info-card active">
                                    <!-- <label for="" class="heading-lbl"> {{ $candidate->posting->name}} </label> -->
                                    <div class="candidate-img">
                                    <img class="photo" src="{{URL::to('/images/nominees/'.$candidate->photo)}}"/>
                                    </div>
                                    <div class="candidate-name">
                                        {{ $candidate->user->name }}
                                    </div>
                                    <div>
                                    <input type="radio"  name="{{ $candidate->posting->name }}" value="{{ $candidate->user_id }}" /> Choose 
                                    </div>
                                </div>
                            </div>
                    @if(isset($voter[$candidate->posting->id]) != 'false')    
                        @if($candidate->posting->name ==  $posting_name )
                            <div class="vote-btn-sec">
                                <label for="" class="error-label" id="{{$candidate->posting->id}}_lbl"></label>
                                <br>
                            <button class="voting-btn col-lg-3" data-postingId="{{ $candidate->posting->id }}" id="{{ $candidate->posting->name }}">Vote</button>
                            </div>
                        @endif
                    @endif
                    @php  
                    $posting_name = $candidate->posting->name;
                    @endphp
                    
                @endif

               
        @endforeach
              
       
<style>
.candidate-img{
    height: 157px;
}
.candidate-img img.photo {
    object-fit: cover;
    width: 100%;
    height: 100%;
}
label.heading-lbl {
    font-size: 18px;
    text-align: center;
    margin-top: -30px;
    margin-bottom: 5px;
}
.candidate-name {
    text-align: center;
    padding: 5px;
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
.vote-btn-sec {
    margin-bottom: 17px;
    text-align: center;
}
button.voting-btn.col-lg-3 {
    background: green;
    color: white;
    font-weight: bolder;
    margin-bottom: 10px;

}
label.error-label {
    color: red;
}
label.success-label{
    color:green;
}
</style>
<script type="text/javascript">
   $(document).ready(function(){
      
        $(".voting-btn").click(function(){
           
            $(".error-label").text('');
            var candidate_id = $('input[name="'+$(this).attr('id')+'"]:checked').val();
            var posting_id =  $(this).attr('data-postingId');
             
            if(isEmpty(candidate_id)){
                $("#"+posting_id+"_lbl").text('Please select any one candidate.')
            }else{
                   $(this).css('display','none');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: '/user/voting',
                        data: {'candidate_id': candidate_id, 'posting_id':posting_id},
                        success: function(resp){
                            if(resp.status == 1){

                                 $("#"+candidate_id+"_lbl").removeClass('error-label');
                                 $("#"+candidate_id+"_lbl").addClass('success-label');
                                 $("#"+candidate_id+"_lbl").text('Thank you for voting')
                                 $(this).css('display','none');
                                 setTimeout(function(){
                                     location.reload();
                                 },2300)
                            }
                            // else{
                            //     $(".confirm-mismatch").html(resp.message)
                            // }
                        
                        }
                    });
             }
             
          })

   });
   function isEmpty(value){
  return (value == null || value.length === 0);
}


</script>
                      
@endsection