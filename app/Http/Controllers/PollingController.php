<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nominee;
use App\Polling;
use App\VotedUser;
use Auth;

class PollingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$candidates = [];
        $user_id= Auth::user()->id;
        $voted = VotedUser::where('user_id','=',$user_id)->get();
        if($voted){
            foreach($voted as $vote){
                $voter[$vote->posting_id]='false';
            }
        }
       
        $candidates = Nominee::where('status','=',2)->orderBy('posting_id','ASC')->get();
        return view('polling.create',compact(['candidates','voter']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $voterId = Auth::user()->id;
        $isVoted = VotedUser::where('user_id','=',$voterId)->where('posting_id','=',$request->posting_id)->first();
        if($isVoted){
            $msg = [
                'status' =>0,
                'message' => 'already voted'
            ];
            return response()->json($msg);
        }
        $polling = new Polling();
        $polling->posting_id = $request->posting_id;
        $polling->vote = $request->candidate_id;
        if($polling->save()){
            $voter = new VotedUser();
            $voter->posting_id = $request->posting_id;
            $voter->user_id = $voterId;
            $voter->save();
            $msg = [
                'status' =>1,
                'message' => 'success'
            ];
        }
        return response()->json($msg);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getResult(){

        
        $winners = [];
        $candidates = Nominee::where('status','=',2)->orderBy('posting_id','ASC')->get();
        if($candidates){
            foreach($candidates as $nominee){
                $result[$nominee->posting->name][$nominee->user_id] = Polling::where('vote','=',$nominee->user_id)->get()->count();
            }
        }
        if($result){
            foreach($result as $key =>  $value){
               
                $val = max($value);
                if(count(array_keys($value, $val)) == 1 ){
                      $winners[$key] = array_search($val, $result[$key]);
                }else{
                    $winners[$key] = 'die';
                }
            }
        }
        return view('polling.pie',compact(['result','winners']));
        
    }

    // public function largest($arr)
    // {
    //     $i = 0;
    //     foreach($arr as $key => $val){
    //         if($i == 0){
    //             $max = $val;
    //             $win = $key;
    //         }
    //         if ($val > $max)
    //              $win = $key;
    //       $i++;
    //     }
    //      return $win;
    // }   

    
}
