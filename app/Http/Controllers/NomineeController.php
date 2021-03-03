<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticker;
use Carbon\Carbon;
use Auth;
use App\Posting;
use App\Nominee;
use App\Http\Helpers\AppHelper;

class NomineeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nominees = Nominee::paginate(5);
        return view('nominees.index',compact(['nominees']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
        $user = Auth::user();
        $postings =  Posting::all();
        return view('nominees.create',compact(['user','postings']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->user_id = $user->id;
        $request->request->add(['user_id' => $user->id]);


        $request->validate([
            'user_id' => 'required|unique:nominees,user_id',
            'posting_id' => 'required',
            'nominee_photo' => 'mimes:jpeg,jpg|required|max:10000',
            'contribute_time' => 'required'
           
        ]);
         
         $nominees = new Nominee();
         $nominees->user_id =  $user->id;
         $nominees->posting_id =  $request->input('posting_id');
         $nominees->contribute_time =  $request->input('contribute_time');
         if (request()->hasFile('nominee_photo')) {
            $photo = request()->file('nominee_photo');
            $nominee_photo = $photo->getClientOriginalName() . time() . "." . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/nominees'), $nominee_photo);
            $nominees->photo = $nominee_photo;
        }
        if($nominees->save()){
            $posting =  Posting::find($nominees->posting_id);
            AppHelper::nominationSms($user->name, $user->mobile, $posting->name);
            return redirect( route('nominees.create'))->withSuccess('Your nominee registration successfully done. You will get confirmation soon.');
        }
        
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


    public function nomineeVerification(Request $request){
         
          $status = 0;
          if($request->act == 'Accept'){
              $status = 2;
          }
          $nominee = Nominee::find($request->id);
          $nominee->status = $status;
          if($nominee->save()){
            //    echo $nominee->user->name;
            //    echo $nominee->user->mobile;
            //    exit;
                AppHelper::nominationFinalizedSms($nominee->user->name, $nominee->user->mobile, $nominee->posting->name, $status);
                $msg = [
                    'status'=> 1,
                    'message' => 'Success',
                ];
          }
          return response()->json($msg);
    }
}
