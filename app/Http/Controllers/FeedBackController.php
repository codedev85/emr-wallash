<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prescription;
use App\Feed;
use Auth;

class FeedBackController extends Controller
{
    //

    public function feedback(Request $request ,$prescription){
  
        request()->validate([
            'feedback' => 'required',
        ]);

        $findPrescription = Prescription::where('id',$prescription)->where('user_id',Auth::user()->id)->firstorfail();
     
        $feedback = new Feed();
        $feedback->prescription_id = $findPrescription->id;
        $feedback->user_id         = Auth::user()->id;
        $feedback->name            = $request->input('feedback');
        $feedback->save();

        alert()->success('Feedback sent Successfully', 'Success')->autoclose(5000);
        return redirect('/dashboard');

    }

    public function allUserFeeds($prescription){

        $getFeeds = Feed::where('prescription_id',$prescription)->where('user_id',Auth::user()->id)->with(['prescription'])->paginate(10);
        return view('Feedback.feedback',compact('getFeeds'));
    }
}
