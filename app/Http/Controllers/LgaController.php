<?php

namespace App\Http\Controllers;

use App\Imports\LgaImport;
use App\Exports\LgaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LgaController extends Controller
{

    public function importLga(){

        return view('Dashboard.lga');
    }
    public function importLgaData(Request $request)
    {

        if ($request->hasFile('lga')) {

            Excel::import(new LgaImport, request()->file('lga'));

            alert()->success('You have scuucessfully imported the data into the database','Successful' )->autoclose(3000);
        }


        return redirect('/dashboard');
    }

    public function exportLgaData($type){


        return Excel::download(new LgaExport, 'Lga.xlsx');



   }
}




