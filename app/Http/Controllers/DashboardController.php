<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Prescription;
use App\Complaint;
use App\Charts\PrescriptionChart;



class DashboardController extends Controller
{
    //

    public function dashboard(){

        $findPatient = User::where('id',Auth::user()->id)->firstOrfail();
        $patient = User::where('role_id',6)->count();
        $doctor  = User::where('role_id',2)->count();
        $prescription = Prescription::count();
        $complaint = Complaint::count();
        $patients = User::where('role_id',6)->orderBy('name')->paginate(10);

        $api = url('/chart-line-ajax');
   
        $chart = new PrescriptionChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($api);
       

        return view('Dashboard.dashboard' ,compact(['findPatient', 'patient','doctor','prescription','complaint','chart','patients']));
    }


    public function chartLineAjax(Request $request)
    {
        $year = $request->has('year') ? $request->year : date('Y');
        $users = Prescription::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', $year)
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
  
        $chart = new UserLineChart;
  
        $chart->dataset('New User Register Chart', 'line', $users)->options([
                    'fill' => 'true',
                    'borderColor' => '#51C1C0'
                ]);
  
        return $chart->api();
    }
}
