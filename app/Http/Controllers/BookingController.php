<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Booking;
use App\User;
use App\Amenity;

use Redirect;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user_id = $request->input('user_id');
        $amenity = $request->input('amenity_id');
        $booked_date = $request->input('book_date');
        $reference_code = $request->input('reference_code');

        $bookings = Booking::when($user_id, function ($q) use ($user_id){
            return $q->where('user_id', '=', $user_id);
        })->when($amenity, function($q) use($amenity){
            return $q->where('amenity_id','=',$amenity);
        })->when($booked_date, function($q) use($booked_date){
            return $q->where('booking_date','=',$booked_date);
        })->when($reference_code, function($q) use($reference_code){
            return $q->where('booking_code','=',$reference_code);
        })->latest('id')->paginate(5);

        $users = User::where('active','=',1)
                  ->where('role','!=','superadmin')->get();

        $amenities =  Amenity::where('active','=',1)->get();

        return view('booking.index',compact(['bookings','users','amenities']));
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

    }

    public function userBookings(Request $request){
           $user =  Auth::user();
          // $bookings = Booking::where('user_id','=',$user->id)->paginate(5);

           //$user_id = $request->input('user_id');
        $amenity = $request->input('amenity_id');
        $booked_date = $request->input('book_date');
        $reference_code = $request->input('reference_code');

        $bookings = Booking::when($amenity, function($q) use($amenity){
            return $q->where('amenity_id','=',$amenity);
        })->when($booked_date, function($q) use($booked_date){
            return $q->where('booking_date','=',$booked_date);
        })->when($reference_code, function($q) use($reference_code){
            return $q->where('booking_code','=',$reference_code);
        })->latest('id')->paginate(5);
           $amenities =  Amenity::where('active','=',1)->get();

           return view('booking.userBooking',compact(['bookings','user','amenities']));
    }
}
