<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complaint;
use App\User;
use App\Prescription;
use Auth;

class ComplaintController extends Controller
{
    //

    public function request(){

        return view('Complaint.request');
    }


    public function store(request $request){

       $validatedData = request()->validate([
            'symptoms' => 'required',
            'start_date'=> 'required',
            "self"   => 'sometimes'
        ]);

        $complaint = new Complaint;
        $complaint->symptoms        = $request['symptoms'];
        $complaint->self_medication = $request['self'];
        $complaint->start_date      = $request['start_date'];
        $complaint->user_id         = Auth::user()->id;
        $complaint->save();


        alert()->success('Complaints Sent Successfully', 'Success')->autoclose(5000);

        return redirect('/dashboard');

    }


    public function complaintHistory($comlaint){

        $findHistories = Complaint::where('user_id',Auth::user()->id)->orderBy('created_at','Desc')->get();


        return view('Complaint.complaint-request',compact('findHistories'));
    }

    public function allComplaints(){

        $complaints = Complaint::with('user')->orderBy('created_at','DESC')->get();


        return view('Complaint.all',compact('complaints'));
    }

    public function viewComplaints($patient){

        $findPatient        =      Complaint::where('id',$patient)->with('user')->firstOrfail();

                                    if($findPatient->status == 2){

                                        $docName = Prescription::where('complaint_id',$findPatient->id)->first();
                                      

                                    }
                                    if($findPatient->status == 0){

                                            Complaint::where('id',$patient)->update([
                                                'status' => 1,
                                            ]);


                                    }

        $complaintHistories  =     Complaint::where('user_id',$findPatient->user->id)->with('user')->get();




        return view('Complaint.show', compact(['findPatient','complaintHistories','docName']));


    }
}
