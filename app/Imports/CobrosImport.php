<?php

namespace App\Imports;

use App\Cobros;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use DB;

class CobrosImport implements ToModel
{

    // public function model(array $row)
    // {
    //     return new Cobros([
    //         //
    //     ]);
    // }

    /*
|--------------------------------------------------------------------------
| model: Funci贸n que registra los datos en la tabla users
| @var row: Arreglo con los datos a cargar
|--------------------------------------------------------------------------
*/
    public function model(array $row)
    {
  
        $cargar = DB::insert('insert into cobros (
                                                    empresa_id,  
                                                    temporada_id, 
                                                    mes_id,
                                                    concepto_id,
                                                    alumno_id,
                                                    grado_id, 
                                                    paralelo_id,
                                                    valor, 
                                                    status) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', 
                                                    [
                                                    Auth::user()->empresa_id,
                                                    $row[0], 
                                                    $row[1],
                                                    $row[2], 
                                                    $row[3], 
                                                    $row[4],
                                                    $row[5],
                                                    $row[6],
                                                    '2']);
           
    }
}
