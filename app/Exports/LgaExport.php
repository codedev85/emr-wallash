<?php

namespace App\Exports;

use App\Lga;
use Maatwebsite\Excel\Concerns\FromCollection;

class LgaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Lga::all();
    // }
    public function collection()
    {
        return  Lga::select(['state_id','name'])->get();
    }

    public function headings(): array{
        return [
            'state_id',
            'name'
        ];
    }
}
