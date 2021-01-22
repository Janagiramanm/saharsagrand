<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;

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

        $current_date = date('Y-m-d');
        $tomorrow = date("Y-m-d", time() + 86400);
        $isFullDayEvent = false;

        $availability = [$current_date,$tomorrow];
        $timeSlots = array('09:00-10:00', '10:00-11:00', '11:00-12:00',
                           '12:00-13:00', '13:00-14:00', '14:00-15:00');

        $bookings = Booking::select('booking_date','start_time','end_time')->where('booking_type','=',$bookingType)
                    ->whereIn('booking_date',[$current_date,$tomorrow])
                    ->get();
  
        foreach($availability as $key => $value){
            $result[$key]['date'] = $value;
            $result[$key]['available'] = true;
            $result[$key]['isFullDayEvent'] = false;
            $timeslots = [];
              if($bookings){
                   
                    foreach($bookings as $book => $booking){
                        if($value == $booking->booking_date){
                            unset($timeslots);
                            foreach($timeSlots as $timeKey => $time){
                                $time = explode('-',$time);
                                $start_time = substr($booking->start_time, 0, 5);
                                $end_time = substr($booking->end_time, 0, 5);
                                if($start_time != $time[0] && $end_time != $time[1]){
                                    $timeslots[] = [
                                                     'startTime' => $time[0],
                                                     'endTime'=>$time[1],
                                                     'available'=> true,
                                                     'maxPersonsAllowed'=> 5,
                                                     'currentPersonsBooked'=> 0
                                                    ];
                                }
                            }
                        }else{
                            unset($timeslots);
                            foreach($timeSlots as $timeKey => $time){
                                $time = explode('-',$time);
                                $timeslots[] = [
                                                 'startTime' => $time[0],
                                                 'endTime'=>$time[1],
                                                 'available'=> true,
                                                 'maxPersonsAllowed'=> 5,
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
