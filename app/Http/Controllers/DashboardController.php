<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class DashboardController extends Controller
{
    //

    public function dashboard(){

        $findPatient = User::where('id',Auth::user()->id)->firstOrfail();

        return view('Dashboard.dashboard' ,compact('findPatient'));
    }
}
