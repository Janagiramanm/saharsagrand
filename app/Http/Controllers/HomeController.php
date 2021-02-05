<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticker;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * home page
     */
    public function homePage(){
        $tickers =  Ticker::all();
        return view('welcome',compact(['tickers']));
    }
}
