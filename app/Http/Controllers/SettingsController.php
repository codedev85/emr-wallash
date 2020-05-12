<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Subscription;
use Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    //

    public function profile($settings){

        $findPatient = User::where('id',$settings)->with(['subscription','state','lga'])->firstorfail();
        // dd($findPatient);
        return view('Settings.setting', compact('findPatient'));
    }

    public function fetchBasicInfo($info){

        $user = User::where('id',$info)->firstorfail();

        return view('Settings.update-basic-info' , compact('user'));
    }


    public function updateBasicInfo(Request $request , $info){

        request()->validate([
            'name'         => 'required',
            'last_name'    =>'required',
            'address'      => 'required',
            'phone_number' => 'required'
        ]);

        User::where('id',Auth::user()->id)->update([
            'name'         => $request->input('name'),
            'last_name'    => $request->input('last_name'),
            'phone_number' => $request->input('phone_number'),
            'address'      => $request->input('address'),
        ]);

        alert()->success('Information Updated Successfully', 'Success')->autoclose(5000);
        return redirect('/dashboard');



    }

    public function fetchJobInfo($info){

        $user = User::where('id',$info)->firstorfail();

        return view('Settings.update-job-status' , compact('user'));

    }


    public function updateJobInfo(Request $request,$info){

        request()->validate([
            'occupation'         => 'required',
        ]);

        User::where('id',Auth::user()->id)->update([
            'occupation'         => $request->input('occupation'),
        ]);

        alert()->success('Information Updated Successfully', 'Success')->autoclose(5000);
        return redirect('/dashboard');

    }

    public function fetchAllergyInfo($info){

        $user = User::where('id',$info)->firstorfail();

        return view('Settings.update-allergies' , compact('user'));

    }


    public function updateAllergyInfo(Request $request,$info){

        request()->validate([
            'allergies'         => 'required',
        ]);

        User::where('id',Auth::user()->id)->update([
            'allergies'         => $request->input('allergies'),
        ]);

        alert()->success('Information Updated Successfully', 'Success')->autoclose(5000);
        return redirect('/dashboard');

    }

    public function fetchHealthInfo($info){

        $user = User::where('id',$info)->firstorfail();

        return view('Settings.update-health-status' , compact('user'));

    }


    public function updateHealthInfo(Request $request,$info){
        request()->validate([
            'genotype'         => 'required',
            'blood_group'      => 'required'
        ]);

        User::where('id',Auth::user()->id)->update([
            'genotype'         => $request->input('genotype'),
            'bloodgroup'       => $request->input('blood_group')
        ]);

        alert()->success('Information Updated Successfully', 'Success')->autoclose(5000);
        return redirect('/dashboard');

    }

    public function fetchPlanInfo($info){

        $user = User::where('id',$info)->firstorfail();
        $plans = Subscription::all();

        return view('Settings.update-payment-plan' , compact(['user','plans']));

    }


    public function updatePlanInfo(Request $request,$info){

        request()->validate([
            'subscription_plan'         => 'required',
        ]);

        User::where('id',Auth::user()->id)->update([
            'subscription_id'         => $request->input('subscription_plan'),
        ]);

        alert()->success('Information Updated Successfully', 'Success')->autoclose(5000);
        return redirect('/dashboard');


    }

    public function fetchPasswordPage($info){
        
        $user = User::where('id',$info)->firstorfail();

        return view('Settings.password-update',compact('user'));


    }

    public function updatePasswordInfo(Request $request ,$info){

                request()->validate([
                    'password'         => 'required',
                    'confirm_password' => 'required'
                ]);


              $password = $request->input('password');
              $cpassword = $request->input('confirm_password');

              if($password === $cpassword){

                 User::where('id',Auth::user()->id)->update([
                     'password'=> Hash::make($password),
                 ]);

                alert()->success('Password Updated Successfully', 'Success')->autoclose(5000);
                return redirect('/dashboard');

              }

        alert()->error('Cant Process the data, try again', 'Oops!!!')->autoclose(5000);
        return redirect('/dashboard');

    }
}
