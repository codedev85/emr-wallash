<?php

namespace App\Imports;

use App\Lga;
use Maatwebsite\Excel\Concerns\ToModel;

class LgaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Lga([
            //
            'state_id' => $row[0],
            'name'    => $row[1],
        ]);
    }
}
