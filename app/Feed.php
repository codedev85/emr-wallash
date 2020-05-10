<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    //
    public function prescription(){

        return $this->belongsTo(Prescription::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

}
