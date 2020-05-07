<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;
use App\Subscription;
use App\User;
use Auth;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }


    public function paymentplan($plan){

        $subs = Subscription::all();
        $userPlan  = User::where('id',$plan)->with('subscription')->firstorfail();

        return view('Paymentplan.plan', compact(['subs','userPlan']));
    }

    public function updatePlan(Request $request ,$plan){

           request()->validate([
                'payment_plan' => 'required',
                'payment_method'=> 'required'
            ]);

            User::where('id', $plan)->update([
                'subscription_id'=> $request['payment_plan'],
                'payment_method' => $request['payment_method'],
            ]);

      alert()->success('Payment PlanUpdated Successfully', 'Success')->autoclose(5000);
      return redirect('settings/'.Auth::user()->id.'/profile');

    }

    public function paymentForm(){
        /***
         * find the current login user info
         * plan and subscription
         */
       $user = User::where('id',Auth::user()->id)->with('subscription')->firstorfail();

        return view('Paymentplan.pay', compact('user'));

    }
}
