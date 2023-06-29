<?php

namespace App\Http\Controllers;

use App\ParalelosHorarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;


class ParalelosHorariosController extends Controller
{
/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index($paralelo_id)
    {

        $data = DB::table('paralelos_horarios')
                ->leftJoin('paralelos', 'paralelos_horarios.paralelo_id', '=', 'paralelos.id')
                ->leftJoin('catalogos', 'paralelos_horarios.dia_id', '=', 'catalogos.id')
                ->leftJoin('catalogos AS c2', 'paralelos_horarios.bloque_id', '=', 'c2.id')
                ->leftJoin('asignaturas', 'paralelos_horarios.asignatura_id', '=', 'asignaturas.id')
                ->leftJoin('users', 'paralelos_horarios.docente_id', '=', 'users.id')
                ->leftJoin('grados', 'paralelos.grado_id', '=', 'grados.id')
                ->select(
                    'paralelos_horarios.id',
                    'paralelos_horarios.bloque_id',
                    'c2.nombre AS nom_bloque',
                    'paralelos_horarios.dia_id',
                    'asignaturas.nombre AS nom_asignatura', 
                    'grados.nombre AS nom_grado',
                    'paralelos.nombre AS nom_paralelo',
                    DB::raw('CONCAT(users.name, " ", users.last) AS nom_usuario'))
                ->where('paralelos_horarios.paralelo_id', $paralelo_id)
                ->where('paralelos_horarios.status', 1)
                ->where('asignaturas.status', 1)
                ->where('paralelos.status', 1)
                ->where(function($query) {
                    $query->where('users.status', 1)
                          ->orWhereNull('users.status');
                })
                ->orderBy('paralelos_horarios.bloque_id')
                ->get();


        $horarios = [];

        foreach ($data as $horario) {
            $horarios[$horario->bloque_id][$horario->dia_id] = [
                'horario_id' => $horario->id,
                'nom_bloque' => $horario->nom_bloque,
                'nom_asignatura' => $horario->nom_asignatura,
                'nom_docente' => $horario->nom_usuario ? $horario->nom_usuario : ''
            ];

            ksort($horarios[$horario->bloque_id]);
        }  
        //dd($horarios);

        $dias = DB::table('catalogos')
                        ->select('id', 'nombre')
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('generalidad_id', 20 )
                        ->where('status', 1 )
                        ->orderBy('id')
                        ->get();


        $ultimoElemento = null;

        if ($dias->isNotEmpty()) {
            $ultimoElemento = $dias->last()->id;
        }

        $titulos = DB::table('paralelos')
                        ->leftJoin('grados', 'paralelos.grado_id', '=', 'grados.id')
                        ->select('grados.nombre AS nom_grado', 'paralelos.nombre AS nom_paralelo')
                        ->where('paralelos.empresa_id', Auth::user()->empresa_id )
                        ->where('paralelos.id', 20 )
                        ->where('paralelos.status', 1 )
                        ->first();

        $titulo = 'Grado: '.$titulos->nom_grado.' - Paralelo: '.$titulos->nom_paralelo;

        return view('paraleloshorarios.index', compact('horarios', 'titulo', 'dias', 'paralelo_id', 'ultimoElemento'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create($paralelo_id)
    {
        $temporadas = DB::table('temporadas')->where('empresa_id', Auth::user()->empresa_id )->where('status', 1 )->get();

        $dias = DB::table('catalogos')
                    ->where('generalidad_id', 20 )
                    ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('status', 1 )
                    ->get();

        $asignaturas = DB::table('asignaturas')
                    ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('status', 1 )
                    ->get();

        $docentes = DB::select('SELECT id, CONCAT(name, " " , last) AS nombre
                                FROM users t1
                                WHERE empresa_id = ? 
                                AND NOT EXISTS (SELECT NULL
                                                    FROM profesionales t2
                                                    WHERE t2.usuario_id = t1.id 
                                                    AND t2.empresa_id = t1.empresa_id)', [Auth::user()->empresa_id]);

        $bloques = DB::table('catalogos')
                    ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('generalidad_id', 21)
                    ->where('status', 1 )
                    ->get();

        $titulo = 'Horarios paralelos';

        return view('paraleloshorarios.create', compact('titulo', 'temporadas', 'dias', 'asignaturas', 'docentes', 'bloques', 'paralelo_id'));
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

        $data = ParalelosHorarios::create($request->all());

        return redirect ('admin/horarios_paralelos/'.$request->input('paralelo_id'))->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = ParalelosHorarios::find($id); 

        $temporadas = DB::table('temporadas')->where('empresa_id', Auth::user()->empresa_id )->where('status', 1 )->get();

        $dias = DB::table('catalogos')
                    ->where('generalidad_id', 20 )
                    ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('status', 1 )
                    ->get();

        $asignaturas = DB::table('asignaturas')
                    ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('status', 1 )
                    ->get();

        $docentes = DB::select('SELECT id, CONCAT(name, " " , last) AS nombre
                                FROM users t1
                                WHERE empresa_id = ? 
                                AND NOT EXISTS (SELECT NULL
                                                    FROM profesionales t2
                                                    WHERE t2.usuario_id = t1.id 
                                                    AND t2.empresa_id = t1.empresa_id)', [Auth::user()->empresa_id]);

        $bloques = DB::table('catalogos')
                    ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('generalidad_id', 21)
                    ->where('status', 1 )
                    ->get();

        $titulo = 'Horarios paralelos';

        return view ('paraleloshorarios.edit')->with (compact('data', 'titulo', 'temporadas', 'dias', 'asignaturas', 'docentes', 'bloques'));
    }


/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {

        $request['user_update'] = Auth::id();
        $datos = ParalelosHorarios::find($id)->update($request->all());

        $bloques = DB::table('paralelos_horarios')
                    ->select('paralelo_id')
                    ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('id', $id)
                    ->first();
        
        return redirect ('admin/horarios_paralelos/'.$bloques->paralelo_id)->with('success', 'Registro actualizado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = ParalelosHorarios::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/horarios_paralelos/'.$request->input('paralelo_id'))->with('eliminar', 'ok');
    }


/*
|--------------------------------------------------------------------------
| Activar publicación
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {
        $data = ParalelosHorarios::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/horarios_paralelos/'.$request->input('paralelo_id'));
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicación
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = ParalelosHorarios::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/horarios_paralelos/'.$request->input('paralelo_id'));
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