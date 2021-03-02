<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Posting;

class Nominee extends Model
{
    //
    public function user()
    {
         return $this->belongsTo(User::class);
      
    }
    public function posting()
    {
         return $this->belongsTo(Posting::class);
      
    }

}
