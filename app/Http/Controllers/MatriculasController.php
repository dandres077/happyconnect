<?php

namespace App\Http\Controllers;

use App\Matriculas;
use App\Alumnos;
use App\Padres;
use App\MatriculasDocumentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\UploadedFile;

class MatriculasController extends Controller
{

    public function generarCodigo($longitud) {
         $key = 'UA';
         $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
         $max = strlen($pattern)-1;
         for($i=0;$i < $longitud;$i++) $key .= $pattern[mt_rand(0,$max)];
         return $key;
    }
/*
}
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {
        $empresa = Auth::user()->empresa_id;

        $data = DB::table('matriculas')
                ->leftJoin('empresas', 'matriculas.empresa_id', '=', 'empresas.id')
                ->leftJoin('temporadas', 'matriculas.temporada_id', '=', 'temporadas.id')
                ->leftJoin('grados', 'matriculas.grado_id', '=', 'grados.id')
                ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')
                ->leftJoin('catalogos', 'alumnos.tipo_id', '=', 'catalogos.id')
                ->leftJoin('paralelos', 'matriculas.paralelo_id', '=', 'paralelos.id')
                ->leftJoin('catalogos AS c2', 'matriculas.jornada_id', '=', 'c2.id')
                ->select(
                        'matriculas.id',
                        'matriculas.status',
                        'empresas.nombre AS nomcolegio',
                        'temporadas.nombre AS nom_temporada',
                        'grados.nombre AS nom_grado',
                        DB::raw('CONCAT(alumnos.nombre1, " ", alumnos.apellido1) AS nom_alumno'),
                        'alumnos.n_documento',
                        'catalogos.nombre AS tipodoc',
                        'paralelos.nombre AS nom_paralelo',
                        'c2.nombre AS nom_jornada',
                        DB::raw('(CASE WHEN matriculas.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
                ->where('matriculas.empresa_id', $empresa)
                ->where('matriculas.status', '<>', 3 )
                ->orderByRaw('matriculas.id ASC')
                ->get();        

        $temporadas = DB::table('temporadas')
                  ->select('id', 'nombre')
                  ->where('empresa_id', $empresa)
                  ->where('status', 1)
                  ->orderByRaw('id ASC')
                  ->get();

        $grados = DB::table('grados')
                  ->select('id', 'nombre')
                  ->where('empresa_id', $empresa)
                  ->orderByRaw('nombre ASC')
                  ->get();

        $titulo = 'Matriculas';

        return view('matriculas.index', compact('data', 'titulo', 'temporadas', 'grados'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $titulo = 'Matriculas';

        $empresa = Auth::user()->empresa_id;

        $temporadas = DB::table('temporadas')
                  ->select('id', 'nombre')
                  ->where('empresa_id', $empresa)
                  ->where('status', 1)
                  ->orderByRaw('id ASC')
                  ->get();

        $grados = DB::table('grados')
                  ->select('id', 'nombre')
                  ->where('empresa_id', $empresa)
                  ->orderByRaw('id ASC')
                  ->get();

        $paralelos = DB::table('paralelos')
                    ->select('id', 'nombre')
                    ->where('empresa_id', $empresa )
                    ->where('grado_id', $grados[0]->id )
                    ->where('status', 1 )
                    ->orderByRaw('nombre ASC')
                    ->get();

        $tipo_docs = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 2 )->orderByRaw('nombre ASC')->get();
        $generos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 4 )->orderByRaw('nombre ASC')->get();
        $grupos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 13 )->orderByRaw('nombre ASC')->get();
        $zonas = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 15 )->orderByRaw('nombre ASC')->get();
        $estratos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 10 )->orderByRaw('nombre ASC')->get();
        $tipo_casas = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 14 )->orderByRaw('nombre ASC')->get();
        $jornadas = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 8 )->orderByRaw('nombre ASC')->get();
        $nee = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('nombre', 18 )->orderByRaw('nombre ASC')->get();
        $paises = DB::table('paises')->select('paises.*')->where('status', 1 )->get();
        $departamentos = DB::table('departamentos')->select('departamentos.*')->where('status', 1 )->get();
        
        $sedes = DB::table('empresas_sedes')
                  ->select('id', 'nombre')
                  ->where('empresa_id', $empresa)
                  ->orderByRaw('nombre ASC')
                  ->get();

        
        return view('matriculas.create', compact('titulo', 'temporadas', 'grados', 'paralelos', 'tipo_docs', 'generos', 'grupos', 'departamentos', 'zonas', 'estratos', 'tipo_casas', 'jornadas', 'paises', 'sedes','empresa', 'nee'));
    }


/*
|--------------------------------------------------------------------------
| store
|--------------------------------------------------------------------------
|
*/
    public function store(Request $request)
    {

        $validacion = DB::table('alumnos')
                      ->select('id')
                      ->where('empresa_id', Auth::user()->empresa_id)
                      ->where('temporada_id', $request->input('temporada_id'))
                      ->where('n_documento', $request->input('n_documento'))
                      ->where('status', 1)
                      ->count();

        if ($validacion != 0) {
            return back()->with('danger', 'El alumno ya se encuentra registrado en el periodo y grado ingresados');
        }
        
        $alumno = new Alumnos();
        $alumno->empresa_id = Auth::user()->empresa_id;
        $alumno->temporada_id = $request->input('temporada_id');
        $alumno->nombre1 = $request->input('nombre1');
        $alumno->nombre2 = $request->input('nombre2');
        $alumno->apellido1 = $request->input('apellido1');
        $alumno->apellido2 = $request->input('apellido2');
        $alumno->tipo_id = $request->input('tipo_id');
        $alumno->n_documento = $request->input('n_documento');
        $alumno->exp_fecha = $request->input('exp_fecha');        
        $alumno->pais_exp = $request->input('pais_exp');        
        $alumno->departamento_exp = $request->input('departamento_exp');        
        $alumno->ciudad_exp = $request->input('ciudad_exp');
        $alumno->pais_origen = $request->input('pais_origen');
        $alumno->departamento_origen = $request->input('departamento_origen');
        $alumno->ciudad_origen = $request->input('ciudad_origen');
        $alumno->sangre_id = $request->input('sangre_id');
        $alumno->genero_id = $request->input('genero_id');
        $alumno->edad = $request->input('edad');
        $alumno->fecha_nacimiento = $request->input('fecha_nacimiento');
        $alumno->user_create = Auth::id();
        $alumno->save();

        $alumno_id = $alumno->id;

        $padre = new Padres();
        $padre->empresa_id = Auth::user()->empresa_id;
        $padre->temporada_id = $request->input('temporada_id');
        $padre->tipo_familiar = $request->input('tipo_familiar_p');
        $padre->alumno_id = $alumno_id;
        $padre->nombres = $request->input('nombres_p');
        $padre->apellidos = $request->input('apellidos_p');
        $padre->tipo_doc_id = $request->input('tipo_doc_p');
        $padre->n_documento = $request->input('n_documento_p');
        $padre->exp_municipio = $request->input('exp_municipio_p');
        $padre->direccion = $request->input('direccion_p');
        $padre->telefono = $request->input('telefono_p');
        $padre->celular = $request->input('celular_p');
        $padre->email = $request->input('email_p');
        $padre->profesion = $request->input('profesion_p');
        $padre->nivel_educativo = $request->input('nivel_edu_p');
        $padre->empr_nombre = $request->input('empresa_p');
        $padre->empr_ocupacion = $request->input('ocupacion_p');
        $padre->empr_direccion = $request->input('direccion_p');
        $padre->empr_telefono = $request->input('telefono_p');
        $padre->empr_email = $request->input('email_p');
        $padre->user_create = Auth::id();
        $padre->save();

        $madre = new Padres();
        $madre->empresa_id = Auth::user()->empresa_id;
        $madre->temporada_id = $request->input('temporada_id');
        $madre->tipo_familiar = $request->input('tipo_familiar_m');
        $madre->alumno_id = $alumno_id;
        $madre->nombres = $request->input('nombres_m');
        $madre->apellidos = $request->input('apellidos_m');
        $madre->tipo_doc_id = $request->input('tipo_doc_m');
        $madre->n_documento = $request->input('n_documento_m');
        $madre->exp_municipio = $request->input('exp_municipio_m');
        $madre->direccion = $request->input('direccion_m');
        $madre->telefono = $request->input('telefono_m');
        $madre->celular = $request->input('celular_m');
        $madre->email = $request->input('email_m');
        $madre->profesion = $request->input('profesion_m');
        $madre->nivel_educativo = $request->input('nivel_edu_m');
        $madre->empr_nombre = $request->input('empresa_m');
        $madre->empr_ocupacion = $request->input('ocupacion_m');
        $madre->empr_direccion = $request->input('direccion_m');
        $madre->empr_telefono = $request->input('telefono_m');
        $madre->empr_email = $request->input('email_m');
        $madre->user_create = Auth::id();
        $madre->save();

        $request['empresa_id'] = Auth::user()->empresa_id;
        $request['alumno_id'] = $alumno_id;
        $request['tipo_doc_id'] = $request->input('tipo_doc_acu_id');
        $request['telefono_est'] = $request->input('celular_est');
        $request['user_create'] = Auth::id(); 

        
        $data = Matriculas::create($request->all());


        //return redirect ('admin/matriculas');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $titulo = 'Matriculas'; 

        $empresa = Auth::user()->empresa_id;
        
        $validador = DB::table('matriculas')
                  ->select('id')
                  ->where('id', $id)
                  ->where('empresa_id', $empresa)
                  ->count();
        
        if($validador == 0){
            return back()->with('danger', 'No tiene privilegios para ver la información');
        }
        

        $matricula = Matriculas::find($id);
        $alumno_id = $matricula->alumno_id;
        $alumno = Alumnos::where('id', $matricula->alumno_id)->firstOrFail();
        $padre = Padres::where('alumno_id', $matricula->alumno_id)->where('tipo_familiar', 1)->firstOrFail();
        $madre = Padres::where('alumno_id', $matricula->alumno_id)->where('tipo_familiar', 2)->firstOrFail();
        

        $temporadas = DB::table('temporadas')
                  ->select('id', 'nombre')
                  ->where('empresa_id', $empresa)
                  ->where('status', 1)
                  ->orderByRaw('id ASC')
                  ->get();

        $grados = DB::table('grados')
                  ->select('id', 'nombre')
                  ->where('empresa_id', $empresa)
                  ->orderByRaw('id ASC')
                  ->get();

        $paralelos = DB::table('paralelos')
                    ->select('id', 'nombre')
                    ->where('empresa_id', $empresa )
                    ->where('grado_id', $grados[0]->id )
                    ->where('status', 1 )
                    ->orderByRaw('nombre ASC')
                    ->get();

        $tipo_docs = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 2 )->orderByRaw('nombre ASC')->get();
        $generos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 4 )->orderByRaw('nombre ASC')->get();
        $grupos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 13 )->orderByRaw('nombre ASC')->get();
        $zonas = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 15 )->orderByRaw('nombre ASC')->get();
        $estratos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 10 )->orderByRaw('nombre ASC')->get();
        $tipo_casas = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 14 )->orderByRaw('nombre ASC')->get();
        $jornadas = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 8 )->orderByRaw('nombre ASC')->get();
        $nee = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 18 )->orderByRaw('nombre ASC')->get();
        $paises = DB::table('paises')->select('id', 'nombre')->where('status', 1 )->get();
        $departamentos = DB::table('departamentos')->select('id', 'nombre')->where('status', 1 )->get();
        $documentos = MatriculasDocumentos::where('matricula_id', $matricula->id)->get();

        $sedes = DB::table('empresas_sedes')
                  ->select('id', 'nombre')
                  ->where('empresa_id', $empresa)
                  ->orderByRaw('nombre ASC')
                  ->get();

        
        return view('matriculas.edit', compact('titulo', 'temporadas', 'grados', 'paralelos', 'tipo_docs', 'generos', 'grupos', 'departamentos', 'zonas', 'estratos', 'tipo_casas', 'jornadas', 'paises', 'matricula', 'alumno', 'padre', 'madre', 'sedes', 'empresa', 'nee', 'documentos'));

    }



/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {

        $dato = Matriculas::where('id', $id)->firstOrFail();

        $alumno = Alumnos::find($dato->alumno_id);
        $alumno->temporada_id = $request->input('temporada_id');
        $alumno->nombre1 = $request->input('nombre1');
        $alumno->nombre2 = $request->input('nombre2');
        $alumno->apellido1 = $request->input('apellido1');
        $alumno->apellido2 = $request->input('apellido2');
        $alumno->tipo_id = $request->input('tipo_id');
        $alumno->n_documento = $request->input('n_documento');
        $alumno->exp_fecha = $request->input('exp_fecha');        
        $alumno->pais_exp = $request->input('pais_exp');        
        $alumno->departamento_exp = $request->input('departamento_exp');        
        $alumno->ciudad_exp = $request->input('ciudad_exp');
        $alumno->pais_origen = $request->input('pais_origen');
        $alumno->departamento_origen = $request->input('departamento_origen');
        $alumno->ciudad_origen = $request->input('ciudad_origen');
        $alumno->sangre_id = $request->input('sangre_id');
        $alumno->genero_id = $request->input('genero_id');
        $alumno->edad = $request->input('edad');
        $alumno->fecha_nacimiento = $request->input('fecha_nacimiento');
        $alumno->user_update = Auth::id();
        $alumno->save();

        $dato2 = Padres::where('alumno_id', $dato->alumno_id)->where('tipo_familiar', '1')->firstOrFail();

        $padre = Padres::find($dato2->id);
        $padre->temporada_id = $request->input('temporada_id');
        $padre->tipo_familiar = $request->input('tipo_familiar_p');
        $padre->nombres = $request->input('nombres_p');
        $padre->apellidos = $request->input('apellidos_p');
        $padre->tipo_doc_id = $request->input('tipo_doc_p');
        $padre->n_documento = $request->input('n_documento_p');
        $padre->exp_municipio = $request->input('exp_municipio_p');
        $padre->direccion = $request->input('direccion_p');
        $padre->telefono = $request->input('telefono_p');
        $padre->celular = $request->input('celular_p');
        $padre->email = $request->input('email_p');
        $padre->profesion = $request->input('profesion_p');
        $padre->nivel_educativo = $request->input('nivel_edu_p');
        $padre->empr_nombre = $request->input('empresa_p');
        $padre->empr_ocupacion = $request->input('ocupacion_p');
        $padre->empr_direccion = $request->input('direccion_p');
        $padre->empr_telefono = $request->input('telefono_p');
        $padre->empr_email = $request->input('email_p');
        $padre->user_update = Auth::id();
        $padre->save();

        $dato3 = Padres::where('alumno_id', $dato->alumno_id)->where('tipo_familiar', '2')->firstOrFail();

        $madre = Padres::find($dato3->id);
        $madre->temporada_id = $request->input('temporada_id');
        $madre->tipo_familiar = $request->input('tipo_familiar_m');
        $madre->nombres = $request->input('nombres_m');
        $madre->apellidos = $request->input('apellidos_m');
        $madre->tipo_doc_id = $request->input('tipo_doc_m');
        $madre->n_documento = $request->input('n_documento_m');
        $madre->exp_municipio = $request->input('exp_municipio_m');
        $madre->direccion = $request->input('direccion_m');
        $madre->telefono = $request->input('telefono_m');
        $madre->celular = $request->input('celular_m');
        $madre->email = $request->input('email_m');
        $madre->profesion = $request->input('profesion_m');
        $madre->nivel_educativo = $request->input('nivel_edu_m');
        $madre->empr_nombre = $request->input('empresa_m');
        $madre->empr_ocupacion = $request->input('ocupacion_m');
        $madre->empr_direccion = $request->input('direccion_m');
        $madre->empr_telefono = $request->input('telefono_m');
        $madre->empr_email = $request->input('email_m');
        $madre->user_update = Auth::id();
        $madre->save();


        $request['user_update'] = Auth::id();
        $request['tipo_doc_id'] = $request->input('tipo_doc_acu_id');
        $request['telefono_est'] = $request->input('celular_est');
        $datos = Matriculas::find($id)->update($request->all());


        
        return redirect ('admin/matriculas');
    }



/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $alumno = DB::table('matriculas')->select('periodo_id','alumno_id')->where('id', $id )->first();

        $matriculas = DB::table('matriculas')
                    ->where('id', $id)
                    ->update(['status' => 3,
                            'user_update' => Auth::id()
                    ]);

        $alumnos = DB::table('alumnos')
                    ->where('temporada_id', $alumno->temporada_id)
                    ->where('id', $alumno->alumno_id)
                    ->update(['status' => 3,
                            'user_update' => Auth::id()
                    ]);

        $padres = DB::table('padres')
                    ->where('temporada_id', $alumno->temporada_id)
                    ->where('alumno_id', $alumno->alumno_id)
                    ->update(['status' => 3,
                            'user_update' => Auth::id()
                    ]);

  
        return redirect ('admin/matriculas')->with('eliminar', 'ok');
    }


/*
|--------------------------------------------------------------------------
| Activar publicación
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {
        
        $data = Matriculas::find($id);
        $data->status = 5;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/matriculas');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicación
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Matriculas::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/matriculas');
    }


/*
|--------------------------------------------------------------------------
| create Padre de familia
|--------------------------------------------------------------------------
|
*/

    public function create2($token)
    {
        /*Estados de matricula:
            1: activa
            2: inactiva
            3: eliminado
            4: notificado
            5: Matriculación exitosa padre*/


        $titulo = 'Matriculas';
        $hoy =  date("Y-m-d H:i:s");

        $colegio = DB::table('matriculas')
                    /*->select('empresa_id', 'grado_id', 'alumno_id', 'periodo_id')*/
                    ->where('token', $token )
                    ->where('fin_token', '>=', $hoy)
                    /*->where('status', 4 )*/
                    ->get();

        if (count($colegio) != 0) {
            
            $alumno = DB::table('alumnos')
                    /*->select('n_documento')*/
                    ->where('id', $colegio[0]->alumno_id )
                    ->where('status', 1)
                    ->first();
            
            $padre = DB::table('padres')
                    /*->select('n_documento')*/
                    ->where('alumno_id', $colegio[0]->alumno_id )
                    ->where('tipo_familiar', 1)
                    ->where('status', 1)
                    ->first();
                    
            $madre = DB::table('padres')
                    /*->select('n_documento')*/
                    ->where('alumno_id', $colegio[0]->alumno_id )
                    ->where('tipo_familiar', 2)
                    ->where('status', 1)
                    ->first();
                    
        }else{

            return redirect ('admin/notificaciones/inactivo');

        }
        
        
        $empresa_id = $colegio[0]->empresa_id;

        $periodos = DB::table('periodos_empresas')
                  ->leftJoin('periodos','periodos_empresas.periodo_id','periodos.id')
                  ->select('periodos.id', 'periodos.nombre')
                  ->where('periodos_empresas.empresa_id', $empresa_id)
                  ->where('periodos_empresas.status', 1)
                  ->orderByRaw('periodos_empresas.id ASC')
                  ->get();


        $grados = DB::table('grados_empresas')
                  ->leftJoin('grados','grados_empresas.grado_id','grados.id')
                  ->select('grados.id', 'grados.nombre')
                  ->where('grados_empresas.empresa_id', $empresa_id)
                  ->orderByRaw('grados_empresas.id ASC')
                  ->get();
        


       $paralelos = DB::table('paralelos')->select('id', 'nombre')
                    ->where('empresa_id', $empresa_id )
                    ->where('periodo_id', $colegio[0]->periodo_id )
                    ->where('grado_id', $colegio[0]->grado_id )
                    ->where('status', 1 )
                    ->orderByRaw('nombre ASC')
                    ->get();


        $tipo_docs = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('nombre', 2 )->orderByRaw('nombre ASC')->get();
        $generos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('nombre', 4 )->orderByRaw('nombre ASC')->get();
        $grupos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('nombre', 13 )->orderByRaw('nombre ASC')->get();
        $zonas = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('nombre', 15 )->orderByRaw('nombre ASC')->get();
        $estratos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('nombre', 10 )->orderByRaw('nombre ASC')->get();
        $tipo_casas = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('nombre', 14 )->orderByRaw('nombre ASC')->get();
        $jornadas = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('nombre', 8 )->orderByRaw('nombre ASC')->get();
        $nee = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('nombre', 18 )->orderByRaw('nombre ASC')->get();
        $paises = DB::table('paises')->select('paises.*')->where('status', 1 )->get();
        $departamentos = DB::table('departamentos')->select('departamentos.*')->where('status', 1 )->get();
        $nom_colegio = DB::table('empresas')->select('nombre', 'imagen', 'pagos')->where('id', $empresa_id )->first();
        
        $sedes = DB::table('empresas_sedes')
                  ->select('id', 'nombre')
                  ->where('empresa_id', $empresa_id)
                  ->orderByRaw('nombre ASC')
                  ->get();

        
        return view('registro.create', compact('titulo', 'periodos', 'grados', 'paralelos', 'tipo_docs', 'generos', 'grupos', 'departamentos', 'zonas', 'estratos', 'tipo_casas', 'jornadas', 'paises', 'sedes', 'token', 'colegio', 'alumno', 'nom_colegio', 'nee', 'padre', 'madre'));
        
    }


/*
|--------------------------------------------------------------------------
| store del padre de familia-> el que se hace con Token
|--------------------------------------------------------------------------
|
*/
    public function store2(Request $request, $token)
    {
        //$fechainicio = date("Y-m-d", strtotime($fechainicio));
        //$fechainicio = date("Y-m-d", strtotime($fechainicio));

        $info = DB::table('matriculas')->select('id','alumno_id')->where('token', $token)->where('status', 4)->get();   

        if (count($info) != 1) {
            return back();
        }

        //dd($alumno[0]->id);

        $alumno = Alumnos::find($info[0]->alumno_id);
        $alumno->nombre1 = $request->input('nombre1');
        $alumno->nombre2 = $request->input('nombre2');
        $alumno->apellido1 = $request->input('apellido1');
        $alumno->apellido2 = $request->input('apellido2');
        $alumno->tipo_id = $request->input('tipo_id');
        $alumno->exp_municipio = $request->input('exp_municipio');
        $alumno->exp_depto = $request->input('exp_depto');
        $alumno->exp_fecha = $request->input('exp_fecha');
        $alumno->pais_id = $request->input('pais_id');        
        $alumno->departamento_id = $request->input('departamento_id');
        $alumno->ciudad_id = $request->input('ciudad_id');
        $alumno->sangre_id = $request->input('sangre_id');
        $alumno->genero_id = $request->input('genero_id');
        $alumno->edad = $request->input('edad');
        $alumno->fecha_nacimiento = $request->input('fecha_nacimiento');
        $alumno->save();

        $padre = DB::table('padres')
            ->where('alumno_id', $info[0]->alumno_id)
            ->where('tipo_familiar', 1)
            ->update(['nombres' => $request->input('nombres_p'),
                    'apellidos' => $request->input('apellidos_p'),
                    'tipo_doc_id' => $request->input('tipo_doc_p'),
                    'n_documento' => $request->input('n_documento_p'),
                    'exp_municipio' => $request->input('exp_municipio_p'),
                    'direccion' => $request->input('direccion_p'),
                    'telefono' => $request->input('telefono_p'),
                    'celular' => $request->input('celular_p'),
                    'email' => $request->input('email_p'),
                    'profesion' => $request->input('profesion_p'),
                    'nivel_educativo' => $request->input('nivel_edu_p'),
                    'empr_nombre' => $request->input('empresa_p'),
                    'empr_ocupacion' => $request->input('ocupacion_p'),
                    'empr_direccion' => $request->input('direccion_p'),
                    'empr_telefono' => $request->input('telefono_p'),
                    'empr_email' => $request->input('email_p'),
            ]);

        $madre = DB::table('padres')
            ->where('alumno_id', $info[0]->alumno_id)
            ->where('tipo_familiar', 2)
            ->update(['nombres' => $request->input('nombres_m'),
                    'apellidos' => $request->input('apellidos_m'),
                    'tipo_doc_id' => $request->input('tipo_doc_m'),
                    'n_documento' => $request->input('n_documento_m'),
                    'exp_municipio' => $request->input('exp_municipio_m'),
                    'direccion' => $request->input('direccion_m'),
                    'telefono' => $request->input('telefono_m'),
                    'celular' => $request->input('celular_m'),
                    'email' => $request->input('email_m'),
                    'profesion' => $request->input('profesion_m'),
                    'nivel_educativo' => $request->input('nivel_edu_m'),
                    'empr_nombre' => $request->input('empresa_m'),
                    'empr_ocupacion' => $request->input('ocupacion_m'),
                    'empr_direccion' => $request->input('direccion_m'),
                    'empr_telefono' => $request->input('telefono_m'),
                    'empr_email' => $request->input('email_m'),
            ]);


        $matricula = Matriculas::find($info[0]->id);
        $matricula->sede_id = $request->input('sede_id');
        $matricula->paralelo_id = $request->input('paralelo_id');
        $matricula->direccion_r = $request->input('direccion_r');
        $matricula->barrio_r = $request->input('barrio_r');
        $matricula->comuna_r = $request->input('comuna_r');
        $matricula->municipio_r = $request->input('municipio_r');
        $matricula->departamento_id = $request->input('departamento_id');
        $matricula->estrato_id = $request->input('estrato_id');
        $matricula->tipo_vivienda_id = $request->input('tipo_vivienda_id');
        $matricula->zona_id = $request->input('zona_id');
        $matricula->telefono_est = $request->input('celular_est');
        $matricula->celular_est = $request->input('celular_est');
        $matricula->email_est = $request->input('email_est');
        $matricula->vive_con = $request->input('vive_con');
        $matricula->n_personas_hogar = $request->input('n_personas_hogar');
        $matricula->n_hermanos = $request->input('n_hermanos');
        $matricula->n_hermanos_col = $request->input('n_hermanos_col');
        $matricula->telefono_f = $request->input('telefono_f');
        $matricula->icbf = $request->input('icbf');
        $matricula->f_accion = $request->input('f_accion');
        $matricula->nee_id = $request->input('nee_id');
        $matricula->nee_texto = $request->input('nee_texto');
        $matricula->nuevo_antiguo = $request->input('nuevo_antiguo');
        $matricula->col_procede = $request->input('col_procede');
        $matricula->ciudad_procede = $request->input('ciudad_procede');
        $matricula->dpto_id = $request->input('dpto_id');
        $matricula->repitente = $request->input('repitente');
        $matricula->jornada_id = $request->input('jornada_id');
        $matricula->estatura = $request->input('estatura');
        $matricula->peso = $request->input('peso');
        $matricula->talla_cam = $request->input('talla_cam');
        $matricula->talla_pan = $request->input('talla_pan');
        $matricula->hijo_heroe = $request->input('hijo_heroe');
        $matricula->desvinculado = $request->input('desvinculado');
        $matricula->desmovilizado = $request->input('desmovilizado');
        $matricula->nombres_acu = $request->input('nombres_acu');
        $matricula->apellidos_acu = $request->input('apellidos_acu');
        $matricula->tipo_doc_id = $request->input('tipo_doc_acu_id');
        $matricula->n_documento_acu = $request->input('n_documento_acu');
        $matricula->expedida_acu = $request->input('expedida_acu');
        $matricula->direccion_acu = $request->input('direccion_acu');
        $matricula->telefono_acu = $request->input('telefono_acu');
        $matricula->celular_acu = $request->input('celular_acu');
        $matricula->email_acu = $request->input('email_acu');
        $matricula->empresa_acu = $request->input('empresa_acu');
        $matricula->profesion_acu = $request->input('profesion_acu');
        $matricula->parentesco_acu = $request->input('parentesco_acu');
        $matricula->nombre_eps = $request->input('nombre_eps');
        $matricula->beneficiario_sisben = $request->input('beneficiario_sisben');
        $matricula->alergias = $request->input('alergias');
        $matricula->medicamentos = $request->input('medicamentos');
        $matricula->discapacidad = $request->input('discapacidad');
        $matricula->etnia = $request->input('etnia');
        $matricula->resguardo = $request->input('resguardo');
        $matricula->conflicto = $request->input('conflicto');
        $matricula->nombres_fac = $request->input('nombres_fac');
        $matricula->tipo_doc_fac_id = $request->input('tipo_doc_fac_id');
        $matricula->n_documento_fac = $request->input('n_documento_fac');
        $matricula->direccion_fac = $request->input('direccion_fac');
        $matricula->email_fac = $request->input('email_fac');
        $matricula->celular_fac = $request->input('celular_fac');
        $matricula->save(); 

        $estado = DB::table('matriculas')
            ->where('id', $info[0]->id)
            ->update(['status' => '5']);

        return ('Exitoso');


        //return redirect ('admin/matriculas');
    }

/*
|--------------------------------------------------------------------------
| Matricula ligera, es decir, la que se realiza por medio de la modal
|--------------------------------------------------------------------------
|
*/
    public function store3(Request $request)
    {
        //Se valida si el request viene de formulario o de la automatización de masivos
        if($request->input('empresa_id'))
        {
            $empresa_id = $request->input('empresa_id');
        }else
        {
            $empresa_id = Auth::user()->empresa_id;
        }
        
        
        //Valida que exista la plantilla para el email
        $template = DB::table('emails')
                  ->select('id')                  
                  ->where('empresa_id', $empresa_id)
                  ->where('periodo_id', $request->input('periodo_id'))
                  ->where('grado_id', $request->input('grado_id'))
                  ->count(); 

        if ($template == 0) {
            return back()->with('danger', 'No existe plantilla de Email para el curso seleccionado');
        }
        
        //Valida que el grado tenga documentos 
        $grados_doc = DB::table('grados_empresas')
                  ->select('id')
                  ->where('empresa_id',  $empresa_id)
                  ->where('grado_id', $request->input('grado_id'))
                  ->first();
                  
                  
        $documents = DB::table('grados_documentos')
                  ->select('id')              
                  ->where('grado_empresa_id', $grados_doc->id)
                  ->where('periodo_id', $request->input('periodo_id'))
                  ->count();
        

        if ($documents == 0) {
            return back()->with('danger', 'No existen documentos para el curso seleccionado');
        }


        //Validar que no exista ya en el mismo periodo
        $alumno = DB::table('alumnos')
                  ->select('id')                  
                  ->where('n_documento', $request->input('n_documento'))
                  ->where('status', 1)
                  ->get();

        if (count($alumno) == 0) {
            $alumno = new Alumnos();
            $alumno->tipo_id = 3;
            $alumno->empresa_id = $empresa_id;
            $alumno->periodo_id = $request->input('periodo_id');
            $alumno->n_documento = $request->input('n_documento');
            $alumno->user_create = Auth::id();
            $alumno->save();

            $alumno_id = $alumno->id;

            $padre = new Padres();
            $padre->empresa_id = $empresa_id;
            $padre->periodo_id = $request->input('periodo_id');
            $padre->tipo_familiar = 1;
            $padre->alumno_id = $alumno_id;
            $padre->tipo_doc_id = 2;
            $padre->user_create = Auth::id();
            $padre->save();

            $madre = new Padres();
            $madre->empresa_id = $empresa_id;
            $madre->periodo_id = $request->input('periodo_id');
            $madre->tipo_familiar = 2;
            $madre->alumno_id = $alumno_id;
            $madre->tipo_doc_id = 2;
            $madre->user_create = Auth::id();
            $madre->save();

            $id_alumno = $alumno->id;
        }else{
            $id_alumno = $alumno[0]->id;
        }

        $existente = DB::table('matriculas')
                  ->select('id')                  
                  ->where('empresa_id', $empresa_id)
                  //->where('grado_id', $request->input('grado_id'))
                  ->where('periodo_id', $request->input('periodo_id'))
                  ->where('alumno_id', $id_alumno)
                  ->where('status', 1)
                  ->count();

        if ($existente > 0) {
           return back()->with('danger', 'El alumno ya se encuentra matriculado en el periodo seleccionado');
        }

        /*$alumno = new Alumnos();
        $alumno->n_documento = $request->input('n_documento');
        $alumno->user_create = Auth::id();
        $alumno->save();

        $id_alumno = $alumno->id;*/

        $hoy =  date("Y-m-d H:i:s");
        $min = 28800; // 20 dias
        $minutos = '+'.$min.'minutes';
        $fin_token = date('Y-m-d H:i:s', strtotime($minutos , strtotime ( $hoy ))); 
        $token = $this->generarCodigo(6);

        $matricula = new Matriculas();
        $matricula->empresa_id = $empresa_id;
        $matricula->grado_id = $request->input('grado_id');
        $matricula->periodo_id = $request->input('periodo_id');
        $matricula->alumno_id = $id_alumno;
        $matricula->token = $token;        
        $matricula->fin_token = $fin_token;        
        $matricula->status = 4; // 4: Matricula parcial, notificado al responsable       
        $matricula->user_create = Auth::id();
        $matricula->save();

        //Información para la notificación vía mail

        $documentos = DB::table('grados_documentos')
                  ->select('nombre', 'archivo', 'status')                  
                  ->where('grado_empresa_id', $grados_doc->id)
                  ->where('periodo_id', $request->input('periodo_id'))
                  ->where('status', 1)
                  ->orderByRaw('grados_documentos.nombre ASC')
                  ->get();
                  

        $colegio = DB::table('empresas')
                  ->select('nombre', 'direccion','telefono', 'email')
                  ->where('id',  Auth::user()->empresa_id)
                  ->first();

        $email = DB::table('emails')
                  ->select('emails.asunto', 'emails.mensaje')  
                  ->where('emails.empresa_id', $empresa_id)
                  ->where('emails.periodo_id', $request->input('periodo_id'))
                  ->where('emails.grado_id', $request->input('grado_id'))
                  ->first();

        $data = array(        
                'destinatario' =>  $request->input('email'),
                'token' => $token, 
                'asunto' => $email->asunto
            );
     
        
       \Mail::send('emails/not_matricula_padre', compact('data', 'documentos', 'colegio', 'email'), function($message)use ($data){
            $message->from('notificaciones@gidesco.com', 'Sistema de notificaciones GIDESCO');
            $message->to($data['destinatario'])->cc(['davidcontreras07@gmail.com'])->subject($data['asunto']);

        }); 

        return back()->with('success', 'Alumno matriculado parcialmente y notificado el responsable');
    }


/*
|--------------------------------------------------------------------------
| create Padre de familia
|--------------------------------------------------------------------------
|
*/

    public function documentos($token)
    {
        /*Estados de matricula:
            1: activa
            2: inactiva
            3: eliminado
            4: notificado
            5: Registro exitoso de la matricula
            6: Cargo documentos*/


        $titulo = 'Matriculas';
        $hoy =  date("Y-m-d H:i:s");

        $colegio = DB::table('matriculas')
                    ->select('id','empresa_id', 'grado_id', 'alumno_id')
                    ->where('token', $token )
                    ->where('fin_token', '>=', $hoy)
                    ->where('status', 5 )
                    ->get();


        if (count($colegio) == 0) {
            
            return redirect ('admin/notificaciones/inactivo');
        }     


        $empresa_id = $colegio[0]->empresa_id;

        $data = DB::table('matriculas_documentos')
                  ->where('matricula_id',  $colegio[0]->id)
                  ->get();

        $nom_colegio = DB::table('empresas')->select('nombre', 'imagen', 'pagos')->where('id', $empresa_id )->first();

        
        return view('registro.documentos', compact('titulo', 'colegio', 'data', 'token', 'nom_colegio'));
    }


/*
|--------------------------------------------------------------------------
| store de los documentos cargados por el padre de familia
|--------------------------------------------------------------------------
|
*/
    public function doc_store(Request $request, $token)
    {

        $info = DB::table('matriculas')->select('id','alumno_id')->where('token', $token)->where('status', 5)->get();   

        if (count($info) != 1) {
            return back();
        }

        //dd($alumno[0]->id);

        $documento = new MatriculasDocumentos();
        $documento->matricula_id = $info[0]->id;
        $documento->nombre = $request->input('nombre');
        $documento->save();

        $path = Storage::disk('public')->put('media/documentos',$request->file('archivo'));
        $documento->fill(['archivo'=>asset($path)])->save();       

        /*$estado = DB::table('matriculas')
            ->where('id', $info[0]->id)
            ->update(['status' => '6']);*/

        return back()->with('success', 'Documento cargado exitosamente');


        //return redirect ('admin/matriculas');
    }


/*
}
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function reporte()
    {
        $data = DB::table('matriculas')
                ->leftJoin('empresas', 'matriculas.empresa_id', '=', 'empresas.id')
                ->leftJoin('temporadas', 'matriculas.temporada_id', '=', 'temporadas.id')
                ->leftJoin('grados', 'matriculas.grado_id', '=', 'grados.id')
                ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')
                ->leftJoin('empresas_sedes', 'matriculas.sede_id', '=', 'empresas_sedes.id')
                ->leftJoin('paralelos', 'matriculas.paralelo_id', '=', 'paralelos.id')
                ->leftJoin('departamentos', 'matriculas.departamento_id', '=', 'departamentos.id')
                ->leftJoin('departamentos AS d1', 'matriculas.dpto_id', '=', 'd1.id')
                ->leftJoin('catalogos AS c5', 'matriculas.estrato_id', '=', 'c5.id')
                ->leftJoin('catalogos AS c6', 'matriculas.tipo_vivienda_id', '=', 'c6.id')
                ->leftJoin('catalogos AS c7', 'matriculas.zona_id', '=', 'c7.id')
                ->leftJoin('catalogos AS c8', 'matriculas.jornada_id', '=', 'c8.id')
                ->leftJoin('catalogos AS c9', 'matriculas.tipo_doc_id', '=', 'c9.id')
                ->leftJoin('departamentos AS d3', 'alumnos.departamento_id', '=', 'd3.id')
                ->leftJoin('paises', 'alumnos.pais_id', '=', 'paises.id')
                ->leftJoin('departamentos AS d2', 'alumnos.exp_depto', '=', 'd2.id')
                ->leftJoin('catalogos', 'alumnos.tipo_id', '=', 'catalogos.id')
                ->leftJoin('catalogos AS c1', 'alumnos.sangre_id', '=', 'c1.id')
                ->leftJoin('catalogos AS c2', 'alumnos.genero_id', '=', 'c2.id')
                ->leftJoin('catalogos AS c3', 'alumnos.tipo_id', '=', 'c3.id')
                ->leftJoin('catalogos AS c4', 'matriculas.nee_id', '=', 'c4.id')

                ->leftJoin('padres', function ($join) {
                        $join->on('matriculas.alumno_id', '=', 'padres.alumno_id')
                             ->where('padres.tipo_familiar', 1);
                    })

                ->leftJoin('catalogos AS c10', 'padres.tipo_doc_id', '=', 'c10.id')

                ->leftJoin('padres AS madre', function ($join) {
                        $join->on('matriculas.alumno_id', '=', 'madre.alumno_id')
                             ->where('madre.tipo_familiar', 2);
                    })

                ->leftJoin('catalogos AS c11', function ($join) {
                        $join->on('madre.tipo_doc_id', '=', 'c11.id')
                             ->where('madre.tipo_familiar', 2);
                    })

                ->select(
                        'departamentos.nombre AS r_dpto',
                        'empresas.nombre AS nomcolegio',
                        'temporadas.nombre AS nomperiodo',
                        'grados.nombre AS nomgrado',
                        'empresas_sedes.nombre AS nomsede',
                        'paralelos.nombre AS nom_paralelo',
                        'c5.nombre AS nom_estrato',
                        'c6.nombre AS nom_tipo_vivienda',
                        'c7.nombre AS nom_zona',
                        'matriculas.alumno_id',
                        'matriculas.direccion_r',
                        'matriculas.barrio_r',
                        'matriculas.comuna_r',
                        'matriculas.municipio_r',
                        'matriculas.telefono_est',
                        'matriculas.celular_est',
                        'matriculas.email_est',
                        'matriculas.vive_con',
                        'matriculas.n_personas_hogar',
                        'matriculas.n_hermanos',
                        'matriculas.n_hermanos_col',
                        'matriculas.icbf',
                        'matriculas.f_accion',
                        'c4.nombre AS nee_texto',
                        'matriculas.nuevo_antiguo',
                        'matriculas.col_procede',
                        'matriculas.ciudad_procede',
                        'd1.nombre AS dpto_procede',
                        'matriculas.repitente',
                        'c8.nombre AS nom_jornada',
                        'matriculas.estatura',
                        'matriculas.peso',
                        'matriculas.hijo_heroe',
                        'matriculas.desvinculado',
                        'matriculas.desmovilizado',
                        'matriculas.nombres_acu',
                        'matriculas.apellidos_acu',
                        'matriculas.apellidos_acu',
                        'c9.nombre AS tipo_doc_acu',
                        'matriculas.n_documento_acu',
                        'matriculas.expedida_acu',
                        'matriculas.direccion_acu',
                        'matriculas.telefono_acu',
                        'matriculas.celular_acu',
                        'matriculas.email_acu',
                        'matriculas.empresa_acu',
                        'matriculas.profesion_acu',
                        'matriculas.parentesco_acu',
                        'matriculas.nombre_eps',
                        'matriculas.beneficiario_sisben',
                        'matriculas.alergias',
                        'matriculas.medicamentos',
                        'matriculas.discapacidad',
                        'matriculas.etnia',
                        'matriculas.resguardo',
                        'matriculas.conflicto',
                        'matriculas.telefono_f',
                        'alumnos.*',
                        'catalogos.nombre AS tipodoc',
                        'c1.nombre AS tipo_sangre',
                        'c2.nombre AS tipo_genero',
                        'c3.nombre AS tipo_doc_alumno',
                        'd2.nombre AS exp_dpto',
                        'paises.nombre AS pais_nac',
                        'd3.nombre AS dpto_nac',
                        'padres.nombres AS nom_padre',
                        'padres.apellidos AS ape_padre',
                        'padres.tipo_doc_id AS td_padre',
                        'padres.n_documento AS doc_padre',
                        'padres.exp_municipio AS exp_padre',
                        'padres.direccion AS dir_padre',
                        'padres.telefono AS tel_padre',
                        'padres.celular AS cel_padre',
                        'padres.email AS email_padre',
                        'padres.profesion AS prof_padre',
                        'padres.nivel_educativo AS nive_padre',
                        'padres.empr_nombre AS empr_padre',
                        'padres.empr_ocupacion AS ocu_padre',
                        'padres.empr_direccion AS dir_emp_padre',
                        'padres.empr_telefono AS tel_emp_padre',
                        'padres.empr_email AS email_emp_padre',
                        'c10.nombre AS tipo_doc_padre',
                        'madre.nombres AS nom_madre',
                        'madre.apellidos AS ape_madre',
                        'madre.tipo_doc_id AS td_madre',
                        'madre.n_documento AS doc_madre',
                        'madre.exp_municipio AS exp_madre',
                        'madre.direccion AS dir_madre',
                        'madre.telefono AS tel_madre',
                        'madre.celular AS cel_madre',
                        'madre.email AS email_madre',
                        'madre.profesion AS prof_madre',
                        'madre.nivel_educativo AS nive_madre',
                        'madre.empr_nombre AS empr_madre',
                        'madre.empr_ocupacion AS ocu_madre',
                        'madre.empr_direccion AS dir_emp_madre',
                        'madre.empr_telefono AS tel_emp_madre',
                        'madre.empr_email AS email_emp_madre',
                        'c11.nombre AS tipo_doc_madre'
                    )
                ->where('matriculas.empresa_id', Auth::user()->empresa_id )
                ->where('matriculas.status', '<>', 3 )
                ->orderByRaw('matriculas.id ASC')
                ->get();

        $colegio = Auth::user()->empresa_id;
        $titulo = 'Matriculas';

        return view('matriculas.reporte', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| valida si el alumno antes de ser creado por la instición
|--------------------------------------------------------------------------
|
*/
    public function validar(Request $request)
    {

        //Se valida si ya existe para indicar si se crea o se edita

        $alumno = DB::table('alumnos')
                      ->select('id')
                      ->where('empresa_id', Auth::user()->empresa_id)
                      ->where('temporada_id', $request->input('temporada_id'))
                      ->where('n_documento', $request->input('n_documento'))
                      ->where('status', 1)
                      ->count();

        /*$validacion = DB::table('matriculas')
                      ->select('id')
                      ->where('empresa_id', Auth::user()->empresa_id)
                      ->where('periodo_id', $request->input('periodo_id'))
                      ->where('grado_id', $request->input('grado_id'))
                      ->where('n_documento', $request->input('n_documento'))
                      ->orderByRaw('grados_empresas.id ASC')
                      ->count();*/

        if ($alumno != 0) {
            return back()->with('danger', 'El alumno ya se encuentra registrado en el periodo y grado ingresados');
        }else{
            return redirect ('admin/matriculas/create');
        }
    }


  /*
|--------------------------------------------------------------------------
| API paralelos por grados
|--------------------------------------------------------------------------
|
*/
    public function paralelos($empresa_id, $tipo_colegio, $periodo_id, $grado_id)
    {

      if ($tipo_colegio == 'cm') 
      { 
        
        $alumno = DB::table('paralelos')
                      ->select('id', 'nombre')
                      ->where('empresa_id', $empresa_id) 
                      ->where('periodo_id', $periodo_id)
                      ->where('grado_id', $grado_id)
                      ->where('status', 1)
                      ->get();

        if (count($alumno) != 0) {
            return $alumno;
        }else{
            return 0;
        }
      }
      elseif ($tipo_colegio == 'sm') 
      {
        $alumno = DB::table('estudiantes')
                        ->leftJoin('catalogos', 'estudiantes.paralelo_id', '=', 'catalogos.id')
                        ->select('catalogos.id','catalogos.nombre as nombre')                       
                        ->where('estudiantes.empresa_id', $empresa_id)
                        ->where('estudiantes.periodo_id', $periodo_id)
                        ->where('estudiantes.grado_id', $grado_id)
                        ->groupBy('catalogos.id','catalogos.nombre')
                        ->orderByRaw('catalogos.id ASC')
                        ->get();
        if (count($alumno) != 0) {
            return $alumno;
        }else{
            return 0;
        }
      }
        

        
    }
    
/*
}
|--------------------------------------------------------------------------
| Ampliar en 5 días el tiempo del token para cargar la información de matricula por parte del padre
|--------------------------------------------------------------------------
|
*/

    public function ampliar($id)
    {
        
        $fecha =  date("Y-m-d");

        $min = 7200; //5 días
        $minutos = '+'.$min.'minutes';
        $segundia = date('Y-m-d', strtotime($minutos , strtotime ( $fecha ))); 
        
        $alumno = Matriculas::find($id);
        $alumno->fin_token = $segundia;
        $alumno->save();

        return redirect ('admin/matriculas')->with('success', 'Se ha ampliado la fecha de matricula hasta: '.$segundia);
    }
    

/*
|--------------------------------------------------------------------------
| Alumnos por condicionales API
|--------------------------------------------------------------------------
|
*/
    public function alumnos($colegio,  $tipo_colegio, $periodo, $grado, $paralelo)
    {
    
        if ($tipo_colegio == 'cm') 
        {
          $alumnos = DB::table('matriculas')    
                      ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')              
                      ->select('matriculas.alumno_id AS id', 
                                DB::raw('CONCAT(alumnos.apellido1, " ", alumnos.nombre1) AS nom_estudiante'))
                      ->where('matriculas.periodo_id', $periodo)
                      ->where('matriculas.empresa_id', $colegio)
                      ->where('matriculas.grado_id', $grado)
                      ->where('matriculas.paralelo_id', $paralelo)
                      ->where('matriculas.status', 5)
                      ->orderByRaw('alumnos.apellido1 ASC')
                      ->get();
    
          if (count($alumnos) != 0) {
              return $alumnos;
          }else{
              return 0;
          }
    
        }
        elseif($tipo_colegio == 'sm')
        {
          $alumnos = DB::table('estudiantes')                
                                  ->select('estudiantes.id', 
                                            DB::raw('CONCAT(estudiantes.apellidos, " ", estudiantes.nombres) AS nom_estudiante'))
                                  ->where('estudiantes.periodo_id', $periodo)
                                  ->where('estudiantes.empresa_id', $colegio)
                                  ->where('estudiantes.grado_id', $grado)
                                  ->where('estudiantes.paralelo_id', $paralelo)
                                  ->where('estudiantes.status', 1)
                                  ->orderByRaw('estudiantes.apellidos ASC')
                                  ->get();
    
          if (count($alumnos) != 0) {
              return $alumnos;
          }else{
              return 0;
          }
        }    
      }
      
/*
|--------------------------------------------------------------------------
| Visualiza la información del alumno para promoverlo
|--------------------------------------------------------------------------
|
*/

    public function promover($id)
    {
        $colegio = Auth::user()->empresa_id;
        $titulo = 'Estudiantes';
        
        $matricula = Matriculas::find($id);
        $alumno_id = $matricula->alumno_id;

        $alumno = DB::table('matriculas')
                ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')           
                ->leftJoin('catalogos', 'alumnos.sangre_id', '=', 'catalogos.id')           
                ->leftJoin('catalogos AS c2', 'alumnos.genero_id', '=', 'c2.id') 
                ->leftJoin('grados', 'matriculas.grado_id', '=', 'grados.id')   
                ->select(
                        'alumnos.*',
                        'catalogos.nombre AS sangre',
                        'c2.nombre AS genero',
                        DB::raw('CONCAT(matriculas.nombres_acu, " ", matriculas.apellidos_acu) AS nomacudiente'),
                        'matriculas.telefono_acu',
                        'matriculas.celular_acu',
                        'matriculas.email_acu',
                        'matriculas.parentesco_acu',
                        'matriculas.email_est', 
                        'grados.nombre AS nom_grado')
                ->where('matriculas.empresa_id', $colegio)
                ->where('matriculas.alumno_id', $alumno_id)
                ->first();
        
        $padre = Padres::where('alumno_id', $alumno->id)->where('tipo_familiar', 1)->firstOrFail();
        $madre = Padres::where('alumno_id', $alumno->id)->where('tipo_familiar', 2)->firstOrFail();
        
        $grados = DB::table('grados_empresas')
                  ->leftJoin('grados','grados_empresas.grado_id','grados.id')
                  ->select('grados.id', 'grados.nombre')
                  ->where('grados_empresas.empresa_id', $colegio)
                  ->orderByRaw('grados.nombre ASC')
                  ->get();
                  
        $periodos = DB::table('periodos_empresas')
                  ->leftJoin('periodos','periodos_empresas.periodo_id','periodos.id')
                  ->select('periodos.id', 'periodos.nombre')
                  ->where('periodos_empresas.empresa_id', $colegio)
                  ->where('periodos_empresas.status', 1)
                  ->orderByRaw('periodos_empresas.id ASC')
                  ->get();
       
        if ($alumno) {
            return view('matriculas.promover', compact('alumno', 'titulo', 'padre', 'madre', 'grados', 'id', 'periodos'));
        }else{
            return back()->with('danger', 'No tiene permiso para ver la informaci贸n');
        }
    }
    
/*
|--------------------------------------------------------------------------
| Guarda y notifica la promoción para matricular
|--------------------------------------------------------------------------
|
*/

    public function promover_store(Request $request)
    {
        
        //Valida si ya se ha promovido dentro del mismo año y grado
        //Si ya esta inscrito se retorna con un back indicando que ya esta matriculado
        //Si no esta matriculado se procede a copiar el registro actual y crear uno con los datos el año y curso futuro
        
        $buscar = DB::table('matriculas')
                  ->select('id')                  
                  ->where('empresa_id', Auth::user()->empresa_id)
                  ->where('periodo_id', $request->input('periodo_id'))
                  ->where('grado_id', $request->input('grado_id'))
                  ->count();
        
        
        //Valida que exista la plantilla para el email
        $template = DB::table('emails')
                  ->select('id')                  
                  ->where('empresa_id', Auth::user()->empresa_id)
                  ->where('periodo_id', $request->input('periodo_id'))
                  ->where('grado_id', $request->input('grado_id'))
                  ->count();

        if ($template == 0) {
            return back()->with('danger', 'No existe plantilla de Email para el curso seleccionado');
        }
        
        //Valida que el grado tenga documentos 
        $grados_doc = DB::table('grados_empresas')
                  ->select('id')
                  ->where('empresa_id',  Auth::user()->empresa_id)
                  ->where('grado_id', $request->input('grado_id'))
                  ->first();
                  
                  
        $documents = DB::table('grados_documentos')
                  ->select('id')              
                  ->where('grado_empresa_id', $grados_doc->id)
                  ->where('periodo_id', $request->input('periodo_id'))
                  ->count();
        

        if ($documents == 0) {
            return back()->with('danger', 'No existen documentos para el curso seleccionado');
        }
        
        //Validar que no exista ya en el mismo periodo
        $alumno = DB::table('alumnos')
                  ->select('id')                  
                  ->where('n_documento', $request->input('n_documento'))
                  ->where('status', 1)
                  ->get();

        if (count($alumno) == 0) {
            $alumno = new Alumnos();
            $alumno->tipo_id = 3;
            $alumno->empresa_id = Auth::user()->empresa_id;
            $alumno->periodo_id = $request->input('periodo_id');
            $alumno->n_documento = $request->input('n_documento');
            $alumno->user_create = Auth::id();
            $alumno->save();

            $alumno_id = $alumno->id;

            $padre = new Padres();
            $padre->empresa_id = Auth::user()->empresa_id;
            $padre->periodo_id = $request->input('periodo_id');
            $padre->tipo_familiar = 1;
            $padre->alumno_id = $alumno_id;
            $padre->tipo_doc_id = 2;
            $padre->user_create = Auth::id();
            $padre->save();

            $madre = new Padres();
            $madre->empresa_id = Auth::user()->empresa_id;
            $madre->periodo_id = $request->input('periodo_id');
            $madre->tipo_familiar = 2;
            $madre->alumno_id = $alumno_id;
            $madre->tipo_doc_id = 2;
            $madre->user_create = Auth::id();
            $madre->save();

            $id_alumno = $alumno->id;
        }else{
            $id_alumno = $alumno[0]->id;
        }

        $existente = DB::table('matriculas')
                  ->select('id')                  
                  ->where('empresa_id',  Auth::user()->empresa_id)
                  //->where('grado_id', $request->input('grado_id'))
                  ->where('periodo_id', $request->input('periodo_id'))
                  ->where('alumno_id', $id_alumno)
                  ->where('status', 1)
                  ->count();

        if ($existente > 0) {
           return back()->with('danger', 'El alumno ya se encuentra matriculado en el periodo seleccionado');
        }

        //Token para envio de correo electrónico
        $hoy =  date("Y-m-d H:i:s");
        $min = 28800; // 20 dias
        $minutos = '+'.$min.'minutes';
        $fin_token = date('Y-m-d H:i:s', strtotime($minutos , strtotime ( $hoy ))); 
        $token = $this->generarCodigo(6);
        
        
        //-----------------------------------------------
        //Se busca la matricula anterior para copiar con los datos nuevos: grado y periodo
        $dato = Matriculas::find($request->input('matricula_id'));
    
        $matricula = Matriculas::find($request->input('matricula_id'));
        $matricula->empresa_id = $dato->empresa_id;
        $matricula->periodo_id = $request->input('periodo_id');
        $matricula->grado_id = $request->input('grado_id');
        $matricula->paralelo_id = '';
        $matricula->alumno_id = $dato->alumno_id;
        $matricula->sede_id = $dato->sede_id;
        $matricula->paralelo_id = $dato->paralelo_id;
        $matricula->direccion_r = $dato->direccion_r;
        $matricula->barrio_r = $dato->barrio_r;
        $matricula->comuna_r = $dato->comuna_r;
        $matricula->municipio_r = $dato->municipio_r;
        $matricula->departamento_id = $dato->departamento_id;
        $matricula->estrato_id = $dato->estrato_id;
        $matricula->tipo_vivienda_id = $dato->tipo_vivienda_id;
        $matricula->zona_id = $dato->zona_id;
        $matricula->telefono_est = $dato->celular_est;
        $matricula->celular_est = $dato->celular_est;
        $matricula->email_est = $dato->email_est;
        $matricula->vive_con = $dato->vive_con;
        $matricula->n_personas_hogar = $dato->n_personas_hogar;
        $matricula->n_hermanos = $dato->n_hermanos;
        $matricula->n_hermanos_col = $dato->n_hermanos_col;
        $matricula->telefono_f = $dato->telefono_f;
        $matricula->icbf = $dato->icbf;
        $matricula->f_accion = $dato->f_accion;
        $matricula->nee_id = $dato->nee_id;
        $matricula->nee_texto = $dato->nee_texto;
        $matricula->nuevo_antiguo = $dato->nuevo_antiguo;
        $matricula->col_procede = $dato->col_procede;
        $matricula->ciudad_procede = $dato->ciudad_procede;
        $matricula->dpto_id = $dato->dpto_id;
        $matricula->repitente = $dato->repitente;
        $matricula->jornada_id = $dato->jornada_id;
        $matricula->estatura = $dato->estatura;
        $matricula->peso = $dato->peso;
        $matricula->talla_cam = $dato->talla_cam;
        $matricula->talla_pan = $dato->talla_pan;
        $matricula->hijo_heroe = $dato->hijo_heroe;
        $matricula->desvinculado = $dato->desvinculado;
        $matricula->desmovilizado = $dato->desmovilizado;
        $matricula->nombres_acu = $dato->nombres_acu;
        $matricula->apellidos_acu = $dato->apellidos_acu;
        $matricula->tipo_doc_id = $dato->tipo_doc_acu_id;
        $matricula->n_documento_acu = $dato->n_documento_acu;
        $matricula->expedida_acu = $dato->expedida_acu;
        $matricula->direccion_acu = $dato->direccion_acu;
        $matricula->telefono_acu = $dato->telefono_acu;
        $matricula->celular_acu = $dato->celular_acu;
        $matricula->email_acu = $dato->email_acu;
        $matricula->empresa_acu = $dato->empresa_acu;
        $matricula->profesion_acu = $dato->profesion_acu;
        $matricula->parentesco_acu = $dato->parentesco_acu;
        $matricula->nombre_eps = $dato->nombre_eps;
        $matricula->beneficiario_sisben = $dato->beneficiario_sisben;
        $matricula->alergias = $dato->alergias;
        $matricula->medicamentos = $dato->medicamentos;
        $matricula->discapacidad = $dato->discapacidad;
        $matricula->etnia = $dato->etnia;
        $matricula->resguardo = $dato->resguardo;
        $matricula->conflicto = $dato->conflicto;
        $matricula->nombres_fac = $dato->nombres_fac;
        $matricula->tipo_doc_fac_id = $dato->tipo_doc_fac_id;
        $matricula->n_documento_fac = $dato->n_documento_fac;
        $matricula->direccion_fac = $dato->direccion_fac;
        $matricula->email_fac = $dato->email_fac;
        $matricula->celular_fac = $dato->celular_fac;
        $matricula->token = $token;        
        $matricula->fin_token = $fin_token;  
        $matricula->user_create = Auth::id();
        $matricula->status = 4;
        $matricula->save(); 
        
        
        //-----------------------------------------------

        

        /*$matricula = new Matriculas();
        $matricula->empresa_id = Auth::user()->empresa_id;
        $matricula->grado_id = $request->input('grado_id');
        $matricula->periodo_id = $request->input('periodo_id');
        $matricula->alumno_id = $id_alumno;
              
        $matricula->status = 4; // 4: Matricula parcial, notificado al responsable       
        
        $matricula->save();*/

        //Información para la notificación vía mail

        $documentos = DB::table('grados_documentos')
                  ->select('nombre', 'archivo', 'status')                  
                  ->where('grado_empresa_id', $grados_doc->id)
                  ->where('periodo_id', $request->input('periodo_id'))
                  ->where('status', 1)
                  ->orderByRaw('grados_documentos.nombre ASC')
                  ->get();
                  

        $colegio = DB::table('empresas')
                  ->select('nombre', 'direccion','telefono', 'email')
                  ->where('id',  Auth::user()->empresa_id)
                  ->first();

        $email = DB::table('emails')
                  ->select('emails.asunto', 'emails.mensaje')  
                  ->where('emails.empresa_id',  Auth::user()->empresa_id)
                  ->where('emails.periodo_id', $request->input('periodo_id'))
                  ->where('emails.grado_id', $request->input('grado_id'))
                  ->first();

        $data = array(        
                'destinatario' => $dato->email_acu,
                'token' => $token, 
                'asunto' => $email->asunto
            );
     
        
       \Mail::send('emails/not_matricula_padre', compact('data', 'documentos', 'colegio', 'email'), function($message)use ($data){
            $message->from('notificaciones@gidesco.com', 'Sistema de notificaciones GIDESCO');
            $message->to($data['destinatario'])->cc(['davidcontreras07@gmail.com'])->subject($data['asunto']);

        }); 

        return back()->with('success', 'Alumno matriculado parcialmente y notificado el responsable');
    }
    

/*
|--------------------------------------------------------------------------
| Firma digital
|--------------------------------------------------------------------------
|
*/

    public function firma_digital($token)
    {
        
        $ahora = date("Y-m-d H:i:s");
        
        $matricula_id = DB::table('matriculas')
                    ->select('id')
                    ->where('token', $token)
                    ->get();
        
        if (count($matricula_id)) 
        {
            $dato = Matriculas::find($matricula_id[0]->id);     
            $dato->firma_digital = $ahora;
            $dato->save();
        
            return 1;
        }
        else
        {
            return 0;
        }

    }

/*
|--------------------------------------------------------------------------
| Proceso masivo para el proceso de matriculas
|--------------------------------------------------------------------------
|
*/

    public function procesarDatosMasivos()
    {
        $controlador = new MatriculasController();

        $estudiantes = DB::table('masivo_estudiantes')->where('status', 1)->get();

        foreach ($estudiantes as $key) 
        {

            $datos = [
                'id' => $key->id,
                'empresa_id' => $key->empresa_id,
                'periodo_id' => $key->periodo_id,
                'grado_id' => $key->grado_id,
                'n_documento' => $key->n_documento,
                'email' => $key->email
            ];
            
            // Obtener el request actual
            $requestActual = request();
            
            // Fusionar los datos del arreglo con los datos del request actual
            $requestActual->merge($datos);

            // Llamar a la función de guardado del controlador
            $controlador->store3($requestActual);
            
            // Actualiza el registro con el ID obtenido y le asigna un nuevo valor al campo 'status'
            DB::table('masivo_estudiantes')->where('id', $key->id)->update(['status' => 2]); 

            // Retrasar la ejecución por 3 segundos para el siguiente dato
            sleep(3);

        }

    }

/*
|--------------------------------------------------------------------------
| Cargue de datos masivos a tabla --> Simula el proceso de matricula con el padre de familia
|--------------------------------------------------------------------------
|
*/
    public function importarExcel(Request $request) 
    {
        
        Excel::import(new UsersImport, request()->file('archivo_excel'));
        //Excel::import($request->file('archivo_excel'),new UsersImport());

        //$archivo = public_path('CargueExcel.xlsx');
        /*$archivo = $request->file('archivo_excel')->getPathName();
        $importador = new UsersImport();
        $disk = null;
        $readerType = null;

        Excel::import($importador, $archivo, $disk, $readerType);*/
         
       return back()->with('success', 'Usuarios registrados exitosamente.');
    }
    

/*
|--------------------------------------------------------------------------
| Función para generar la ficha de matricula
|--------------------------------------------------------------------------
|
*/
    public function ficha_matricula($matricula_id, $formato)
    {
        $datos = DB::table('matriculas as m')
                    ->select(
                            'al.id AS alumno_id', 
                            DB::raw('CONCAT_WS(" ", COALESCE(al.nombre1, ""), COALESCE(al.nombre1, ""), COALESCE(al.apellido1, ""), COALESCE(al.apellido2, "")) AS nom_alumno'), 
                            'c1.nombre as tipo_documento',
                            DB::raw('COALESCE(al.n_documento, " ") AS n_documento'),
                            'al.exp_municipio as lugar_expedicion',
                            'al.fecha_nacimiento',
                            'al.ciudad_id as lugar_nacimiento',
                            'paises.nombre as pais_nacimiento',
                            'm.direccion_r as direccion',
                            'departamentos.nombre as dpto_residencia',
                            'm.municipio_r as ciudad_residencia',
                            'c5.nombre as nom_estrato',
                            'c2.nombre as nom_genero',
                            'empresas_sedes.nombre as nom_sede',
                            'c3.nombre as nom_jornada',
                            'grados.nombre as nom_grado',
                            'paralelos.nombre as nom_paralelo',
                            DB::raw('CONCAT_WS(" ", COALESCE(users.name, ""), COALESCE(users.last, "")) AS nom_director'), 
                            'm.created_at as fecha_registro',
                            'm.updated_at as fecha_matricula',
                            'm.nombre_eps as nom_eps',
                            'm.discapacidad as nom_discapacidad',
                            'c4.nombre as tipo_sangre',
                            'm.nombres_acu as nom_acudiente',
                            'm.parentesco_acu as nom_parentesco',
                            'm.n_documento_acu as doc_parentesco',
                            'm.telefono_acu as tel_parentesco',
                            'm.profesion_acu as prof_parentesco',
                            'm.email_acu as email_parentesco',
                            'm.n_hermanos', 
                            'm.discapacidad')
                    ->leftJoin('alumnos as al', 'm.alumno_id', '=', 'al.id')
                    ->leftJoin('catalogos as c1', 'al.tipo_id', '=', 'c1.id')
                    ->leftJoin('catalogos as c2', 'al.genero_id', '=', 'c2.id')
                    ->leftJoin('catalogos as c3', 'm.jornada_id', '=', 'c3.id')
                    ->leftJoin('catalogos as c4', 'al.sangre_id', '=', 'c4.id')
                    ->leftJoin('catalogos as c5', 'm.estrato_id', '=', 'c5.id')
                    ->leftJoin('departamentos', 'm.departamento_id', '=', 'departamentos.id')
                    ->leftJoin('paises', 'al.pais_id', '=', 'paises.id')
                    ->leftJoin('empresas_sedes', 'm.sede_id', '=', 'empresas_sedes.id')
                    ->leftJoin('grados', 'm.grado_id', '=', 'grados.id')
                    ->leftJoin('paralelos', 'm.paralelo_id', '=', 'paralelos.id')
                    ->leftJoin('users', 'paralelos.director_id', '=', 'users.id')
                    ->where('m.empresa_id',  Auth::user()->empresa_id)
                    ->where('m.id', $matricula_id)
                    ->first(); 
                    
                    //dd($datos);
                    
        $colegio = DB::table('empresas')
                      ->select('rector', 'texto', 'imagen')
                      ->where('id', Auth::user()->empresa_id)
                      ->first();
                      
        $padres = DB::table('padres')
                      ->where('alumno_id', $datos->alumno_id)
                      ->where('empresa_id', Auth::user()->empresa_id)
                      ->get();
        

        if($formato == 'pdf')
        {
            $pdf = PDF::loadView('boletines.ficha_matricula', compact('datos', 'colegio', 'padres'));
        
            return $pdf->download($datos->nom_alumno.'.pdf');
        }
        else
        {
            return view('boletines.ficha_matricula', compact('datos', 'colegio', 'padres'));
        }

    }
    

/*
|--------------------------------------------------------------------------
| Función para generar las fichas y guardarlos en el servidor
|--------------------------------------------------------------------------
|
*/
    public function GenerarFichasMatricula($paralelo_id)
    {
        $controlador = new VariosController();

        $datos = DB::table('matriculas')
                  ->leftJoin('alumnos','matriculas.alumno_id','alumnos.id')
                  ->leftJoin('paralelos','matriculas.paralelo_id','paralelos.id')
                  ->leftJoin('periodos','matriculas.periodo_id','periodos.id')
                  ->leftJoin('temporadas','periodos.id','temporadas.periodo_id')
                  ->select(
                          'alumnos.id AS alumno_id',
                          'paralelos.id AS paralelo_id',
                          'temporadas.id AS temporada_id'
                          )
                  ->where('matriculas.empresa_id', Auth::user()->empresa_id)
                  ->where('matriculas.paralelo_id', $paralelo_id)
                  ->where('matriculas.status', 5)
                  ->where('temporadas.empresa_id', Auth::user()->empresa_id)
                  ->where('temporadas.status', 1)
                  ->get();

        foreach ($datos as $key) 
        {
            
            // Llamar a la función de guardado del controlador
            $controlador->pdf($key->temporada_id, $key->alumno_id, $key->paralelo_id);

            // Retrasar la ejecución por 3 segundos para el siguiente dato
            usleep(5000000);
            
        }
    }
}


