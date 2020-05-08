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



            Route::get('/payment/{plan}/plan','PaymentController@paymentplan');
            Route::put('/payment/{plan}/update','PaymentController@updatePlan');
            Route::get('/card/payment','PaymentController@paymentForm')->middleware('auth');

            Route::get('/dashboard','DashboardController@dashboard')->middleware('auth');

            // Route::get('chart-line', 'ChartController@chartLine');
            Route::get('chart-line-ajax', 'DashboardController@chartLineAjax');


            Route::get('/import/','StateController@importState')->middleware(['auth','admin']);
            Route::post('/import-data/','StateController@importStateData')->middleware(['auth','admin']);
            Route::get('/downloadExcel/{type}','StateController@exportStateData')->middleware(['auth','admin']);


            Route::group(['prefix'=> 'patients'] , function(){

                Route::get('dashboard','PatientController@dashboard')->middleware('auth');
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
                Route::get('/all','PatientController@allPatient')->middleware(['auth','admin']);
                Route::get('/{patient}/show','PatientController@show')->middleware(['auth']);

                //store patient complaints/request
                Route::get('/complaints' ,'ComplaintController@request')->middleware(['auth']);
                Route::post('/complaints/store','ComplaintController@store')->middleware(['auth']);
                Route::get('/{complaint}/complaints/history','ComplaintController@complaintHistory')->middleware(['auth']);

                //feedback need to implement new feature before final push
                //create a new controller feed back 
                //fetch prescription id and useri id 
                //create a tabel that relates to feed back 
                
                Route::post('/{prescription}/feedback' ,'FeedbackController@feedback');

            });


            Route::get('myform/ajax/{id}',array('as'=>'myform.ajax','uses'=>'PatientController@myformAjax'));

            Route::group(['prefix'=> 'complaints'] , function(){

                Route::get('/all/complaints','ComplaintController@allComplaints')->middleware(['auth','admin']);
                Route::get('/{complaint}/show/','ComplaintController@viewComplaints')->middleware(['auth']);
                Route::get('/{complaint}/prescription','ComplaintController@findPrescriptionForComplaint')->middleware(['auth']);

            });

            Route::group(['prefix'=> 'prescriptions'] , function(){

                Route::get('/{prescription}/add','PrescriptionController@prescribe')->middleware('admin');
                Route::Post('/store', 'PrescriptionController@store')->middleware('admin');
                Route::get('/{prescription}/view','PrescriptionController@viewPrescription');

                //all prescription
                Route::get('/all','PrescriptionController@allPrescription')->middleware(['auth','admin']);

                //user prescriptions
                Route::get('/{prescription}/user','PrescriptionController@userPrescriptions')->middleware('auth');

            });

        Route::group(['prefix'=> 'subscriptions'] , function(){

                Route::get('all','SubscriptionController@allSubscriptions')->middleware('auth');
                Route::get('add','SubscriptionController@create')->middleware(['auth','admin']);
                Route::post('store','SubscriptionController@store')->middleware(['auth','admin']);
                Route::get('/{subscription}/edit','SubscriptionController@edit')->middleware(['auth','admin']);
                Route::post('/{subscription}/update','SubscriptionController@update')->middleware(['auth','admin']);
                Route::delete('/{subscription}/delete','SubscriptionController@delete')->middleware(['auth','admin']);
                Route::get('/plan','SubscriptionController@selectPlan')->name('subscriptions')->middleware(['auth']);
                Route::post('/{plan}/subscribed','SubscriptionController@subscribed')->middleware(['auth']);

            });

          Route::middleware(['auth'])->group(function () {

                Route::group(['prefix'=> 'doctors'] , function(){

                    Route::get('all','DoctorController@allDoctors')->middleware(['auth','admin']);
                    Route::get('add','DoctorController@addDoctors')->middleware(['auth','admin']);
                    Route::post('store','DoctorController@store')->middleware(['auth','admin']);
                    Route::get('/{doctor}/edit','DoctorController@edit')->middleware(['auth','admin']);
                    Route::post('/{doctor}/update','DoctorController@update')->middleware(['auth','admin']);
                    // Route::delete('/{subscription}/delete','SubscriptionController@delete');

                });
           });
 
            Route::group(['prefix'=> 'settings'] , function(){
                Route::get('/{setting}/profile','SettingsController@profile')->middleware(['auth']);
            });
            //view logs 
            Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware(['auth','admin']);
 



