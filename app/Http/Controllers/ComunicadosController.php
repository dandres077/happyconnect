<?php

namespace App\Http\Controllers;

use App\Comunicados;
use App\ComunicadosDocumentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;


class ComunicadosController extends Controller
{

/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {
        $data = DB::table('comunicados')
                ->leftJoin('comunicados_documentos', 'comunicados.id', '=', 'comunicados_documentos.comunicado_id')
                ->leftJoin('paralelos', 'comunicados_documentos.paralelo_id', '=', 'paralelos.id')
                ->leftJoin('grados', 'paralelos.grado_id', '=', 'grados.id')
                ->leftJoin('catalogos', 'comunicados.categoria_id', '=', 'catalogos.id')
                ->leftJoin('temporadas', 'comunicados.temporada_id', '=', 'temporadas.id')
                ->select(
                    'comunicados.id',
                    'comunicados.nombre',
                    'comunicados.descripcion',
                    'comunicados.archivo1',
                    'comunicados.archivo2',
                    'comunicados.archivo3',
                    'comunicados.created_at', 
                    'catalogos.nombre AS nom_categoria',
                    'temporadas.nombre AS nom_temporada',
                    'comunicados.status',
                    DB::raw('(CASE WHEN comunicados.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'),
                    DB::raw('GROUP_CONCAT(CONCAT(grados.nombre, paralelos.nombre) ORDER BY grados.id, paralelos.id ASC SEPARATOR ", ") AS grados')
                )
                ->where('comunicados.empresa_id', Auth::user()->empresa_id)
                ->where('comunicados.status', '<>', 3)
                ->where('comunicados_documentos.status', 1)
                ->groupBy(
                        'comunicados.id', 
                        'comunicados.nombre', 
                        'comunicados.descripcion', 
                        'comunicados.archivo1',
                        'comunicados.archivo2',
                        'comunicados.archivo3',
                        'comunicados.created_at', 
                        'catalogos.nombre', 
                        'temporadas.nombre',
                        'comunicados.status')
                ->orderByRaw('id ASC')
                ->get();



        $titulo = 'Comunicados';
        

        return view('comunicados.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $titulo = 'Comunicados';

        $temporadas = DB::table('temporadas')
                        ->select('id', 'nombre')
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('status', 1 )
                        ->orderByRaw('nombre ASC')
                        ->get();

        $categorias = DB::table('catalogos')
                        ->select('id', 'nombre')
                        ->where('status', 1 )
                        ->where('generalidad_id', 26 )
                        ->orderByRaw('nombre ASC')
                        ->get();

        $paralelos = DB::table('paralelos')
                        ->leftJoin('grados', 'paralelos.grado_id', '=', 'grados.id')
                        ->select(
                            'paralelos.id',
                            DB::raw('CONCAT(grados.nombre, " ", paralelos.nombre) AS nom_paralelo'))            
                        ->where('paralelos.empresa_id', Auth::user()->empresa_id )
                        ->where('paralelos.status', 1 )
                        ->orderByRaw('paralelos.id ASC')
                        ->get();

        return view('comunicados.create', compact('titulo', 'temporadas', 'categorias', 'paralelos'));
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
        $data = Comunicados::create($request->all());

        if ($request->file('archivo1')) {
             $path = Storage::disk('public')->put('documentos',$request->file('archivo1'));
             $data->fill(['archivo1'=>asset($path)])->save();
        }

        if ($request->file('archivo2')) {
             $path = Storage::disk('public')->put('documentos',$request->file('archivo2'));
             $data->fill(['archivo2'=>asset($path)])->save();
        }

        if ($request->file('archivo3')) {
             $path = Storage::disk('public')->put('documentos',$request->file('archivo3'));
             $data->fill(['archivo3'=>asset($path)])->save();
        }

        $comunicado_id = $data->id;

        //Paralelos
        $paralelos = $request->input('paralelos');

        foreach ($paralelos as $paralelo) {
            $comunicados = new ComunicadosDocumentos([
                'empresa_id' => Auth::user()->empresa_id,
                'comunicado_id' => $comunicado_id,
                // 'grado_id' => $user_create,
                'paralelo_id' => $paralelo,
                'user_create' => Auth::id(),
                'paralelo_id' => $paralelo
            ]);

            $comunicados->save();            
        }         


        return redirect ('admin/comunicados/')->with('success', 'Registro creado exitosamente');
        
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = Comunicados::find($id); 

        $titulo = 'Comunicados';

        $temporadas = DB::table('temporadas')
                        ->select('id', 'nombre')
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('status', 1 )
                        ->orderByRaw('nombre ASC')
                        ->get();

        $categorias = DB::table('catalogos')
                        ->select('id', 'nombre')
                        ->where('status', 1 )
                        ->where('generalidad_id', 26 )
                        ->orderByRaw('nombre ASC')
                        ->get();

        $paralelos = DB::table('paralelos')
                        ->leftJoin('grados', 'paralelos.grado_id', '=', 'grados.id')
                        ->select(
                            'paralelos.id',
                            DB::raw('CONCAT(grados.nombre, " ", paralelos.nombre) AS nom_paralelo'))            
                        ->where('paralelos.empresa_id', Auth::user()->empresa_id )
                        ->where('paralelos.status', 1 )
                        ->orderByRaw('paralelos.id ASC')
                        ->get();

        $seleccionados = DB::table('comunicados_documentos')
                        ->select('paralelo_id')            
                        ->where('comunicado_id', $id )
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('status', 1 )
                        ->orderByRaw('id ASC')
                        ->get();

        return view ('comunicados.edit')->with (compact('data', 'titulo', 'temporadas', 'categorias', 'paralelos', 'seleccionados'));
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
        $data = Comunicados::find($id);

        if ($data) 
        {
            $data->update($request->all());

            if ($request->file('archivo1')) {
                $path = Storage::disk('public')->put('documentos', $request->file('archivo1'));
                $data->archivo1 = asset($path);
                $data->save();
            }

            if ($request->file('archivo2')) {
                $path = Storage::disk('public')->put('documentos', $request->file('archivo2'));
                $data->archivo2 = asset($path);
                $data->save();
            }

            if ($request->file('archivo3')) {
                $path = Storage::disk('public')->put('documentos', $request->file('archivo3'));
                $data->archivo3 = asset($path);
                $data->save();
            }
        }


        $paralelos = $request->input('paralelos');

        // Obtener los registros existentes para el comunicado
        $comunicadosExistentes = ComunicadosDocumentos::where('comunicado_id', $id)->get();

        // Obtener los IDs de los registros existentes
        $idsExistentes = $comunicadosExistentes->pluck('paralelo_id')->toArray();

        // Marcar los registros existentes que también están en la selección actual
        $marcarRegistros = array_intersect($paralelos, $idsExistentes);

        // Eliminar los registros existentes que no están en la selección actual
        $eliminarRegistros = array_diff($idsExistentes, $paralelos);

        // Crear nuevos registros para los paralelos seleccionados que no existen aún
        $nuevosRegistros = array_diff($paralelos, $idsExistentes);

        // Actualizar los registros existentes que se deben marcar
        ComunicadosDocumentos::whereIn('paralelo_id', $marcarRegistros)
            ->where('comunicado_id', $id)
            ->update(['user_update' => Auth::id()]);

        // Eliminar los registros existentes que deben ser eliminados
        ComunicadosDocumentos::whereIn('paralelo_id', $eliminarRegistros)
            ->where('comunicado_id', $id)
            ->delete();

        // Crear nuevos registros para los paralelos seleccionados que no existen aún
        foreach ($nuevosRegistros as $paralelo) {
            $comunicados = new ComunicadosDocumentos();
            $comunicados->empresa_id = Auth::user()->empresa_id;
            $comunicados->comunicado_id = $id;
            $comunicados->paralelo_id = $paralelo;
            $comunicados->user_update = Auth::id();
            $comunicados->save();
        }

    
        return redirect ('admin/comunicados')->with('success', 'Registro actualizado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Comunicados::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return back()->with('eliminar', 'ok');
    }

/*
|--------------------------------------------------------------------------
| Activar publicación
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Comunicados::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/comunicados')->with('success', 'Registro activado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicación
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Comunicados::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/comunicados')->with('success', 'Registro inactivado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/
    public function destroy_documento($id, $archivo)
    {

        if($archivo == 'a1')
        {
            $data = Comunicados::find($id);
            $data->archivo1 = "";
            $data->user_update = Auth::id();
            $data->save();
        }

        if($archivo == 'a2')
        {
            $data = Comunicados::find($id);
            $data->archivo2 = "";
            $data->user_update = Auth::id();
            $data->save();
        }

        if($archivo == 'a3')
        {
            $data = Comunicados::find($id);
            $data->archivo3 = "";
            $data->user_update = Auth::id();
            $data->save();
        }

        return back()->with('eliminar', 'ok');
    }

/*
|--------------------------------------------------------------------------
| Visualización para padres de familia
|--------------------------------------------------------------------------
|
*/

    public function show()
    {       

        $titulo = 'Comunicados';

        //Se consulta el paralelo del alumno a partir del ID de usuario
        $info_usuario = DB::table('matriculas')
                        ->select('paralelo_id')
                        ->where('empresa_id', Auth::user()->empresa_id)
                        ->where('alumno_id', Auth::id())
                        ->where('status', 5)
                        ->orderByRaw('id DESC')
                        ->first();

        //Se valida si contiene información
        if (empty($info_usuario)) 
        {
            $paralelo = 0; // No tiene paralelo
        }else{
            $paralelo = 1;
        }

        //Consulta para obtener los documentos por empresa
        $consulta = DB::table('comunicados_documentos')
                    ->leftJoin('matriculas', 'comunicados_documentos.paralelo_id', '=', 'matriculas.paralelo_id')
                    ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')
                    ->leftJoin('comunicados', 'comunicados_documentos.comunicado_id', '=', 'comunicados.id')
                    ->select(
                            'comunicados.nombre',
                            'comunicados.descripcion',
                            'comunicados.archivo1',
                            'comunicados.archivo2',
                            'comunicados.archivo3',
                            'comunicados.imagen',
                            DB::raw('DATE_FORMAT(comunicados.created_at, "%d-%m-%Y") AS created_at')
                        )            
                    ->where('comunicados_documentos.empresa_id', Auth::user()->empresa_id )
                    ->where('comunicados.status', 1 )
                    ->groupBy(
                            'comunicados.nombre',
                            'comunicados.descripcion',
                            'comunicados.archivo1',
                            'comunicados.archivo2',
                            'comunicados.archivo3',
                            'comunicados.imagen',
                            'comunicados.created_at'
                        )
                    ->orderByRaw('comunicados.id DESC');
            
        //Se agrega la condición a la consulta para filtrar por el paralelo
        if($paralelo != 0) 
        {
            $consulta->where('comunicados_documentos.paralelo_id', $info_usuario->paralelo_id);
        }

        //Se ejecuta la consulta
        $data = $consulta->get();     

        return view ('comunicados.show')->with (compact('titulo', 'data'));
    }

/*
|--------------------------------------------------------------------------
| Visualización para padres de familia
|--------------------------------------------------------------------------
|
*/

    public static function obtenerTipoArchivo($rutaArchivo)
    {
        $extension = pathinfo($rutaArchivo, PATHINFO_EXTENSION);
        
        switch ($extension) {
            case 'pdf':
                return 'PDF';
            case 'doc':
            case 'docx':
                return 'Word';
            case 'jpg':
            case 'jpeg':
            case 'png':
                return 'Imagen';
            default:
                return 'Archivo';
        }
    }

}
