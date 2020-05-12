<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountInfo;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Complaint;
use Carbon\Carbon;



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
            'first_name'  => 'required',
            'last_name'   =>'required',
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
        $newDoctor->last_name    = $data['last_name'];
        $newDoctor->email        = $data['email'];
        $newDoctor->address      = $data['address'];
        $newDoctor->phone_number = $data['phone_number'];
        $newDoctor->password     = Hash::make($data[0]);
        $newDoctor->role_id      = 2; //role doctor
        $newDoctor->unique_id    = $getId;
        // $latestActivities = Activity::latest()->limit(100)->get();
        // $activity->description; //returns 'created'
        // $activity->subject; //returns the instance of NewsItem that was created
        // $activity->changes;
        $newDoctor->save();

        Mail::to($data['email'])->send(new AccountInfo($data));
        alert()->success('Check Email For Login Credentials', 'Success')->autoclose(5000);
        return redirect('dashboard');



    }

    public function allDoctors(){

        $doctors = User::where('role_id',2)->orderby('name')->paginate(10);

        return view('Doctor.all',compact('doctors'));
    }

    public function show($patient){

        $findPatient = User::where('id',$patient)->with(['state','lga'])->firstOrfail();

        $age = Carbon::parse($findPatient->dob)->age;


        $complaints  = Complaint::where('user_id',$patient)->orderBy('created_at','DESC')->paginate(1);
    // dd(!$complaints->isEmpty());


        return view('Doctor.show',compact(['findPatient','complaints','age']));


    }


}
