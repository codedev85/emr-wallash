<?php

namespace App\Imports;

use App\State;
use Maatwebsite\Excel\Concerns\ToModel;

class StatesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       
        return new State([
            //   'id'     => $row[0],
              'name'    => $row[1],
        ]);
    }
}
