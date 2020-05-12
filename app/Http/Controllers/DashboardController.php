<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Prescription;
use App\Complaint;
use App\Charts\PrescriptionChart;
use DB;





class DashboardController extends Controller
{
    //

    public function dashboard(){

        $findPatient = User::where('id',Auth::user()->id)->firstOrfail();
        $patient = User::where('role_id',6)->count();
        $doctor  = User::where('role_id',2)->count();
        $allUsers  = User::all()->count();
        // $admin  = User::where('role_id',2)->count();
        // $admin  = User::where('role_id',4)->count();
        $prescription = Prescription::count();
        $complaint = Complaint::count();
        $patients = User::where('role_id',6)->orderBy('name')->paginate(10);

        $api = url('/chart-line-ajax');
        // activity()->log('logging something');
     
        // dd($latestActivities);
        $chart = new PrescriptionChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($api);
       

        return view('Dashboard.dashboard' ,compact(['findPatient', 'patient','doctor','prescription','complaint','chart','patients','allUsers']));
    }


    // public function chartLineAjax(Request $request)
    // {
    //     $year = $request->has('year') ? $request->year : date('Y');
    //     $users = Prescription::select(\DB::raw("COUNT(*) as count"))
    //                 ->whereYear('created_at', $year)
    //                 ->groupBy(\DB::raw("Month(created_at)"))
    //                 ->pluck('count');
  
    //     $chart = new UserLineChart;
  
    //     $chart->dataset('New User Register Chart', 'line', $users)->options([
    //                 'fill' => 'true',
    //                 'borderColor' => '#51C1C0'
    //             ]);
  
    //     return $chart->api();


    // } 
    
    
    // public function autocomplete(Request $request)

    // {

    // //    $search = $request->get('search');

    //     $data =  User::select(DB::raw("concat(name , ' - ( ' , (unique_id) , ' )') as name"))->where("name","LIKE","%{$request->input('query')}%")->get();
        
     
    //     return response()->json($data);
    // }

    public function fetch(Request $request)
    {
     if($request->get('query'))
     {

      $query = $request->get('query');
    
    //   $data = User::where('name', 'LIKE', "%{$query}%")
    //     ->get();
      $data =  User::select(DB::raw("concat(name ,' ',  last_name ,' - ( ' , (unique_id) , ' )') as name"))->where("name","LIKE","%{$request->input('query')}%")
                                                                                            ->orwhere("unique_id","LIKE","%{$request->input('query')}%")
                                                                                            ->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li><a class="form-control" href="#">'.$row->name.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }



    public function search(Request $request){
 
       $search = $request->input('search');
      
        $arrayStr = explode(" " , $search);
    //   dd($arrayStr);
        $str1 = $arrayStr[0];
        $str2 = $arrayStr[1];
        // $concatStr = $str1 ." ". $str2;
        // ?dd($concatStr);
        // $data =  User::select(DB::raw("concat(name , ' - ( ' , (unique_id) , ' )') as name"))->where("name","LIKE","%{$concatStr}%")
        // // ->orwhere("unique_id","LIKE","%{$request->input('query')}%")
        // ->get();
        $data =  User::where("name","LIKE","%{$str1}%")
                       ->where("last_name","LIKE","%{$str2}%")
                       ->where("unique_id","LIKE","%{$arrayStr[4]}%")
                       ->get();
                    //    dd($data);
       
        return view('Search.search',compact('data'));
    }

    // public function fetchPatientQuery(Request $request)
    // {
    //  if($request->get('query'))
    //  {

    //   $query = $request->get('query');
    
    //   $data = Prescription::where('prescription', 'LIKE', "%{$query}%")->where('user_id',Auth::user()->id)
    //     ->get();
    // //   $data =  User::select(DB::raw("concat(name , ' - ( ' , (unique_id) , ' )') as name"))->where("name","LIKE","%{$request->input('query')}%")
    // //                                                                                         ->orwhere("unique_id","LIKE","%{$request->input('query')}%")
    // //                                                                                         ->get();
    //   $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
    //   foreach($data as $row)
    //   {
    //    $output .= '
    //    <li><a class="form-control" href="#">'.$row->prescription.'</a></li>
    //    ';
    //   }
    //   $output .= '</ul>';
    //   echo $output;
    //  }
    // }
    
    // public function searchPatientQuery(Request $request){
 
    //     $search = $request->input('search');
       
    //      $arrayStr = explode(" " , $search);
       
    //      $str1 = $arrayStr[0];
    //      $str2 = $arrayStr[1];
    //      $concatStr = $str1 ." ". $str2;
    //      // ?dd($concatStr);
    //      // $data =  User::select(DB::raw("concat(name , ' - ( ' , (unique_id) , ' )') as name"))->where("name","LIKE","%{$concatStr}%")
    //      // // ->orwhere("unique_id","LIKE","%{$request->input('query')}%")
    //      // ->get();
    //      $data =  User::where("name","LIKE","%{$concatStr}%")
    //                     ->where("unique_id","LIKE","%{$arrayStr[4]}%")
    //                     ->get();
        
    //      return view('Search.search',compact('data'));
    //  }



}
