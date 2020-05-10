<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    //

    protected $guarded = [];

    public function state(){

        return $this->belongsTo(State::class);
    }
}
