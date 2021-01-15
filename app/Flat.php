<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Block;

class Flat extends Model
{
    //use SoftDeletes;
    //
    protected $fillable = [
        'block_id','flat_number'
    ];

    public function block()
    {
        //return "jani";
         return $this->hasOne(Block::class,'id','block_id');
    }
}
