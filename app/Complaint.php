<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Complaint Extends Model 
//  implements LogsActivityInterface
{
    //
    // use LogsActivity;

   
    // protected static $logAttributes = ['name', 'text'];
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'datetime',
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }
    public function prescription(){

        return $this->belongsTo(Prescription::class);
    }

}
