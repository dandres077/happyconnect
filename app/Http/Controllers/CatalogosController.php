<?php

namespace App\Http\Controllers;

use App\Catalogos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class CatalogosController extends Controller
{
/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {
        $data = DB::table('catalogos')
            ->leftJoin('generalidades', 'catalogos.generalidad_id', '=', 'generalidades.id')
            ->select(
                'catalogos.*',
                'generalidades.nombre as nom_generalidad',
                DB::raw('(CASE WHEN catalogos.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
            ->where('catalogos.status', '<>', 3 )
            ->orderByRaw('catalogos.id ASC')
            ->get();

        $titulo = 'Catálogos';

        return view('catalogos.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $generalidades = DB::table('generalidades')->where('empresa_id', Auth::user()->empresa_id )->where('status', 1 )->get();

        $titulo = 'Catálogos';

        return view('catalogos.create', compact('titulo', 'generalidades'));
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

        $data = Catalogos::create($request->all());

        return redirect ('admin/catalogos')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = Catalogos::find($id); 
        $generalidades = DB::table('generalidades')->where('empresa_id', Auth::user()->empresa_id )->where('status', 1 )->get();   
        $titulo = 'Catálogos';

        return view ('catalogos.edit')->with (compact('data', 'titulo', 'generalidades'));
    }



/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {

        $data = Catalogos::find($id);
        $data->generalidad_id = $request->input('generalidad_id');
        $data->nombre = $request->input('nombre');
        $data->user_update = Auth::id();
        $data->save();

        
        return redirect ('admin/catalogos')->with('success', 'Registro actualizado exitosamente');
    }



/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Catalogos::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/catalogos')->with('eliminar', 'ok');
    }


/*
|--------------------------------------------------------------------------
| Activar publicación
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Catalogos::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/catalogos');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicación
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Catalogos::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/catalogos');
    }
}