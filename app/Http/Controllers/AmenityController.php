<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Amenity;
use App\AmenityTime;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $amenities = Amenity::paginate(5);
        return view('amenities.index',compact(['amenities']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return view('amenities.create', compact(['days']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:amenities,name',
            
        ]);

            
        $name = $request->input('name');
        $advance_book = $request->input('advance_book');
        $amenity_logo = $request->file('logo');

        $startDate = Carbon::createFromFormat('d/m/Y', $request->input('start_date'))->format('Y-m-d');
               

        $amenity = new Amenity();
        $amenity->name = $name;
        $amenity->advance_book = $advance_book;
        if (request()->hasFile('logo')) {
            $logo = request()->file('logo');
            $logoimage = $logo->getClientOriginalName() . time() . "." . $logo->getClientOriginalExtension();
            $logo->move(public_path('images'), $logoimage);
            $amenity->logo = $logoimage;
        }
        $amenity->time_slots = $request->input('time_setting') ? true : false ;
        $amenity->save();
        if($request->input('time_setting')){
            $starts = $request->input('start');
            $ends = $request->input('end');
            foreach($starts as $key => $start ){
                  $time = new AmenityTime();
                  $time->amenity_id = $amenity->id;
                  $time->day = $key;
                  $time->start_time = $start;
                  $time->end_time =  $ends[$key];
                  $time->save();
            }
            

        }
        return redirect( route('amenities'))->withSuccess('Amenity added successfully!');
       
        
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
        $amenity = Amenity::find($id);
        $times = AmenityTime::where('amenity_id','=',$id)->get();
       
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return view('amenities.edit',compact(['amenity','days','times']));
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
        $request->validate([
            'name' => 'required|unique:amenities,name,'.$id,
            
        ]);
     
        $name = $request->input('name');
        $advance_book = $request->input('advance_book');
        $amenity_logo = $request->file('logo');

      

        $amenity = Amenity::find($id);
        $amenity->name = $name;
        $amenity->advance_book = $advance_book;
        $amenity->time_slots = $request->input('time_setting') ? true : false ;
     
        if (request()->hasFile('logo')) {
            $logo = request()->file('logo');
            $logoimage = $logo->getClientOriginalName() . time() . "." . $logo->getClientOriginalExtension();
            $logo->move(public_path('images'), $logoimage);
            $amenity->logo = $logoimage;
        }
        $amenity->save();
        if($amenity->time_slots == false){
            AmenityTime::where('amenity_id',$id)->delete();
        }
        if($request->input('time_setting')){
            $starts = $request->input('start');
            $ends = $request->input('end');
            foreach($starts as $key => $start ){
                  $time = AmenityTime::find($key);
                 
                  if($time != null){
                    $time->start_time = $start;
                    $time->end_time =  $ends[$key];
                    $time->save();
                  }else{
                    $time = new AmenityTime();
                    $time->amenity_id = $amenity->id;
                    $time->day = $key;
                    $time->start_time = $start;
                    $time->end_time =  $ends[$key];
                    $time->save();
                  }
            }
            

        }
        return redirect( route('amenities'))->withSuccess('Amenity added successfully!');
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

    /**
     * to block amenity
     */
    public function block(Request $request){
        $id = $request->input('amenityId');
        $start_date = date('Y-m-d',strtotime($request->input('start_date')));
        $end_date = date('Y-m-d',strtotime($request->input('end_date')));
             
        $amenity = Amenity::find($id);
        $amenity->active = 0;
        $amenity->start_date = $start_date;
        $amenity->end_date = $end_date;
        if($amenity->save()){
            $msg = [
                'status'=> 1,
                'message' => $amenity->name . ' has been blocked',
                
            ];
            return response()->json($msg);
        }

    }

    public function unBlock(Request $request){

        $id = $request->input('amenityId');
        $amenity = Amenity::find($id);
        $amenity->active = 1;
        $amenity->start_date = NULL;
        $amenity->end_date = NULL;
        if($amenity->save()){
            $msg = [
                'status'=> 1,
                'message' => $amenity->name . ' has been un-blocked',
                
            ];
            return response()->json($msg);
        }

    }
}
