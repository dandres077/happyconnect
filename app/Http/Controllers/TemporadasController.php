<?php

namespace App\Http\Controllers;

use App\Temporadas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class TemporadasController extends Controller
{
/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {
        $data = DB::table('temporadas')
                    ->select('temporadas.*', 
                              DB::raw('(CASE WHEN status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
                    ->where('empresa_id', Auth::id())
                    ->where('status', '<>', 3 )
                    ->orderByRaw('id ASC')
                    ->get();

        $titulo = 'Temporadas';

        return view('temporadas.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $titulo = 'Temporadas';

        return view('temporadas.create', compact('titulo'));
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
        $request['empresa_id'] = Auth::user()->empresa_id;

        $data = Temporadas::create($request->all());

        return redirect ('admin/temporadas')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = Temporadas::find($id); 

        $titulo = 'Temporadas';

        return view ('temporadas.edit')->with (compact('data', 'titulo'));
    }



/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {
        $data = Temporadas::find($id);
        $data->fecha_inicio = $request->input('fecha_inicio');
        $data->fecha_fin = $request->input('fecha_fin');
        $data->nombre = $request->input('nombre');
        $data->user_update = Auth::id();
        $data->save();
        
        return redirect ('admin/temporadas')->with('success', 'Registro actualizado exitosamente');
    }



/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Temporadas::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/temporadas');
    }


/*
|--------------------------------------------------------------------------
| Activar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Temporadas::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/temporadas');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Temporadas::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/temporadas');
    }
}


