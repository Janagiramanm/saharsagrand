<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;
use App\Flat;
use App\Amenity;
use App\Ticker;
use Carbon\Carbon;
use Session;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $blocks = Block::All();
        $amenities = Amenity::where('active','=',1)->get();
        $tickers =  Ticker::where(function($q){
                    $q->where(function($q){
                        $q->whereNull('start_date')
                          ->whereNull('end_date');
                    })->orWhere(function($q){
                        $q->where('start_date', '<=', Carbon::now()->format('Y-m-d'))
                          ->where('end_date', '>=', Carbon::now()->format('Y-m-d'));
                    });
            })->where('active','=',1)->get();
        Session::put('tickers', $tickers);
        return view('welcome', compact(['blocks','amenities','tickers']));

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
        //
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
}
