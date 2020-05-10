<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Prescription extends Model
{
    //
    // use LogsActivity;

   
    // protected static $logAttributes = ['name', 'text'];


    public function complaint(){

        return $this->belongsTo(Complaint::class);
    }
    public function user(){

        return $this->belongsTo(User::class);
    }

  


}
