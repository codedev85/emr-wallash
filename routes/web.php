<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

    Route::post('/pay', [
        'uses' => 'PaymentController@redirectToGateway',
        'as' => 'pay'
    ]);
    Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');

    Route::middleware(['auth'])->group(function () {

            Route::get('/payment/{plan}/plan','PaymentController@paymentplan');
            Route::put('/payment/{plan}/update','PaymentController@updatePlan');
            Route::get('/card/payment','PaymentController@paymentForm');
            Route::get('/dashboard','DashboardController@dashboard');

            // Route::get('chart-line', 'ChartController@chartLine');
            Route::get('chart-line-ajax', 'DashboardController@chartLineAjax');


            Route::get('/import/','StateController@importState');
            Route::post('/import-data/','StateController@importStateData');
            Route::get('/downloadExcel/{type}','StateController@exportStateData');


            Route::group(['prefix'=> 'patients'] , function(){

                Route::get('dashboard','PatientController@dashboard');
                Route::get('/register', 'PatientController@create');
                Route::Post('/store','PatientController@store');
                Route::get('/store/step-two','PatientController@stepTwo');
                Route::post('/post/step-two','PatientController@PostcreateStepTwo');
                Route::get('/store/step-three','PatientController@stepThree');
                Route::Post('/post/step-three','PatientController@PostcreateStep3');

                Route::get('/subscription','PatientController@plan');
                Route::Post('/subscription/plan','PatientController@subscriptionPlan');

                Route::get('/preview','PatientController@preview');
                Route::get('/store/data','PatientController@storeArrayData');
                Route::get('/all','PatientController@allPatient');
                Route::get('/{patient}/show','PatientController@show');

                //store patient complaints/request
                Route::get('/complaints' ,'ComplaintController@request');
                Route::post('/complaints/store','ComplaintController@store');
                Route::get('/{complaint}/complaints/history','ComplaintController@complaintHistory');

            });


            Route::get('myform/ajax/{id}',array('as'=>'myform.ajax','uses'=>'PatientController@myformAjax'));

            Route::group(['prefix'=> 'complaints'] , function(){

                Route::get('/all/complaints','ComplaintController@allComplaints');
                Route::get('/{complaint}/show/','ComplaintController@viewComplaints');

            });

            Route::group(['prefix'=> 'prescriptions'] , function(){

                Route::get('/{prescription}/add','PrescriptionController@prescribe')->middleware('admin');
                Route::Post('/store', 'PrescriptionController@store')->middleware('admin');
                Route::get('/{prescription}/view','PrescriptionController@viewPrescription');

                //all prescription
                Route::get('/all','PrescriptionController@allPrescription')->middleware('admin');

            });

        Route::group(['prefix'=> 'subscriptions'] , function(){

                Route::get('all','SubscriptionController@allSubscriptions')->middleware('admin');
                Route::get('add','SubscriptionController@create')->middleware('admin');
                Route::post('store','SubscriptionController@store')->middleware('admin');
                Route::get('/{subscription}/edit','SubscriptionController@edit')->middleware('admin');
                Route::post('/{subscription}/update','SubscriptionController@update')->middleware('admin');
                Route::delete('/{subscription}/delete','SubscriptionController@delete')->middleware('admin');
                Route::get('/plan','SubscriptionController@selectPlan')->name('subscriptions');
                Route::post('/{plan}/subscribed','SubscriptionController@subscribed');

            });

          Route::middleware(['auth'])->group(function () {

                Route::group(['prefix'=> 'doctors'] , function(){

                    Route::get('all','DoctorController@allDoctors');
                    Route::get('add','DoctorController@addDoctors')->middleware('admin');
                    Route::post('store','DoctorController@store')->middleware('admin');
                    Route::get('/{doctor}/edit','DoctorController@edit');
                    Route::post('/{doctor}/update','DoctorController@update');
                    // Route::delete('/{subscription}/delete','SubscriptionController@delete');

                });
           });
 
            Route::group(['prefix'=> 'settings'] , function(){
                Route::get('/{setting}/profile','SettingsController@profile');
            });
    });



