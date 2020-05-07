<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    //
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
