<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;

class SubscriptionController extends Controller
{
    //
    public function allSubscriptions(){
         $subs = Subscription::all();
        return view('Subscription.all' ,compact('subs'));
    }


    public function create(){
        
        return view('Subscription.create');
    }

    public function store(Request $request){

            $validatedData = request()->validate([
                                'plan' => 'required|string',
                                'amount' => 'required|integer',
                            ]);

            Subscription::create($validatedData);
            alert()->success('Subscription Plan Created Successfully ', 'Success')->autoclose(5000);
            return redirect('/subscriptions/all');
            }


    public function edit($subscription){

            $findSub = Subscription::where('id',$subscription)->first();
            return view('Subscription.edit',compact('findSub'));
        }

    public function update(Request $request , $subscription){

                    request()->validate([
                        'plan' => 'required|string',
                        'amount' => 'required|integer',
                    ]);

                    Subscription::where('id',$subscription)->update([
                        'plan' => $request['plan'],
                        'amount' => $request['amount']
                    ]);

            alert()->success('Subscription Plan Updated Successfully ', 'Success')->autoclose(5000);
            return redirect('/subscriptions/all');

    }

    public function delete($subscription){

        Subscription::find($subscription)->delete();

        alert()->success('Subscription Plan Removed Successfully ', 'Success')->autoclose(5000);
        return redirect('/Subscription.all');
    }

}
