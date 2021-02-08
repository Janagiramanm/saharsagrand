<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AamenityTime;

class Amenity extends Model
{
    //
    protected $fillable = [
        'name','advance_book','logo','amount','time_slots'
    ];

    public function amenitytimes()
    {
         return $this->hasMany(AmenityTime::class,'amenity_id','id');
    }
    // public function products(){
    //     return $this->hasMany('App\Product','shop_id','id');
    // }
}
