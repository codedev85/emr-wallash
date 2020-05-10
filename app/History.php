<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class History extends Model
{
    //
    // use LogsActivity;

   
    // protected static $logAttributes = ['name', 'text'];
    
    public function user(){

        return $this->belongsTo(User::class);
    }


    public function prescriptions(){
        
        return $this->hasMany(Prescription::class);
    }
}
