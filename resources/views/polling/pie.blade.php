@extends('layouts.user')

@section('content')
   
       @php
          $posting_name = '';
       @endphp

       <div >Election Results</div>
       <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      
     
      @foreach($result as $key => $res)
       <div class="card">
       <div class="row">
             <div class="col-md-12">
                 <h3>{{$key}} Candidates </h3>
             </div>
              <div class="col-md-8">
              <div id="{{$key}}" ></div>
                  <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                    // var data = google.visualization.arrayToDataTable([
                    //     ['Name', 'Votes'],
                    //     @php
                    //       foreach($res as $userid => $voteCount){
                    //             $candidateName = App\User::where('id','=',$userid)->first()->name;
                    //             echo "['".$candidateName."', ".$voteCount."],";
                    //         }
                    //     @endphp
                        
                    // ]);
                    // var options = {
                    //         chartArea: {
                    //           // leave room for y-axis labels
                    //           width: '94%'
                    //         },
                    //         legend: {
                    //           position: 'top'
                    //         },
                    //         width: '100%',
                    //         height: '400',
                    //         // colors: ['red','green', 'purple'],
                    //         pieHole: 0.4,
                    //   };
                    //   var chart = new google.visualization.PieChart(document.getElementById('{{$key}}'));


                    var data = google.visualization.arrayToDataTable([
                          ['Element', 'Votes'],
                             @php
                              foreach($res as $userid => $voteCount){
                                $candidateName = App\User::where('id','=',$userid)->first()->name;
                               echo "['".$candidateName."', ".$voteCount."],";
                              }
                            @endphp
                      ]);
                    var options = {
                            width: '100%',
                            height: '200',
                            colors: ['red','green', 'purple'],
                     };
                    var chart = new google.visualization.BarChart(document.getElementById('{{$key}}'));
                      

                      

                    
                     

                      chart.draw(data, options);
                    }
                </script>
              </div>
              <div class="col-md-4">
                 <div class="">
                 
                  @php
                          $photo ='';
                          $candidateName ='';
                          if($winners[$key] != 'die'){
                            $die = 'no';
                            $candidateName = App\User::where('id','=',$winners[$key])->first()->name;
                            $photo = App\Nominee::where('user_id','=',$winners[$key])->first()->photo;
                          }
                        
                  @endphp
                     @if($winners[$key] != 'die')
                          <div class="card" >
                            <img  src="{{URL::to('/images/nominees/'.$photo)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title"> 
                                  <h4>{{ $candidateName }} <span class="badge bg-secondary">Winner</span></h4>
                              </h5>
                            
                            </div>
                          </div>
                       
                    @else
                          <div class="card" >
                            <div class="card-body">
                             <div class="img-div">
                                  <img  src="{{URL::to('/images/handshake.jpg')}}" class="card-img-top" alt="...">
                             </div>
                           
                             
                              <h5 class="card-title"> 
                                  <h4><span class="badge bg-secondary">Equal</span></h4>
                              </h5>
                            
                            </div>
                          </div>

                    @endif
                  </div>
              </div>

       </div>
       </div>
    
      @endforeach

<style>
.col-md-6.winner-sec {
    padding-left: 138px;
}

.equal-sec {
    /* margin-top: 176px; */
    padding-top: 50%;
    font-size: 24px;
    color: darkred;
}
.card{
  margin-top:20px;
  margin-bottom:20px;
  min-height: 208px;
  text-align: center;
  width:100%;
}
.winner-section {
    // background: #EEE;
    text-align: center;
    height: 100%;
    border-radius: 20px;
    display: block;
    width: 100%;
    padding: 20px;
}
.candidate-name {
    font-size: 33px;
    font-family: sans-serif;
    color: #ff7b07;
    font-weight: bold;
}
.img-div {
    width: 100%;
    height: 248px;
}
.img-div img{
  object-fit: cover;
    height: 100%;
    width: 100%;
}
</style>
@endsection