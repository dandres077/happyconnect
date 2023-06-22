<?php

namespace App\Http\Controllers;

use App\Grados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class GradosController extends Controller
{
/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {
        $data = DB::table('grados')
            ->leftJoin('niveles', 'grados.nivel_id', '=', 'niveles.id')
            ->select(
                'grados.*',
                'niveles.nombre as nom_nivel',
                DB::raw('(CASE WHEN grados.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
            ->where('grados.status', '<>', 3 )
            ->orderByRaw('grados.id ASC')
            ->get();

        $titulo = 'Grados';

        return view('grados.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $niveles = DB::table('niveles')->where('empresa_id', Auth::user()->empresa_id )->where('status', 1 )->get();

        $titulo = 'Grados';

        return view('grados.create', compact('titulo', 'niveles'));
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

        $data = Grados::create($request->all());

        return redirect ('admin/grados')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = Grados::find($id); 
        $niveles = DB::table('niveles')->where('empresa_id', Auth::user()->empresa_id )->where('status', 1 )->get();   
        $titulo = 'Grados';

        return view ('grados.edit')->with (compact('data', 'titulo', 'niveles'));
    }



/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {

        $data = Grados::find($id);
        $data->nivel_id = $request->input('nivel_id');
        $data->nombre = $request->input('nombre');
        $data->user_update = Auth::id();
        $data->save();

        
        return redirect ('admin/grados')->with('success', 'Registro actualizado exitosamente');
    }



/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Grados::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/grados')->with('eliminar', 'ok');
    }


/*
|--------------------------------------------------------------------------
| Activar publicación
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Grados::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/grados');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicación
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Grados::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/grados');
    }
}