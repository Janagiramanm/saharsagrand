<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Booking;

use Redirect;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bookings = Booking::paginate(10);
        return view('booking.index',compact(['bookings']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = auth()->user();

        if($user){
            $token = $user->createToken('access_token')->accessToken;
            $url = "https://booking.sahasragrand.com?bookingType=badminton&userToken=$token";
            return Redirect::to($url);
        }
        
       
        
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

    /**
     * to search booking from anonymous user
     */
    public function searchBooking(Request $request){
         $bookingCode = $request->input('code');
         $booking = Booking::where('booking_code','=',$bookingCode)->first();
         $returnHTML = view('booking.searchBook')->with('booking', $booking)->render();
//return response()->json(array('success' => true, 'html'=>$returnHTML));
         if($booking){
            $msg = [
                'status' => 1,
                'data' => $returnHTML
            ];
            return response()->json($msg);
         }

         $msg = [
            'status' => 0,
            'message' => 'No Records Found'
        ]; 
         return response()->json($msg);


         echo '<pre>';
         print_r($booking);
    }
}
