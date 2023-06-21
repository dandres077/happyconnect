<?php

namespace App\Http\Controllers;

use App\Ciudades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class CiudadesController extends Controller
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
        $data = DB::table('ciudades')
            ->leftJoin('users', 'ciudades.user_create', '=', 'users.id')
            ->leftJoin('users AS users2', 'ciudades.user_update', '=', 'users2.id')
            ->leftJoin('departamentos', 'ciudades.departamento_id', '=', 'departamentos.id')
            ->select(
                'ciudades.*',
                'departamentos.nombre AS nomdepartamento',
                DB::raw('(CASE WHEN ciudades.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
            ->where('ciudades.status', '<>', 3 )
            ->orderByRaw('ciudades.id ASC')
            ->get();

        $titulo = 'Ciudades';

        return view('ciudades.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $departamentos = DB::table('departamentos')->select('departamentos.*')->where('departamentos.status', 1 )->get();
        $titulo = 'Ciudades';
        return view('ciudades.create', compact('titulo', 'departamentos'));
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
        $data = Ciudades::create($request->all());

        return redirect ('admin/ciudades')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = Ciudades::find($id); 
        $departamentos = DB::table('departamentos')->select('departamentos.*')->where('departamentos.status', 1 )->get();        
        $titulo = 'Ciudades';

        return view ('ciudades.edit')->with (compact('data', 'titulo', 'departamentos'));
    }



/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {

        $data = Ciudades::find($id);
        $data->departamento_id = $request->input('departamento_id');
        $data->nombre = $request->input('nombre');
        $data->user_update = Auth::id();
        $data->save();

        
        return redirect ('admin/ciudades')->with('success', 'Registro actualizado exitosamente');
    }



/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Ciudades::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/ciudades');
    }


/*
|--------------------------------------------------------------------------
| Activar publicación
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Ciudades::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/ciudades');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicación
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Ciudades::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/ciudades');
    }
}
