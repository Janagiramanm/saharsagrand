<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Amenity;
use App\AmenityTime;

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
        $amenities = Amenity::paginate(10);
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

        $amenity = new Amenity();
        $amenity->name = $name;
        $amenity->advance_book = $advance_book;
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
        $amenity = Amenity::find($id);
        $amenity->name = $name;
        $amenity->advance_book = $advance_book;
        $amenity->time_slots = $request->input('time_setting') ? true : false ;
        $amenity->save();
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
}
