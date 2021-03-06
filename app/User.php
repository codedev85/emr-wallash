<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class User extends Authenticatable 
{
    use Notifiable;
    //  , LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','lastname', 'email', 'password',   'occupation','phone_number','address','gender',
        'state','lga','marital_status' ,'genotype','bloodgroup','health_summary'
        ,'subscription_id','dob'
    ];
   

   
    // protected static $logAttributes = ['name', 'text'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob'               => 'datetime'
    ];

    public function role(){

        return $this->belongsTo(Role::class);
    }

    public function histories(){

        return $this->hasMany(History::class);
    }


    public function prescriptions(){

        return $this->hasMany(Prescription::class);
    }


    public function complaints(){

        return $this->hasMany(Complaint::class);
    }

    public function subscription(){
        
        return $this->belongsTo(Subscription::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function lga(){
        return $this->belongsTo(Lga::class);
    }
      
    
}
