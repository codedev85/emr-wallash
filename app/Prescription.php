<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    //



    public function complaint(){

        return $this->belongsTo(Complaint::class);
    }
    public function user(){

        return $this->belongsTo(User::class);
    }


}
