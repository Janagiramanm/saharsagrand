<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    //
    protected $fillable = [
        'name','advance_book','logo','amount','time_slots'
    ];
}
