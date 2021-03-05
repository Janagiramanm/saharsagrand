<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;
use App\User;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blocks = Block::paginate(10);
        return view('blocks.index',compact(['blocks']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('blocks.create');
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
            'name' => 'required|unique:blocks,name',
                      
        ]);
        
        $block = new Block();
        $block->name = $request->input('name');
        $block->save();
        return redirect( route('blocks'))->withSuccess('Block added successfully!');
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
        $block = Block::where('id',$id)->first();
        return view('blocks.edit',compact(['block']));
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
            'name' => 'required|unique:blocks,name,'.$id,
                      
        ]);
        $block = Block::find($id);
        $block->name = $request->input('name');
        $block->save();
        return redirect( route('blocks'))->withSuccess('Block updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $isUserAdded = User::where('block_id','=',$id)->first();
        if($isUserAdded){
            return redirect('/admin/blocks')->withError('Can not delete this Block. Because some user belongs to this block.');
        }
        $block = Block::find($id);
        $block->delete();
        return redirect('/admin/blocks')->withSuccess('Block has been deleted successfully.');
      
    }
}
