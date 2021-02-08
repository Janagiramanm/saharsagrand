<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Amenity;

class AmenityTime extends Model
{
    //
    public function amenity()
    {
        return $this->belongsTo(Amenity::class, 'id');
    }
}
