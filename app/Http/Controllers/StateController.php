<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\State;

class StateController extends Controller
{
    //

    public function importState(){

        return view('Dashboard.state');
    }

    public function exportStateData($type){

        // return Excel::download(new Airport,'april-travels');

        $data = State::get()->toArray();

        return Excel::create('Nigerian_states', function($excel) use ($data) {
           $excel->sheet('Nigerian States', function($sheet) use ($data)
             {
              $sheet->fromArray($data);
             });
        })->download($type);

      }

      public function importStateData(Request $request){

        if($request->hasFile('state')){

           Excel::load($request->file('state')->getRealPath(), function ($reader) {
               foreach ($reader->toArray() as $key => $row) {
                   $data['name'] = $row['state'];
                   if(!empty($data)) {
                       DB::table('states')->insert($data);
                   }
               }
           });
       }

       // Session::put('success', 'Youe file successfully import in database!!!');

       return back();
     }

}
