<?php

namespace App\Http\Controllers;

use App\Generalidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class GeneralidadesController extends Controller
{
/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {
        $data = DB::table('generalidades')
                    ->select('generalidades.*', 
                              DB::raw('(CASE WHEN status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
                    ->where('empresa_id', Auth::id())
                    ->where('status', '<>', 3 )
                    ->orderByRaw('id ASC')
                    ->get();

        $titulo = 'Generalidades';
        

        return view('generalidades.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $titulo = 'Generalidades';

        return view('generalidades.create', compact('titulo'));
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
        $data = Generalidades::create($request->all());

        return redirect ('admin/generalidades')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = Generalidades::find($id); 
        $titulo = 'Generalidades';

        return view ('generalidades.edit')->with (compact('data', 'titulo'));
    }



/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {

        $data = Generalidades::find($id);
        $data->nombre = $request->input('nombre');
        $data->user_update = Auth::id();
        $data->save();

        
        return redirect ('admin/generalidades')->with('success', 'Registro actualizado exitosamente');
    }



/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Generalidades::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/generalidades')->with('eliminar', 'ok');;
    }


/*
|--------------------------------------------------------------------------
| Activar publicación
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Generalidades::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/generalidades');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicación
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Generalidades::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/generalidades');
    }
}


