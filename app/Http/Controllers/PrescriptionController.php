<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complaint;
use App\Prescription;
use Auth ;

class PrescriptionController extends Controller
{
    //

    public function allPrescriptions(){


    }


    public function prescribe($patient){

       $userComplaint = Complaint::where('id',$patient)->with('user')->firstorfail();


      return view('Prescription.show',compact('userComplaint'));

    }

    public function store(Request $request){
// dd($request);
            request()->validate([

                'patient_id'    => 'required',
                'field_name'    => 'required',
                'ailment'       => 'required',
                'remarks'       => 'required',
                'complaint_id'  => 'required'
            ]);

         $patientId = $request['patient_id'];
         $formula  = $request['field_name'];
         $ailment  = $request['ailment'];
         $remarks  = $request['remarks'];
         $complaintId = $request['complaint_id'];

         $formatToJson = json_encode($formula);

         $prescription = new Prescription();
         $prescription->user_id = $patientId;
         $prescription->doc_name = Auth::user()->name;
         $prescription->ailment = $ailment;
         $prescription->prescription = $remarks;
         $prescription->complaint_id = $complaintId;
         $prescription->formula = $formatToJson;
         $prescription->save();
         $checkStatus = Complaint::where('id',$complaintId)->first();
        /***
         * If the status has not be updated to 2
         * the update
         * 1 is read
         * 2 is unread
         * 3 is prescribe
         */
        if($checkStatus->status !== 2){
            Complaint::where('id',$complaintId)->update([
                'status'=> 2,
            ]);

        }


         alert()->success('Prescription Created Successfully ', 'Success')->autoclose(5000);
         return redirect('/dashboard');

    }

    public function viewPrescription($prescription){


       $prescription = Prescription::where('complaint_id',$prescription)->with(['user','complaint'])->first();

        return view('Patient.view-prescription', compact('prescription'));
    }


   public function allPrescription(){

    $prescriptions = Prescription::orderBy('created_at','Desc')->with('user')->paginate(10);

    return view('Prescription.all',compact('prescriptions'));
   }

   public function userPrescriptions($prescription){


     $findPrescription = Prescription::where('user_id',$prescription)->with('complaint')->paginate(10);
    

     return view('Patient.my-prescription',compact('findPrescription'));
   }


}
