<?php

namespace App\Http\Controllers;

use App\Tareas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Traits\Funciones;
use DB;

class TareasController extends Controller
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

        $titulo = 'Tareas';

        $consulta = DB::table('tareas')
                    ->leftJoin('temporadas', 'tareas.temporada_id', '=', 'temporadas.id')
                    ->leftJoin('periodos', 'tareas.periodo_id', '=', 'periodos.id')
                    ->leftJoin('grados', 'tareas.grado_id', '=', 'grados.id')
                    ->leftJoin('paralelos', 'tareas.paralelo_id', '=', 'paralelos.id')
                    ->leftJoin('asignaturas', 'tareas.asignatura_id', '=', 'asignaturas.id')
                    ->select(
                            'tareas.*',
                            'temporadas.nombre AS nom_temporada', 
                            'periodos.nombre AS nom_periodo',
                            'grados.nombre AS nom_grado',
                            'paralelos.nombre AS nom_paralelo',
                            'asignaturas.nombre AS nom_asignatura',
                            DB::raw('(CASE WHEN tareas.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento')
                    )
                    ->where('tareas.empresa_id', Auth::user()->empresa_id )                    
                    ->where('tareas.status','!=', 3 )
                    ->orderByRaw('tareas.id DESC');
        
        if($permiso == 2) //Es docente
        {
            $consulta->where('tareas.user_create', Auth::id());
        }

        $data = $consulta->get(); 

        return view('tareas.index', compact('data', 'titulo'));
    }

/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/
    public function create()
    {

        $titulo = 'Tareas';

        $temporadas = DB::table('temporadas')
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('status', 1 )
                        ->get();

        $periodos = DB::table('periodos')
                    ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('temporada_id', $temporadas[0]->id)
                    ->where('status', 1 )
                    ->get();

        $grados = DB::table('paralelos')
                    ->leftJoin('grados', 'paralelos.grado_id', '=', 'grados.id')
                    ->select('grados.id', 'grados.nombre')
                    ->where('paralelos.empresa_id', Auth::user()->empresa_id )
                    ->where('paralelos.status', 1 )
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

        $fecha = Carbon::now();
        $hoy = $fecha->format('Y-m-d');

        $empresa = Auth::user()->empresa_id;
        

        return view('tareas.create', compact('titulo', 'temporadas', 'periodos', 'grados', 'paralelos', 'asignaturas', 'hoy', 'empresa'));
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
        $request['user_create'] = Auth::user()->alumno_id;
        $data = Tareas::create($request->all());

        if ($request->file('imagen')) {
             $path = Storage::disk('public')->put('tareas',$request->file('imagen'));
             $data->fill(['imagen'=>asset($path)])->save();
        }

        return redirect ('admin/tareas')->with('success', 'Registro creado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| show
|--------------------------------------------------------------------------
|
*/
    public function show()
    {

        $titulo = 'Tareas';

        //Se consulta el paralelo del alumno a partir del ID de usuario
        $info_usuario = DB::table('matriculas')
                        ->select('paralelo_id')
                        ->where('empresa_id', Auth::user()->empresa_id)
                        ->where('alumno_id', Auth::user()->alumno_id)
                        ->where('status', 5)
                        ->orderByRaw('id DESC')
                        ->first();
        
        //Si hay registros retorna a la página interior  
        if (!$info_usuario) {
            return back()->with('error', 'No se encontraron registros.');
        }

        $data = DB::table('tareas')
                    ->leftJoin('asignaturas', 'tareas.asignatura_id', '=', 'asignaturas.id')
                    ->leftJoin('users', 'tareas.user_create', '=', 'users.id')
                    ->select(
                            'tareas.*',
                            'asignaturas.nombre AS nom_asignatura',
                            DB::raw('CONCAT(COALESCE(users.name, ""), " ", COALESCE(users.last, "")) AS nom_docente')
                            )
                    ->where('tareas.empresa_id', Auth::user()->empresa_id)
                    ->where('tareas.paralelo_id', $info_usuario->paralelo_id)
                    ->where('tareas.status', 1 )
                    ->orderByRaw('tareas.id DESC')
                    ->limit(8)
                    ->get(); 

    
        return view ('tareas.show')->with (compact('titulo', 'data'));
    }

/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/
    public function edit($id)
    {
        $titulo = 'Tareas';

        $data = Tareas::find($id); 

        $temporadas = DB::table('temporadas')
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('status', 1 )
                        ->get();

        $periodos = DB::table('periodos')
                    ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('status', 1 )
                    ->get();

        $grados = DB::table('paralelos')
                    ->leftJoin('grados', 'paralelos.grado_id', '=', 'grados.id')
                    ->select('grados.id', 'grados.nombre')
                    ->where('paralelos.empresa_id', Auth::user()->empresa_id )
                    ->where('paralelos.status', 1 )
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

        $empresa = Auth::user()->empresa_id;

        return view('tareas.edit', compact('data', 'titulo', 'temporadas', 'periodos', 'grados', 'paralelos', 'asignaturas', 'empresa'));
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
        $data = tareas::find($id)->update($request->all());


        $data = tareas::find($id);
        if ($request->file('imagen')) {
            $path = Storage::disk('public')->put('tareas', $request->file('imagen'));
            $data->imagen = asset($path);
            $data->save();
        }


        return redirect ('admin/tareas')->with('success', 'Registro actualizado exitosamente');

    }

/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/
    public function destroy($id)
    {
        $data = Tareas::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/tareas')->with('eliminar', 'ok');
    }


/*
|--------------------------------------------------------------------------
| Activar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Tareas::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/tareas')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Tareas::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/tareas')->with('success', 'Registro creado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| Asignaturas por docente por grado por paralelo por periodo por temporada
|--------------------------------------------------------------------------
|
*/
    public function asignaturas($paralelo_id, $docente_id)
    {
        $asignaturas = DB::table('paralelos_horarios AS ph')
                        ->leftJoin('asignaturas', 'paralelos_horarios.asignatura_id', '=', 'asignaturas.id')
                        ->select('asignaturas.id', 'asignaturas.nombre')                        
                        ->where('ph.empresa_id', Auth::user()->empresa_id )
                        ->where('ph.paralelo_id', $paralelo_id )
                        ->where('ph.docente_id', $docente_id)
                        ->where('ph.status', 1 )
                        ->get();

        return $asignaturas;
    }


}
