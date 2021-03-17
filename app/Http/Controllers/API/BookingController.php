<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\AppHelper;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Booking;
use App\User;
use App\Amenity;
use App\AmenityTime;
use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;

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
        $isBookingExist = Booking::where('amenity_id','=',$request->input('bookingType'))
                                  ->where('booking_date','=',$request->input('selectedDate'))
                                  ->where('user_id','=', $user->id)->first();
        if($isBookingExist){
            return response()->json( [
                'status' => 0,
                'message' => 'Already booked this amenity today.',
             ],409);
        }

       $timeSlots = $request->input('timeSlots');
       $booking_code =  mt_rand(100000,999999);

       $booking = new Booking();
       $booking->amenity_id = $request->input('bookingType');
       $booking->booking_date = $request->input('selectedDate');
       if($timeSlots != null){
            $booking->start_time = $timeSlots['startTime'];
            $booking->end_time = $timeSlots['endTime'];
       }
       $booking->user_id = $user->id;
       $booking->total_guests = $request->input('totalGuests');
       $booking->booking_code = $booking_code;
       $booking->status = 1;
       $booking->save();

       $userDetails = User::find($user->id);
       
       AppHelper::BookingConfirmation($userDetails->name, $request->input('mobile'), $booking_code, $booking->amenity->name);
       if($userDetails->email!=''){
            // Mail::to($userDetails->email)->send(new BookingConfirmation($user, $booking));
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

        $amenity = Amenity::where('id','=',$bookingType)->first();
        $isFullDayEvent = false;
        $advance_book = 0 ;
       
        if($amenity->time_slots == 0){
               $isFullDayEvent = true;
        }else{
            $amenityTimes = AmenityTime::where('amenity_id','=',$amenity->id)->get();
            foreach($amenityTimes as $amenityTime){
                 $times[$amenityTime->day] = [$amenityTime->start_time, $amenityTime->end_time];
            }
            $advance_book = $amenity->advance_book - 1;
        }

        
        $carbon = Carbon::now();
       
        $currentMonth = Carbon::now()->format('F Y');
        $start_date = \Carbon\Carbon::parse($selectedMonth)->startOfMonth();
        if($selectedMonth == $currentMonth){
            $start_date =  $carbon->format('Y-m-d');
        }
      
        $end_date =    \Carbon\Carbon::parse($start_date)->endOfMonth()->toDateString();
        if($advance_book > 0){
            $end_date = $carbon->addDays($advance_book)->format('Y-m-d');
        }
        $dates = $this->getDatesFromRange($start_date, $end_date);
        
        $result =[];
        foreach($dates as $key => $value){
            $result[$key]['date'] = $value;
            $result[$key]['available'] = true;
            $result[$key]['isFullDayEvent'] = $isFullDayEvent;
            $timeslots = [];
            $day = Carbon::parse($value)->format('l');
            if(!$isFullDayEvent){
                    $start_time = $value.' '.$times[$day][0];
                    $end_time = $value.' '.$times[$day][1];
                    $timeSlots =  $this->SplitTime($start_time, $end_time, "60");
            }
           
            $bookings = Booking::select('booking_date','start_time','end_time','total_guests')->where('amenity_id','=',$bookingType)
            ->where('booking_date','=',$value)
            ->get();


            if($bookings->isEmpty()){
               
                if(!$isFullDayEvent){
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
                }
            }else{
               
                if(!$isFullDayEvent){
                        foreach($bookings as $booking){
                            if($value == $booking->booking_date){
                                unset($timeslots);
                                foreach($timeSlots as $timeKey => $time){
                                    $time = explode('-',$time);
                                    $start_time = substr($booking->start_time, 0, 5);
                                    $end_time = substr($booking->end_time, 0, 5);
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
                if($isFullDayEvent){
                    $result[$key]['available'] = false;
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

    public function SplitTime($StartTime, $EndTime, $Duration="60"){
        $ReturnArray = array ();// Define output
        $StartTime    = strtotime ($StartTime); //Get Timestamp
        $EndTime      = strtotime ($EndTime); //Get Timestamp
    
        $AddMins  = $Duration * 60;
        while ($StartTime <= $EndTime) //Run loop
        {
            $ReturnArray[] = date ("h:i", $StartTime).'-'.date ("h:i",$StartTime += $AddMins);
        }
        return $ReturnArray;
    }

    public function getDatesFromRange($start, $end, $format = 'Y-m-d') {
        $array = array();
        $interval = new DateInterval('P1D');
    
        $realEnd = new DateTime($end);
        $realEnd->add($interval);
    
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
    
        foreach($period as $date) { 
            $array[] = $date->format($format); 
        }
    
        return $array;
    }
}
