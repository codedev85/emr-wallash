<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Complaint;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\State;
use Carbon\Carbon;

class PatientController extends Controller
{
    //
    public function dashboard(Request $request){

        $request->session()->forget('register');


        return view('Patient.dashboard');
    }

    public function create(Request $request){

        $register = $request->session()->get('register');


        return view('Patient.register', compact('register'));

    }

    public function store(Request $request){

      $validatedData =  request()->validate([
            'name'     => 'required',
            'lastname' => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $password = $request->input('password');
        $cpassword = $request->input('confirm_password');
   
    if($password === $cpassword){

            if(empty($request->session()->get('register'))){

                $register = new User();
                $register->fill($validatedData);
                $request->session()->put('register', $register);

            }else{

                $register = $request->session()->get('register');
                $register->fill($validatedData);
                $request->session()->put('register', $register);
            
            }
            
            return redirect('/patients/store/step-two');

    }else{

        alert()->error('The password does not match', 'Oops!!!')->autoclose(5000);
        return back()->withInput();

    }
      

    //   $patient = new Patient();
    //   $patient->name     = $request['name'];
    //   $patient->email    = $request['email'];
    //   $patient->password =  Hash::make($request['password']);
    //   $patient->save();


    }

    public function stepTwo(Request $request)
    {


        if ($request->session()->has('register')) {
            $register = $request->session()->all();
            $states = DB::table("states")->pluck("name","id");
            // $register = $request->session()->get('register');
            
        }

        return view('Patient.register-step2',compact(['register','states']));
    }

    public function myformAjax($id)
    {
        $cities = DB::table("lgas")
                    ->where("state_id",$id)
                    ->pluck("name","id");
        return json_encode($cities);
    }

    public function PostcreateStepTwo(Request $request)
    {
        $validatedData = $request->validate([
            'occupation'     =>  'required',
            'address'        =>  'sometimes',
            'gender'         =>  'required',
            // 'state'          =>  'required',
            // 'lga'            =>  'required',
            'marital_status' => 'required',
            'phone_number'   => 'sometimes',
            'dob'            => 'required'
        ]);



        if(empty($request->session()->get('register'))){

            $register = new User();

            $register->fill($validatedData);

            $request->session()->put('register', $register);

        }else{
            $register = $request->session()->get('register');
            $register->fill($validatedData);
            $request->session()->get('register', $register);
        }
        return redirect('/patients/store/step-three');
    }

    public function stepThree(Request $request)
    {
        $register = $request->session()->get('register');
        //  dd($register);
        return view('Patient.register-step3',compact('register'));
    }


    public function PostcreateStep3(Request $request)
    {
        $register = $request->session()->get('register');

        $validatedData = $request->validate([
            'genotype'         =>  'required',
            'bloodgroup'       =>  'required',
            'health_summary'    => 'sometimes',
        ]);

        if(empty($request->session()->get('register'))){

            $register = new User();
            $register->fill($validatedData);
            $request->session()->put('register', $register);
        }else{
            $register = $request->session()->get('register');
            $register->fill($validatedData);
            $request->session()->get('register', $register);

            // $register = $request->session()->get('register');
            // $data = $register->fill($validatedData);
            // $patient = new User();
            // $patient->name = $data['name'];
            // $patient->email = $data['email'];
            // $patient->password = $data['password'];
            // $patient->occupation= $data['occupation'];
            // $patient->address = $data['address'];
            // $patient->gender = $data['gender'];
            // $patient->state = $data['state'];
            // $patient->lga = $data['lga'];
            // $patient->marital_status = $data['marital_status'];
            // $patient->phone_number = $data['phone_number'];
            // $patient->genotype = $data['genotype'];
            // $patient->bloodgroup = $data['bloodgroup'];
            // $patient->health_summary = $data['health_summary'];
            // dd($patient);
            // $patient->save();


        }
        return redirect('/patients/subscription');
        // return view('Patient.plan',compact('register'));
        // return redirect('/admin/dashboard');
    }

    public function plan(Request $request)
    {
        $register = $request->session()->get('register');

        return view('Patient.plan',compact('register'));
    }
    public function subscriptionPlan(Request $request)
    {
        $register = $request->session()->get('register');
        $str1 = 'LA';
        $strUser = ucfirst($str1);
        $mtRand  = mt_rand(10000, 99999);
        $getId   = $strUser .(- $mtRand);

        $validatedData = $request->validate([
            'subscription_id'         =>  'required',
        ]);

        if(empty($request->session()->get('register'))){

            $register = new User();
            $register->fill($validatedData);
            $request->session()->put('register', $register);

        }else{

      // dd($validatedData);
            $register = $request->session()->get('register');
            $data = $register->fill($validatedData);
        //  dd($data);
            $patient = new User();
            $patient->name = $data['name'];
            $patient->last_name = $data['lastname'];
            $patient->email = $data['email'];
            $patient->password = Hash::make($data['password']);
            $patient->occupation= $data['occupation'];
            $patient->address = $data['address'];
            $patient->gender = $data['gender'];
            $patient->state_id = $data['state'];
            $patient->dob = $data['dob'];
            $patient->lga_id = $data['lga'];
            $patient->marital_status = $data['marital_status'];
            $patient->phone_number = $data['phone_number'];
            $patient->genotype = $data['genotype'];
            $patient->bloodgroup = $data['bloodgroup'];
            $patient->allergies = $data['health_summary'];
            $patient->subscription_id = 0;
            //  $data['subcription_id'];
            $patient->unique_id = $getId;
            // dd($patient);
            $patient->save();

            if(Auth::check() && Auth::user()->role_id < 3){
                alert()->success('Created Successfully, proceed to login', 'Success')->autoclose(5000);
                return redirect('/dashboard');
            }
            alert()->success('Created Successfully, proceed to login', 'Success')->autoclose(5000);
            return redirect('/login');

        }
        alert()->error('Unable to create your Account ', 'Error')->autoclose(5000);
        return redirect('/patients/register');

    }


    public function allPatient(){

        $patients = User::where('role_id',6)->with('subscription')->orderBy('name','desc')->paginate(10);

        return view('Patient.all', compact('patients'));

    }


    public function show($patient){

        $findPatient = User::where('id',$patient)->with(['state','lga'])->firstOrfail();
    //  dd($findPatient);
        $age = Carbon::parse($findPatient->dob)->age;

    //    dd($age);
        $complaints  = Complaint::where('user_id',$patient)->orderBy('created_at','DESC')->get();
// dd($complaints);
        return view('Patient.show',compact(['findPatient','complaints','age']));


    }


    // public function preview(Request $request){

    //     $register = $request->session()->get('register');

    //     return view('Patient.preview',compact('register'));
    // }




    // public function __destruct(){

    //     $this->request->session()->flush();
    // }
}
