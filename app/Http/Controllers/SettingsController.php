<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SettingsController extends Controller
{
    //

    public function profile($settings){

        $findPatient = User::where('id',$settings)->with('subscription')->firstorfail();
        return view('Settings.setting', compact('findPatient'));
    }
}
