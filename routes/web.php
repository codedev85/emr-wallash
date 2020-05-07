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

// Route::get('/home', 'HomeController@index')->name('home');


   Route::get('/dashboard','DashboardController@dashboard');


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



    Route::group(['prefix'=> 'complaints'] , function(){

        Route::get('/all/complaints','ComplaintController@allComplaints');
        Route::get('/{complaint}/show/','ComplaintController@viewComplaints');

    });

    Route::group(['prefix'=> 'prescriptions'] , function(){

        Route::get('/{prescription}/add','PrescriptionController@prescribe');
        Route::Post('/store', 'PrescriptionController@store');
        Route::get('/{prescription}/view','PrescriptionController@viewPrescription');

        //all prescription
        Route::get('/all','PrescriptionController@allPrescription');

    });

    Route::group(['prefix'=> 'subscriptions'] , function(){

       Route::get('all','SubscriptionController@allSubscriptions');
       Route::get('add','SubscriptionController@create');
       Route::post('store','SubscriptionController@store');
       Route::get('/{subscription}/edit','SubscriptionController@edit');
       Route::post('/{subscription}/update','SubscriptionController@update');
       Route::delete('/{subscription}/delete','SubscriptionController@delete');

    });


    Route::group(['prefix'=> 'doctors'] , function(){

        Route::get('all','DoctorController@allDoctors');
        Route::get('add','DoctorController@addDoctors');
        Route::post('store','DoctorController@store');
        Route::get('/{doctor}/edit','DoctorController@edit');
        Route::post('/{doctor}/update','DoctorController@update');
        // Route::delete('/{subscription}/delete','SubscriptionController@delete');

     });
