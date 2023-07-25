<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

trait Funciones
{
    public function permisos()
    {

        $admin = DB::table('model_has_roles')
                ->select('id')
                ->where('role_id', 1)  //Administrador general
                ->where('model_id', Auth::id())
                ->count();

        $docente = DB::table('model_has_roles')
                ->select('id')
                ->where('role_id', 2)  //Docente
                ->where('model_id', Auth::id())
                ->count();

        if ($docente >= 1) 
        {
            return 2;
        }



   }

/*
|--------------------------------------------------------------------------
| disponibilidad: Funci贸n que valida la disponibilidad de un horario
| @var sala: Id del recurso
| @var fecha: fecha
|--------------------------------------------------------------------------
*/

 public function verificar($fecha)         
  {
    $resultado = DB::select('SELECT * FROM actividades WHERE fecha_fin > "'.$fecha.'"');

    if (count($resultado) == 0) 
    {
        return 0; // No existe la fecha solicitada en los registros
    }else
    {
        return 1; // Existe en la bd un registro que coincide con la busqueda
    }        

  }


}
