<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
{
    //
    // use LogsActivity;

   
    // protected static $logAttributes = ['name', 'text'];

    public function state(){

        return $this->belongsTo(State::class);
    }
}
