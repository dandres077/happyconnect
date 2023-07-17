<?php

namespace App\Http\Controllers;

use App\Rutas;
use App\RutasAlumnos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Traits\Funciones;
use DB;


class RutasController extends Controller
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
 
        $titulo = 'Rutas';

        $consulta = DB::table('rutas')
                    ->leftJoin('temporadas', 'rutas.temporada_id', '=', 'temporadas.id')
                    ->leftJoin('proveedores', 'rutas.proveedor_id', '=', 'proveedores.id')
                    ->select(
                            'rutas.*', 
                            'temporadas.nombre AS nom_temporada',
                            'proveedores.empresa AS nom_proveedor',
                            DB::raw('(CASE WHEN rutas.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
                    ->where('rutas.status', '<>', 3 )
                    ->orderByRaw('rutas.id ASC');
        

        if($permiso == 2)
        {
            $consulta->where('rutas.empresa_id', Auth::user()->empresa_id);

        }

        $data = $consulta->get();  
        
        return view ('rutas.index')->with (compact('data', 'titulo'));
    }

/*
|--------------------------------------------------------------------------
| Create
|--------------------------------------------------------------------------
|
*/
    public function create()
    {
        $titulo = 'Rutas';

        $temporadas = DB::table('temporadas')
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('status', 1 )
                        ->get();

        $proveedores = DB::table('proveedores')
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('status', 1 )
                        ->get();        


        return view ('rutas.create')->with (compact('titulo', 'temporadas', 'proveedores'));
    }

/*
|--------------------------------------------------------------------------
| Store
|--------------------------------------------------------------------------
|
*/
    public function store(Request $request)
    {

        $request['empresa_id'] = Auth::user()->empresa_id;
        $request['user_create'] = Auth::id();
        $data = Rutas::create($request->all());

        if ($request->file('imagen')) {
             $path = Storage::disk('public')->put('images',$request->file('imagen'));
             $data->fill(['imagen'=>asset($path)])->save();
        }

        return redirect ('admin/rutas')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| Edit
|--------------------------------------------------------------------------
|
*/
    public function edit($id)
    {
        $data = Rutas::find($id);

        $temporadas = DB::table('temporadas')
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('status', 1 )
                        ->get();

        $proveedores = DB::table('proveedores')
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('status', 1 )
                        ->get();

        $titulo = 'Rutas';

        $alumnos = DB::table('matriculas')
                ->leftJoin('empresas', 'matriculas.empresa_id', '=', 'empresas.id')
                ->leftJoin('temporadas', 'matriculas.temporada_id', '=', 'temporadas.id')
                ->leftJoin('grados', 'matriculas.grado_id', '=', 'grados.id')
                ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')
                ->leftJoin('catalogos', 'alumnos.tipo_id', '=', 'catalogos.id')
                ->leftJoin('paralelos', 'matriculas.paralelo_id', '=', 'paralelos.id')
                ->leftJoin('catalogos AS c2', 'matriculas.jornada_id', '=', 'c2.id')
                ->select(
                        'alumnos.id AS alumno_id',
                        'temporadas.nombre AS nom_temporada',
                        'grados.id AS grado_id',
                        'grados.nombre AS nom_grado',
                        DB::raw('CONCAT(alumnos.nombre1, " ", alumnos.apellido1) AS nom_alumno'),
                        'alumnos.n_documento',
                        'catalogos.nombre AS tipodoc',
                        'paralelos.id AS paralelo_id',
                        'paralelos.nombre AS nom_paralelo',
                        'c2.nombre AS nom_jornada',
                        DB::raw('(CASE WHEN matriculas.status = 5 THEN "Activo" WHEN matriculas.status = 2 THEN "Inactivo" ELSE "Otro" END) AS estado_elemento'))
                ->where('matriculas.empresa_id', Auth::user()->empresa_id)
                ->where('matriculas.status', 5 )
                ->orderByRaw('grados.id ASC', 'paralelos.id ASC')
                ->get(); 

        $alumnos_rutas = DB::table('rutas_alumnos')
                        ->select('grado_id', 'paralelo_id', 'alumno_id')
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('ruta_id', $id )
                        ->where('status', 1 )
                        ->get();


        $inscritos = DB::table('rutas_alumnos')
                        ->leftJoin('alumnos', 'rutas_alumnos.alumno_id', '=', 'alumnos.id')
                        ->leftJoin('grados', 'rutas_alumnos.grado_id', '=', 'grados.id')
                        ->leftJoin('paralelos', 'rutas_alumnos.paralelo_id', '=', 'paralelos.id')
                        ->select(
                                'rutas_alumnos.id',
                                DB::raw('CONCAT(COALESCE(alumnos.nombre1, ""), " ", COALESCE(alumnos.nombre2, ""), " ", COALESCE(alumnos.apellido1, ""), " ", COALESCE(alumnos.apellido2, "")) AS nom_alumno'),
                                'grados.nombre AS nom_grado',
                                'paralelos.nombre AS nom_paralelo')
                        ->where('rutas_alumnos.empresa_id', Auth::user()->empresa_id )
                        ->where('rutas_alumnos.ruta_id', $id )
                        ->where('rutas_alumnos.status', 1 )
                        ->get();


        return view ('rutas.edit')->with (compact('data', 'titulo', 'temporadas', 'proveedores', 'alumnos', 'alumnos_rutas', 'inscritos'));
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

        $datos = Rutas::find($id)->update($request->all());

        $data = Rutas::find($id);

        if ($request->file('imagen')) {
            $path = Storage::disk('public')->put('rutas', $request->file('imagen'));
            $data->imagen = asset($path);
            $data->save();
        }

        return redirect ('admin/rutas')->with('success', 'Registro actualizado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| Destroy
|--------------------------------------------------------------------------
|
*/
    public function destroy($id)
    {
        $data = Rutas::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/rutas')->with('eliminar', 'ok');
    }

/*
|--------------------------------------------------------------------------
| Activar
|--------------------------------------------------------------------------
|
*/
    public function active($id) 
    {
        $data = Rutas::find($id);
        $data->status = '1'; //Activo
        $data->save();

        return redirect ('admin/rutas')->with('success', 'Registro activado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| Inactivar
|--------------------------------------------------------------------------
|
*/
    public function inactive($id) 
    {

        $data = Rutas::find($id);
        $data->status = '2';//Inactivo
        $data->save();

        return redirect ('admin/rutas')->with('success', 'Registro inactivado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| index alumnos
|--------------------------------------------------------------------------
|
*/
    public function index_alumnos($ruta_id)
    { 
 
        $titulo = 'Rutas';

        $data = DB::table('alumnos')
                    ->select(
                        'alumnos.*',
                        DB::raw('(CASE WHEN status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
                     ->where('empresa_id', Auth::user()->empresa_id )
                    ->where('alumnos.status', '<>', 3 )
                    ->orderByRaw('alumnos.id ASC')
                    ->get();          
        
        return view ('rutas.index_alumnos')->with (compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| Store
|--------------------------------------------------------------------------
|
*/

    public function alumnos_store(Request $request)
    {

        $rutaAlumno = RutasAlumnos::where('ruta_id', $request->input('ruta_id'))->delete();

        $paralelos = $request->input('paralelos'); 

        if($paralelos)
        {
            foreach ($paralelos as $paralelo) {
                // Separar los datos utilizando explode
                $datos = explode('|', $paralelo);
                
                $empresa_id = Auth::user()->empresa_id;
                $ruta_id = $request->input('ruta_id');
                $alumno_id = $datos[0];
                $grado_id = $datos[1];
                $paralelo_id = $datos[2];
                $user_create = Auth::id(); 
                
                // Verificar si ya existe un registro para el alumno
                $rutaAlumno = RutasAlumnos::where('alumno_id', $alumno_id)
                    ->where('grado_id', $grado_id)
                    ->where('paralelo_id', $paralelo_id)
                    ->get();

                if(count($rutaAlumno) == 0 )
                {
                    // Si no existe un registro, se crea uno nuevo
                    $rutaAlumno = new RutasAlumnos();
                    
                    // Asignar los valores a los campos correspondientes
                    $rutaAlumno->empresa_id = $empresa_id;
                    $rutaAlumno->ruta_id = $ruta_id;
                    $rutaAlumno->alumno_id = $alumno_id;
                    $rutaAlumno->grado_id = $grado_id;
                    $rutaAlumno->paralelo_id = $paralelo_id;
                    $rutaAlumno->user_create = $user_create;
                    
                    // Guardar el registro en la base de datos
                    $rutaAlumno->save();
                }
            }

            // Redireccionar o realizar cualquier acción adicional después de guardar o eliminar los datos
        
            return redirect()->back()->with('success', 'Los alumnos han sido asignados correctamente.');

        }else{
            return redirect()->back()->with('success', 'No se ha registrado alumnos.');
        }          
                
    }

}

