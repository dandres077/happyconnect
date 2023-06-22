<?php

namespace App\Http\Controllers;

use App\Periodos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PeriodosController extends Controller
{
    /*
}
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {
        $data = DB::table('periodos')
            ->leftJoin('temporadas', 'periodos.temporada_id', '=', 'temporadas.id')
            ->select(
                'periodos.*',
                'temporadas.nombre as nom_temporada',
                DB::raw('(CASE WHEN periodos.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
            ->where('periodos.status', '<>', 3 )
            ->orderByRaw('periodos.id ASC')
            ->get();

        $titulo = 'Periodos';

        return view('periodos.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $titulo = 'Periodos';

        $temporadas = DB::table('temporadas')->where('empresa_id', Auth::user()->empresa_id )->where('status', 1 )->get();

        return view('periodos.create', compact('titulo', 'temporadas'));
    }


/*
|--------------------------------------------------------------------------
| store
|--------------------------------------------------------------------------
|
*/
    public function store(Request $request)
    {

        $request['user_create'] = Auth::id();
        $request['colegio_id'] = Auth::user()->colegio_id;
        $data = Periodos::create($request->all());

        return redirect ('admin/periodos')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = Periodos::find($id); 
        
        $temporadas = DB::table('temporadas')->where('empresa_id', Auth::user()->empresa_id )->where('status', 1 )->get();

        $titulo = 'Periodos';

        return view ('periodos.edit')->with (compact('data', 'titulo', 'temporadas'));
    }



/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {
        $data = Periodos::find($id);
        $data->temporada_id = $request->input('temporada_id');
        $data->nombre = $request->input('nombre');
        $data->fecha_inicio = $request->input('fecha_inicio');
        $data->fecha_fin = $request->input('fecha_fin');
        $data->final = $request->input('final');
        $data->nombre = $request->input('nombre');
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/periodos')->with('success', 'Registro actualizado exitosamente');
    }



/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Periodos::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/periodos')->with('eliminar', 'ok');;;
    }


/*
|--------------------------------------------------------------------------
| Activar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Periodos::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/periodos');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Periodos::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/periodos');
    }
}


    