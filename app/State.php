<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class State extends Model
{
    //
    protected $fillable = ['name'];

    // use LogsActivity;

    // protected static $logAttributes = ['name', 'text'];
    
    public function cities(){
        
        return $this->hasMany(City::class);
    }
}
