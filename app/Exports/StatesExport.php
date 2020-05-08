<?php

namespace App\Exports;

use App\State;
use Maatwebsite\Excel\Concerns\FromCollection;

class StatesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  State::select(['id','name'])->get();
    }

 
    public function headings(): array{
        return [
            'id',
            'name'
        ];
    }
}
