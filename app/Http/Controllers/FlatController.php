<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flat;
use App\Block;
use Illuminate\Validation\Rule;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $flats = Flat::paginate(10);
        return view('flats.index',compact(['flats']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $blocks = Block::All();
        return view('flats.create',compact(['blocks']));
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
            'flat_number' => [
                'required',Rule::unique('flats')->where(function($query) use ($request) {
                   $query->where('active', '=', 1);
                   $query->where('block_id','=',$request->input('block'));
                   $query->where('flat_number','=',$request->input('flat_number'));
             }),
             
        ],
        ['flat_number.unique' => __('messages.unique', ['Already Exists'])],
                      
        ]);
        $flat = new Flat();
        $flat->block_id = $request->input('block');
        $flat->flat_number = $request->input('flat_number');
        $flat->active = 1;
        $flat->save();
        return redirect( route('flats'))->withSuccess('Flat added successfully!');
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
        
       
        $flat = Flat::where('id',$id)->first();
        $blocks = Block::All();
        return view('flats.edit',compact(['flat','blocks']));
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
        $flat = Flat::find($id);
        $flat->block_id = $request->input('block');
        $flat->flat_number = $request->input('flat_number');
        $flat->save();
        return redirect( route('flats'))->withSuccess('Flat updated successfully!');
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
