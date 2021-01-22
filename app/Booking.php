<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = [
        'bookingType','booking_date','start_time','end_time','user_id','status'
    ];
}
