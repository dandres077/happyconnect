<?php

namespace App\Http\Controllers;

use App\Alumnos;
use App\Padres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;


class AlumnosController extends Controller
{
/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {
        $data = DB::table('alumnos')
            ->select(
                'alumnos.*',
                DB::raw('(CASE WHEN status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
             ->where('empresa_id', Auth::user()->empresa_id )
            ->where('alumnos.status', '<>', 3 )
            ->orderByRaw('alumnos.id ASC')
            ->get();

        $titulo = 'Alumnos';

        return view('alumnos.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
      
        $titulo = 'Alumnos';

        $paises = DB::table('paises')->select('id', 'nombre')->where('status', 1 )->orderByRaw('nombre ASC')->get();
        $dptos = DB::table('departamentos')->select('id', 'nombre')->where('status', 1 )->orderByRaw('nombre ASC')->get();
        $ciudades = DB::table('ciudades')->select('id', 'nombre')->where('status', 1 )->orderByRaw('nombre ASC')->get();

        $documentos = DB::table('catalogos')->select('id', 'opcion')->where('status', 1 )->where('generalidad_id', 2 )->orderByRaw('opcion ASC')->get();
        $sangres = DB::table('catalogos')->select('id', 'opcion')->where('status', 1 )->where('generalidad_id', 13 )->orderByRaw('opcion ASC')->get();

        return view('alumnos.create', compact(
                                                'titulo', 
                                                'paises', 
                                                'dptos', 
                                                'ciudades', 
                                                'documentos',
                                                'sangres'
                                                )
        );
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
        $data = Alumnos::create($request->all());
        
        if ($request->file('imagen')) {
             $path = Storage::disk('public')->put('images',$request->file('imagen'));
             $data->fill(['imagen'=>asset($path)])->save();
        }

        return redirect ('admin/alumnos');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = Alumnos::find($id); 
        $paises = DB::table('paises')->select('id', 'nombre')->where('status', 1 )->orderByRaw('nombre ASC')->get();
        $dptos = DB::table('departamentos')->select('id', 'nombre')->where('status', 1 )->orderByRaw('nombre ASC')->get();
        $ciudades = DB::table('ciudades')->select('id', 'nombre')->where('status', 1 )->orderByRaw('nombre ASC')->get();

        $documentos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 2 )->orderByRaw('nombre ASC')->get();
        $sangres = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 13 )->orderByRaw('nombre ASC')->get();

        $titulo = 'Alumnos';

        return view('alumnos.edit', compact(
                                                'data',
                                                'titulo', 
                                                'paises', 
                                                'dptos', 
                                                'ciudades', 
                                                'documentos', 
                                                'sangres'
                                                )
        );
    }



/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {

        $data = Alumnos::find($id);
        $data->nombre1 = $request->input('nombre1');
        $data->apellido1 = $request->input('apellido1');
        $data->nombre2 = $request->input('nombre2');
        $data->apellido2 = $request->input('apellido2');
        $data->tipo_id = $request->input('tipo_id');
        $data->n_documento = $request->input('n_documento');
        $data->exp_fecha = $request->input('exp_fecha');

        $data->pais_exp = $request->input('pais_exp');
        $data->departamento_exp = $request->input('departamento_exp');
        $data->ciudad_exp = $request->input('ciudad_exp');
        

        $data->pais_origen = $request->input('pais_origen');        
        $data->departamento_origen = $request->input('departamento_origen');
        $data->ciudad_origen = $request->input('ciudad_origen');

        $data->sangre_id = $request->input('sangre_id');
        $data->user_update = Auth::id();
        $data->save();

        if ($request->file('imagen')) {
             $path = Storage::disk('public')->put('images',$request->file('imagen'));
             $data->fill(['imagen'=>asset($path)])->save();
        }
        
        return redirect ('admin/alumnos')->with('success', 'Registro actualizado exitosamente');
    }



/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Alumnos::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/alumnos');
    }


/*
|--------------------------------------------------------------------------
| Activar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Alumnos::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/alumnos');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Alumnos::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/alumnos');
    }


/*
|--------------------------------------------------------------------------
| Padres - Index
|--------------------------------------------------------------------------
|
*/

    public function padre_alumno($id)
    {
        $alumno = DB::table('alumnos')->select('id', 'nombre1', 'apellido1')->where('id', $id )->where('status', 1 )->first();

        $padres = DB::table('padres')
                ->leftJoin('catalogos', 'padres.tipo_familiar', '=', 'catalogos.id')
                ->leftJoin('catalogos as catalogos2', 'padres.tipo_id', '=', 'catalogos2.id')               
                ->select(
                'padres.*',
                'catalogos.opcion AS familiar',
                'catalogos2.opcion AS tipo_documento')
                ->orderByRaw('padres.nombres ASC')
                ->get();

        $titulo = 'Alumnos';

        return view('alumnos.padres_index', compact(
                                                'alumno',
                                                'padres', 
                                                'titulo'
                                                )
        );
    }



/*
|--------------------------------------------------------------------------
| Padres Crear
|--------- -----------------------------------------------------------------
|
*/

    public function padre_create($id)
    {
        $alumno = DB::table('alumnos')->select('id', 'nombre1', 'apellido1')->where('id', $id )->where('status', 1 )->first();
        $tipo_padres = DB::table('catalogos')->select('id', 'opcion')->where('status', 1 )->where('nombre', 12 )->orderByRaw('opcion ASC')->get();
        $documentos = DB::table('catalogos')->select('id', 'opcion')->where('status', 1 )->where('nombre', 2 )->orderByRaw('opcion ASC')->get();

        $titulo = 'Alumnos';

        return view('alumnos.padres_create', compact(
                                                'alumno',
                                                'tipo_padres', 
                                                'documentos',
                                                'titulo',
                                                'id'
                                                )
        );
    }


/*
|--------------------------------------------------------------------------
| Padres store
|--------------------------------------------------------------------------
|
*/
    public function padres_store(Request $request)
    {

        $request['alumno_id'] = Auth::id();
        $request['user_create'] = Auth::id();
        $data = Padres::create($request->all());
        
        return redirect ('admin/alumnos');
    }


    /*
}
|--------------------------------------------------------------------------
| View
|--------------------------------------------------------------------------
|
*/

    public function view($id)
    {
        $colegio = Auth::user()->empresa_id;
        $titulo = 'Alumnos';

        $alumno = DB::table('matriculas')
                ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')           
                ->leftJoin('catalogos', 'alumnos.sangre_id', '=', 'catalogos.id')           
                ->leftJoin('catalogos AS c2', 'alumnos.genero_id', '=', 'c2.id')    
                ->select(
                        'alumnos.*',
                        'catalogos.opcion AS sangre',
                        'c2.opcion AS genero',
                        DB::raw('CONCAT(matriculas.nombres_acu, " ", matriculas.apellidos_acu) AS nomacudiente'),
                        'matriculas.telefono_acu',
                        'matriculas.celular_acu',
                        'matriculas.email_acu',
                        'matriculas.parentesco_acu',
                        'matriculas.email_est')
                ->where('matriculas.empresa_id', $colegio)
                ->where('matriculas.alumno_id', $id)
                ->first();
        //dd($alumno);

        $padre = Padres::where('alumno_id', $alumno->id)->where('tipo_familiar', 1)->firstOrFail();
        $madre = Padres::where('alumno_id', $alumno->id)->where('tipo_familiar', 2)->firstOrFail();
       
        if ($alumno) {
            return view('alumnos.view', compact('alumno', 'titulo', 'padre', 'madre'));
        }else{
            return back()->with('danger', 'No tiene permiso para ver la informaci贸n');
        }


        

        
    }
}
