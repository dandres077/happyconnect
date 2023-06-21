<?php

namespace App\Http\Controllers;

use App\Asignaturas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AsignaturasController extends Controller
{
/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {
        $data = DB::table('asignaturas')
            ->leftJoin('areas', 'asignaturas.area_id', '=', 'areas.id')
            ->select(
                'asignaturas.*',
                'areas.nombre as nom_area',
                DB::raw('(CASE WHEN asignaturas.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
            ->where('asignaturas.status', '<>', 3 )
            ->orderByRaw('asignaturas.id ASC')
            ->get();

        $titulo = 'Asignaturas';

        return view('asignaturas.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $areas = DB::table('areas')->where('empresa_id', Auth::user()->empresa_id )->where('status', 1 )->get();

        $titulo = 'Asignaturas';

        return view('asignaturas.create', compact('titulo', 'areas'));
    }


/*
|--------------------------------------------------------------------------
| store
|--------------------------------------------------------------------------
|
*/
    public function store(Request $request)
    {

        $request['empresa_id'] = Auth::user()->empresa_id;
        $request['user_create'] = Auth::id();

        $data = Asignaturas::create($request->all());

        return redirect ('admin/asignaturas')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = Asignaturas::find($id); 
        $areas = DB::table('areas')->where('empresa_id', Auth::user()->empresa_id )->where('status', 1 )->get();   
        $titulo = 'Asignaturas';

        return view ('asignaturas.edit')->with (compact('data', 'titulo', 'areas'));
    }



/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {

        $data = Asignaturas::find($id);
        $data->area_id = $request->input('area_id');
        $data->nombre = $request->input('nombre');
        $data->user_update = Auth::id();
        $data->save();

        
        return redirect ('admin/asignaturas')->with('success', 'Registro actualizado exitosamente');
    }



/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Asignaturas::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/asignaturas')->with('eliminar', 'ok');
    }


/*
|--------------------------------------------------------------------------
| Activar publicación
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Asignaturas::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/asignaturas');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicación
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Asignaturas::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/asignaturas');
    }
}