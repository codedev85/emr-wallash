<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountInfo;
use App\User;
use Illuminate\Support\Facades\Hash;


class DoctorController extends Controller
{
    //

    public function addDoctors(){

        return view('Doctor.add');
    }



    public function store(Request $request){
// dd($request);
        // $this->email = $request['email'];
        $data = $request->validate([
            'name'        => 'required',
            'email'       => 'required',
            'address'     =>'required',
            'phone_number'=> 'required'
        ]);

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRST';
        $randStrPassword =  substr(str_shuffle($permitted_chars), 0, 7);
        $str1 = 'DR';
        $strUser = ucfirst($str1);
        $mtRand  = mt_rand(10000, 99999);
        $getId   = $strUser .(- $mtRand);

        array_push($data , $randStrPassword);
        $newDoctor = new User;
        $newDoctor->name         = $data['name'];
        $newDoctor->email        = $data['email'];
        $newDoctor->address      = $data['address'];
        $newDoctor->phone_number = $data['phone_number'];
        $newDoctor->password     = Hash::make($data[0]);
        $newDoctor->role_id      = 2; //role doctor
        $newDoctor->unique_id    = $getId;

        $newDoctor->save();

        Mail::to($data['email'])->send(new AccountInfo($data));
        alert()->success('Check Email For Login Credentials', 'Success')->autoclose(5000);
        return redirect('dashboard');



    }

    public function allDoctors(){

        $doctors = User::where('role_id',2)->get();

        return view('Doctor.all',compact('doctors'));
    }


}
