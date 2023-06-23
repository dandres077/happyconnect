<?php

namespace App\Http\Controllers;

use App\Paralelos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ParalelosController extends Controller
{
/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {
        $data = DB::table('paralelos')
            ->leftJoin('temporadas', 'paralelos.temporada_id', '=', 'temporadas.id')
            ->leftJoin('grados', 'paralelos.grado_id', '=', 'grados.id')
            ->leftJoin('users', 'paralelos.director_id', '=', 'users.id')
            ->select(
                'paralelos.*',
                'temporadas.nombre as nom_temporada',
                'grados.nombre as nom_grado',
                'users.name as nom_director',
                DB::raw('(CASE WHEN paralelos.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
            ->where('paralelos.status', '<>', 3 )
            ->orderByRaw('paralelos.id ASC')
            ->get();

        $titulo = 'Paralelos';

        return view('paralelos.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $temporadas = DB::table('temporadas')->where('empresa_id', Auth::user()->empresa_id )->where('status', 1 )->get();

        $grados = DB::table('grados')
                ->where('empresa_id', Auth::user()->empresa_id )
                ->where('status', 1 )
                ->get();

        $profesores = DB::select('SELECT id, CONCAT(name, " " , last) AS nombre
                                FROM users t1
                                WHERE empresa_id = ? 
                                AND NOT EXISTS (SELECT NULL
                                                    FROM profesionales t2
                                                    WHERE t2.usuario_id = t1.id 
                                                    AND t2.empresa_id = t1.empresa_id)', [Auth::user()->empresa_id]);

        $titulo = 'Paralelos';

        return view('paralelos.create', compact('titulo', 'temporadas', 'grados', 'profesores'));
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

        $data = Paralelos::create($request->all());

        return redirect ('admin/paralelos')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = Paralelos::find($id); 
        $temporadas = DB::table('temporadas')->where('empresa_id', Auth::user()->empresa_id )->where('status', 1 )->get();
        
        $grados = DB::table('grados')
                ->where('empresa_id', Auth::user()->empresa_id )
                ->where('status', 1 )
                ->get();

        $profesores = DB::select('SELECT id, CONCAT(name, " " , last) AS nombre
                                FROM users t1
                                WHERE empresa_id = ? 
                                AND NOT EXISTS (SELECT NULL
                                                    FROM profesionales t2
                                                    WHERE t2.usuario_id = t1.id 
                                                    AND t2.empresa_id = t1.empresa_id)', [Auth::user()->empresa_id]);

        $titulo = 'Paralelos';

        return view ('paralelos.edit')->with (compact('data', 'titulo', 'temporadas', 'grados', 'profesores'));
    }


/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {

        $data = Paralelos::find($id);
        $data->temporada_id = $request->input('temporada_id');
        $data->grado_id = $request->input('grado_id');
        $data->director_id = $request->input('director_id');
        $data->nombre = $request->input('nombre');
        $data->user_update = Auth::id();
        $data->save();
        
        return redirect ('admin/paralelos')->with('success', 'Registro actualizado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Paralelos::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/paralelos')->with('eliminar', 'ok');
    }


/*
|--------------------------------------------------------------------------
| Activar publicación
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {
        $data = Paralelos::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/paralelos');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicación
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Paralelos::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/paralelos');
    }

/*
|--------------------------------------------------------------------------
| Paralelos
|--------------------------------------------------------------------------
|
*/

    public function paralelos($empresa_id, $temporada_id, $grado_id)
    {
        $data = DB::table('paralelos')
            ->select(
                'id','nombre')
            ->where('empresa_id', $empresa_id )
            ->where('temporada_id', $temporada_id )
            ->where('grado_id', $grado_id )
            ->where('status', 1 )
            ->orderByRaw('paralelos.id ASC')
            ->get();


        return $data;
    }
}