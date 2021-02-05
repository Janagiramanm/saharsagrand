<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticker;

class TickerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tickers = Ticker::paginate(5);
        return view('tickers.index',compact(['tickers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickers.create');
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
            'ticker_news' => 'required',
            
        ]);

        $ticker = new Ticker();
        $ticker->ticker_news = $request->input('ticker_news');
        $ticker->start_date = $request->input('start_date');
        $ticker->end_date = $request->input('end_date');
        $ticker->save();
        return redirect( route('tickers'))->withSuccess('Ticker added successfully!');

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
        $ticker = Ticker::find($id);
        return view('tickers.edit',compact(['ticker']));
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
        $request->validate([
            'ticker_news' => 'required',
            
        ]);
        $ticker = Ticker::find($id);
        $ticker->ticker_news = $request->input('ticker_news');
        $ticker->start_date = $request->input('start_date');
        $ticker->end_date = $request->input('end_date');
        $ticker->save();
        return redirect( route('tickers'))->withSuccess('Ticker updated successfully!');
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
