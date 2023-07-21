<?php

namespace App\Exports;

use App\Cobros;
use Maatwebsite\Excel\Concerns\FromCollection;

class CobrosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cobros::all();
    }
}
