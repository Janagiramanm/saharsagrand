<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticker;
use App\Booking;
use Auth;

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
   
    /**
     * User Dashboard
     */
    public function userDashboard(){
        $user = Auth::user();
        $bookings = Booking::where('user_id','=',$user->id)->get();
        $result['booking_count'] = $bookings->count();
        return view('dashboards.user',compact(['result']));
    }


}
