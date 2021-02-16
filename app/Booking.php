<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Amenity;

class Booking extends Model
{
    //
    protected $fillable = [
        'bookingType','booking_date','start_time','end_time','user_id','status','total_guests'
    ];

    public function user()
    {
         return $this->belongsTo(User::class);
      
    }
    public function amenity(){
        return $this->belongsTo(Amenity::class);
    }
}
