<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\AppHelper;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Booking;
use App\User;

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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       $token = $request->bearerToken();
       $user = User::where('remember_token','=',$token)->first();
       if(!$user){
        return response()->json( [
                    'status' => 0,
                    'message' => 'Invalid User',
                    ],200);
       }

       $timeSlots = $request->input('timeSlots');

       $booking_code = substr(md5(microtime()),rand(0,26),6);

       $booking = new Booking();
       $booking->booking_type = $request->input('bookingType');
       $booking->booking_date = $request->input('selectedDate');
       $booking->start_time = $timeSlots['startTime'];
       $booking->end_time = $timeSlots['endTime'];
       $booking->user_id = $user->id;
       $booking->total_guests = $request->input('totalGuests');
       $booking->booking_code = $booking_code;
       $booking->status = 1;
       $booking->save();

       $userDetails = User::find($user->id);
       
       AppHelper::BookingConfirmation($userDetails->name, $request->input('mobile'), $booking_code);
       if($userDetails->email!=''){
             Mail::to($userDetails->email)->send(new BookingConfirmation($user, $booking));
       }
       return response()->json( [
                                'status' => 1,
                                'message' => 'Successfully Booked',
                            ],200);

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

    public function checkAvailability(Request $request){
        $bookingType = $request->input('bookingType');
        $selectedMonth = $request->input('selectedMonth');
        $availablePerson = 5;

        $current_day = date('d');
        for($i = $current_day; $i <=  date('t'); $i++)
        {
            $dates[] = date('Y') . "-" . date('m') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);
        }
      
        $isFullDayEvent = false;
        $timeSlots = array('09:00-10:00', '10:00-11:00', '11:00-12:00',
                           '12:00-13:00', '13:00-14:00', '14:00-15:00');
        
       
        foreach($dates as $key => $value){
            $result[$key]['date'] = $value;
            $result[$key]['available'] = true;
            $result[$key]['isFullDayEvent'] = false;
            $timeslots = [];

            $bookings = Booking::select('booking_date','start_time','end_time','total_guests')->where('booking_type','=',$bookingType)
            ->where('booking_date','=',$value)
            ->get();
                            
            if($bookings->isEmpty()){
                unset($timeslots);
                foreach($timeSlots as $timeKey => $time){
                    $time = explode('-',$time);
                    $timeslots[] = [
                                        'startTime' => $time[0],
                                        'endTime'=>$time[1],
                                        'available'=> true,
                                        'maxPersonsAllowed'=> $availablePerson,
                                        'currentPersonsBooked'=> 0
                    ];
                }
            }else{
            
                foreach($bookings as $booking){
                    if($value == $booking->booking_date){
                        unset($timeslots);
                        foreach($timeSlots as $timeKey => $time){
                            $time = explode('-',$time);
                            $start_time = substr($booking->start_time, 0, 5);
                            $end_time = substr($booking->end_time, 0, 5);
                            //echo $start_time.'----'.$time[0].'<br>';
                            if($start_time != $time[0] && $end_time != $time[1]){
                                $available = true;
                            }else{
                                $available = false;
                            }
                           
                            $availPerson = $availablePerson - $booking->total_guests;
                            $timeslots[] = [
                                            'startTime' => $time[0],
                                            'endTime'=>$time[1],
                                            'available'=> $available,
                                            'maxPersonsAllowed'=> $availPerson,
                                            'currentPersonsBooked'=> 0
                            ];
                            
                        }
                    }
                }
                
            }
            $result[$key]['timeSlots'] = $timeslots;
        
        }
                             

        return response()->json( [
            
            'month' => $selectedMonth,
            'bookingType' => $bookingType,
            'availability' => $result
        ],200);
    }
}
