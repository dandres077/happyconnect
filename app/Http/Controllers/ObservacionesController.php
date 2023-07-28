<?php

namespace App\Http\Controllers;

use App\Observaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Traits\Funciones;
use DB;

class ObservacionesController extends Controller
{
    use Funciones;
/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/
    public function index()
    {
        $permiso = $this->permisos(Auth::id());  

        $titulo = 'Observaciones';

        $consulta = DB::table('observaciones')
                    ->leftJoin('temporadas', 'observaciones.temporada_id', '=', 'temporadas.id')
                    ->leftJoin('periodos', 'observaciones.periodo_id', '=', 'periodos.id')
                    ->leftJoin('grados', 'observaciones.grado_id', '=', 'grados.id')
                    ->leftJoin('paralelos', 'observaciones.paralelo_id', '=', 'paralelos.id')
                    ->leftJoin('asignaturas', 'observaciones.asignatura_id', '=', 'asignaturas.id')
                    ->leftJoin('alumnos', 'observaciones.alumno_id', '=', 'alumnos.id')
                    ->select(
                            'observaciones.*',
                            'temporadas.nombre AS nom_temporada', 
                            'periodos.nombre AS nom_periodo',
                            'grados.nombre AS nom_grado',
                            'paralelos.nombre AS nom_paralelo',
                            'asignaturas.nombre AS nom_asignatura',
                            DB::raw('CONCAT(COALESCE(alumnos.nombre1, ""), " ", COALESCE(alumnos.apellido1, "")) AS nom_alumno'),
                            DB::raw('(CASE WHEN observaciones.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento')
                    )
                    ->where('observaciones.empresa_id', Auth::user()->empresa_id )
                    ->where('observaciones.status','!=', 3 )
                    ->orderByRaw('observaciones.id DESC');

        if($permiso == 2) //Es docente
        {
            $consulta->where('observaciones.user_create', Auth::id());
        }

        $data = $consulta->get();  


        return view('observaciones.index', compact('data', 'titulo'));
    }

/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/
    public function create()
    {

        $titulo = 'Observaciones';

        $temporadas = DB::table('temporadas')
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('status', 1 )
                        ->get();

        $periodos = DB::table('periodos')
                    ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('temporada_id', $temporadas[0]->id)
                    ->where('status', 1 )
                    ->get();

        $grados = DB::table('paralelos_horarios')
                    ->leftJoin('paralelos', 'paralelos_horarios.paralelo_id', '=', 'paralelos.id')
                    ->leftJoin('grados', 'paralelos.grado_id', '=', 'grados.id')
                    ->select('grados.id', 'grados.nombre')
                    ->where('paralelos_horarios.empresa_id', Auth::user()->empresa_id )
                    ->where('paralelos_horarios.status', 1 )
                    ->groupBy('grados.id', 'grados.nombre')
                    ->get();

        $paralelos = DB::table('paralelos')
                    ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('grado_id', $grados[0]->id)
                    ->where('status', 1 )
                    ->get();

        $asignaturas = DB::table('paralelos_horarios AS ph')
                        ->leftJoin('paralelos', 'ph.paralelo_id', '=', 'paralelos.id')
                        ->leftJoin('grados', 'paralelos.grado_id', '=', 'grados.id')
                        ->leftJoin('asignaturas', 'ph.asignatura_id', '=', 'asignaturas.id')
                        ->select('asignaturas.id', 'asignaturas.nombre')
                        ->where('ph.empresa_id', Auth::user()->empresa_id )
                        ->where('ph.asignatura_id', '!=', 22 )
                        ->where('ph.asignatura_id', '!=', 23 )
                        ->where('ph.paralelo_id', $paralelos[0]->id)
                        ->where('asignaturas.status', 1)
                        ->where('ph.status', 1 )
                        ->groupBy('asignaturas.id', 'asignaturas.nombre')
                        ->get();

        //Se consulta el paralelo del alumno a partir del ID de usuario
        $alumnos = DB::table('matriculas')
                    ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')
                    ->select(
                            'alumnos.id',
                            DB::raw('CONCAT(alumnos.nombre1, " ", alumnos.apellido1) AS nombre'))
                    ->where('matriculas.empresa_id', Auth::user()->empresa_id)
                    ->where('matriculas.temporada_id', $temporadas[0]->id)
                    ->where('matriculas.paralelo_id', $paralelos[0]->id)
                    ->where('matriculas.status', 5 )
                    ->orderByRaw('2 ASC')
                    ->get(); 

        $fecha = Carbon::now();
        $hoy = $fecha->format('Y-m-d');

        $empresa = Auth::user()->empresa_id;
        

        return view('observaciones.create', compact('titulo', 'temporadas', 'periodos', 'grados', 'paralelos', 'asignaturas', 'hoy', 'empresa', 'alumnos'));
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
        $data = Observaciones::create($request->all());

        if ($request->file('imagen')) {
             $path = Storage::disk('public')->put('tareas',$request->file('imagen'));
             $data->fill(['imagen'=>asset($path)])->save();
        }

        return redirect ('admin/observaciones')->with('success', 'Registro creado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| show
|--------------------------------------------------------------------------
|
*/
    public function show()
    {

        $titulo = 'Observaciones';

        //Se consulta el paralelo del alumno a partir del ID de usuario
        $info_usuario = DB::table('matriculas')
                        ->select('paralelo_id')
                        ->where('empresa_id', Auth::user()->empresa_id)
                        //->where('alumno_id', Auth::user()->alumno_id)
                        ->where('status', 5)
                        ->orderByRaw('id DESC')
                        ->first();
        
        //Si hay registros retorna a la página interior  
        if (!$info_usuario) {
            return back()->with('error', 'No se encontraron registros.');
        }

        $data = DB::table('observaciones')
                    ->leftJoin('asignaturas', 'observaciones.asignatura_id', '=', 'asignaturas.id')
                    ->leftJoin('users', 'observaciones.user_create', '=', 'users.id')
                    ->select(
                            'observaciones.*',
                            'asignaturas.nombre AS nom_asignatura',
                            DB::raw('CONCAT(COALESCE(users.name, ""), " ", COALESCE(users.last, "")) AS nom_docente')
                            )
                    ->where('observaciones.empresa_id', Auth::user()->empresa_id)
                    ->where('observaciones.paralelo_id', $info_usuario->paralelo_id)
                    //->where('observaciones.alumno_id', Auth::user()->alumno_id)
                    ->where('observaciones.status', 1 )
                    ->orderByRaw('observaciones.id DESC')
                    ->limit(8)
                    ->get(); 

    
        return view ('observaciones.show')->with (compact('titulo', 'data'));
    }

/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/
    public function edit($id)
    {
        $titulo = 'Observaciones';

        $data = Observaciones::find($id); 

        $temporadas = DB::table('temporadas')
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('status', 1 )
                        ->get();

        $periodos = DB::table('periodos')
                    ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('status', 1 )
                    ->get();

        $grados = DB::table('paralelos_horarios')
                    ->leftJoin('paralelos', 'paralelos_horarios.paralelo_id', '=', 'paralelos.id')
                    ->leftJoin('grados', 'paralelos.grado_id', '=', 'grados.id')
                    ->select('grados.id', 'grados.nombre')
                    ->where('paralelos_horarios.empresa_id', Auth::user()->empresa_id )
                    ->where('paralelos_horarios.status', 1 )
                    ->groupBy('grados.id', 'grados.nombre')
                    ->get();

        $paralelos = DB::table('paralelos')
                    ->select('id', 'nombre')
                    ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('grado_id', $data->grado_id )
                    ->where('status', 1 )
                    ->groupBy('id', 'nombre')
                    ->get();

        $asignaturas = DB::table('paralelos_horarios AS ph')
                        ->leftJoin('paralelos', 'ph.paralelo_id', '=', 'paralelos.id')
                        ->leftJoin('grados', 'paralelos.grado_id', '=', 'grados.id')
                        ->leftJoin('asignaturas', 'ph.asignatura_id', '=', 'asignaturas.id')
                        ->select('asignaturas.id', 'asignaturas.nombre')
                        ->where('ph.empresa_id', Auth::user()->empresa_id )
                        ->where('ph.asignatura_id', '!=', 22 ) //Descanso
                        ->where('ph.asignatura_id', '!=', 23 ) //Salida
                        ->where('asignaturas.status', 1)
                        ->where('ph.status', 1 )
                        ->groupBy('asignaturas.id', 'asignaturas.nombre')
                        ->get();

        //Se consulta el paralelo del alumno a partir del ID de usuario
        $alumnos = DB::table('matriculas')
                    ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')
                    ->select(
                            'matriculas.id',
                            'matriculas.alumno_id',
                            DB::raw('CONCAT(alumnos.nombre1, " ", alumnos.apellido1) AS nom_alumno'))
                    ->where('matriculas.empresa_id', Auth::user()->empresa_id)
                    ->where('matriculas.temporada_id', $temporadas[0]->id)
                    ->where('matriculas.paralelo_id', Auth::user()->paralelo_id)
                    ->where('matriculas.status', 5 )
                    ->orderByRaw('3 ASC')
                    ->get(); 

        $empresa = Auth::user()->empresa_id;

        return view('observaciones.edit', compact('data', 'titulo', 'temporadas', 'periodos', 'grados', 'paralelos', 'asignaturas', 'empresa', 'alumnos'));
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
        $data = Observaciones::find($id)->update($request->all());


        $data = Observaciones::find($id);
        if ($request->file('imagen')) {
            $path = Storage::disk('public')->put('tareas', $request->file('imagen'));
            $data->imagen = asset($path);
            $data->save();
        }


        return redirect ('admin/observaciones')->with('success', 'Registro actualizado exitosamente');

    }

/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/
    public function destroy($id)
    {
        $data = Observaciones::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/observaciones')->with('eliminar', 'ok');
    }


/*
|--------------------------------------------------------------------------
| Activar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Observaciones::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/observaciones')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Observaciones::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/observaciones')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| Alumnos por paralelo
|--------------------------------------------------------------------------
|
*/
    public function alumnos($paralelo_id)
    {
        $alumnos = DB::table('matriculas')
                    ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')
                    ->select(
                            'alumnos.id',
                            DB::raw('CONCAT(alumnos.nombre1, " ", alumnos.apellido1) AS nombre'))
                    ->where('matriculas.paralelo_id', $paralelo_id)
                    ->where('matriculas.status', 5 )
                    ->orderByRaw('2 ASC')
                    ->get(); 

        return $alumnos;
    }

}
