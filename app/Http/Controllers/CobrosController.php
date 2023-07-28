<?php

namespace App\Http\Controllers;

use App\Cobros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Traits\Funciones;
use DB;

//Librerias para importar EXCEL
use App\Imports\CobrosImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\UploadedFile;


class CobrosController extends Controller
{
    use Funciones;

/*
|--------------------------------------------------------------------------
| Alumnos, visualiza la lista junto con los meses y el detalle del pago
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
                ->where('paralelos.empresa_id', Auth::user()->empresa_id )
                ->where('paralelos.status', '<>', 3 )
                ->orderByRaw('paralelos.id ASC')
                ->get();


        $temporadas = DB::table('temporadas')->where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->orderByRaw('nombre ASC')->get();
        $meses = DB::table('catalogos')->where('empresa_id', Auth::user()->empresa_id)->where('generalidad_id', 22)->where('status', 1)->orderByRaw('id ASC')->get();
        $conceptos = DB::table('catalogos')->where('empresa_id', Auth::user()->empresa_id)->where('generalidad_id', 23)->where('status', 1)->orderByRaw('id ASC')->get();
    
        $bancos = DB::table('catalogos')->where('empresa_id', Auth::user()->empresa_id)->where('generalidad_id', 24)->where('status', 1)->orderByRaw('id ASC')->get();
        $grados = DB::table('grados')->where('empresa_id', Auth::user()->empresa_id)->where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->orderByRaw('id ASC')->get();

        $titulo = 'Cobros';

        return view('cobros.index', compact('data', 'titulo', 'temporadas', 'meses','conceptos', 'grados'));
    }


/*
|--------------------------------------------------------------------------
| Alumnos, visualiza la lista junto con los meses y el detalle del pago
|--------------------------------------------------------------------------
|
*/
    public function alumnos($paralelo_id)
    { 

        $titulo = 'Cobros';


        $meses = DB::table('catalogos')
                ->select('id', 'nombre')
                ->where('empresa_id', Auth::user()->empresa_id)
                ->where('generalidad_id', 22)
                ->where('status', 1)
                ->orderByRaw('id ASC')
                ->get();

        $data = DB::table('matriculas')
                ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')
                ->select(
                        'matriculas.id',
                        'matriculas.alumno_id',
                        'matriculas.paralelo_id',
                        DB::raw('CONCAT(alumnos.nombre1, " ", alumnos.apellido1) AS nom_alumno'))
                ->where('matriculas.empresa_id', Auth::user()->empresa_id)
                //->where('matriculas.temporada_id', $temporada_id)
                ->where('matriculas.paralelo_id', $paralelo_id)
                ->where('matriculas.status', 5 )
                ->orderByRaw('matriculas.id ASC')
                ->get(); 


        $cobros = DB::table('cobros AS c')
                ->leftJoin('catalogos AS ca', 'c.concepto_id', '=', 'ca.id')
                ->select('c.id', 'c.alumno_id', 'c.mes_id', 'c.fecha', 'c.valor','c.observacion', 'ca.nombre', 'c.status')
                ->where('c.empresa_id', Auth::user()->empresa_id)
                //->where('c.temporada_id', $temporada_id)
                ->where('c.paralelo_id', $paralelo_id)
                ->where('c.status', '<>', 3)
                ->orderByRaw('c.id ASC')
                ->get(); 

        //Modal crear

        $meses = DB::table('catalogos')->where('empresa_id', Auth::user()->empresa_id)->where('generalidad_id', 22)->where('status', 1)->orderByRaw('id ASC')->get();
        $conceptos = DB::table('catalogos')->where('empresa_id', Auth::user()->empresa_id)->where('generalidad_id', 23)->where('status', 1)->orderByRaw('id ASC')->get();
    
        $bancos = DB::table('catalogos')->where('empresa_id', Auth::user()->empresa_id)->where('generalidad_id', 24)->where('status', 1)->orderByRaw('id ASC')->get();
        $grados = DB::table('grados')->where('empresa_id', Auth::user()->empresa_id)->where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->orderByRaw('id ASC')->get(); 

        $alumnos = DB::table('matriculas')
                ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')
                ->select(
                        'matriculas.id',
                        'matriculas.alumno_id',
                        DB::raw('CONCAT(alumnos.nombre1, " ", alumnos.apellido1) AS nom_alumno'))
                ->where('matriculas.empresa_id', Auth::user()->empresa_id)
                //->where('matriculas.temporada_id', $temporada_id)
                ->where('matriculas.paralelo_id', $paralelo_id)
                ->where('matriculas.status', 5 )
                ->orderByRaw('3 ASC')
                ->get(); 

        return view ('cobros.alumnos')->with (compact('data', 'meses', 'titulo', 'cobros', 'meses', 'conceptos', 'bancos', 'grados', 'paralelo_id', 'alumnos'));

    }


/*
|--------------------------------------------------------------------------
| Store
|--------------------------------------------------------------------------
|
*/
    public function store(Request $request)
    {

        $datos = DB::table('paralelos')
                ->where('id', $request->input('paralelo_id'))
                ->where('empresa_id', Auth::user()->empresa_id)
                ->where('status', 1)
                ->orderByRaw('id ASC')
                ->first();

        $request['temporada_id'] = $datos->temporada_id;
        $request['empresa_id'] = Auth::user()->empresa_id;
        $request['grado_id'] = $datos->grado_id;
        $request['user_create'] = Auth::user()->alumno_id;
        $data = Cobros::create($request->all());

        return back()->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| Edit
|--------------------------------------------------------------------------
|
*/
    public function edit($id)
    {
        $data = Cobros::find($id); 
        $titulo = 'Cobros';
        $meses = DB::table('catalogos')->where('empresa_id', Auth::user()->empresa_id)->where('generalidad_id', 22)->where('status', 1)->orderByRaw('id ASC')->get();
        $conceptos = DB::table('catalogos')->where('empresa_id', Auth::user()->empresa_id)->where('generalidad_id', 23)->where('status', 1)->orderByRaw('id ASC')->get();
    
        $bancos = DB::table('catalogos')->where('empresa_id', Auth::user()->empresa_id)->where('generalidad_id', 24)->where('status', 1)->orderByRaw('id ASC')->get();
        $grados = DB::table('grados')->where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->orderByRaw('id ASC')->get(); 


        $informacion = DB::table('cobros')
                        ->where('id', $id)
                        ->where('empresa_id', Auth::user()->empresa_id)
                        ->where('status', '!=', 3)
                        ->orderByRaw('id ASC')
                        ->first(); 

        $alumnos = DB::table('matriculas')
                ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')
                ->select(
                        'matriculas.id',
                        'matriculas.alumno_id',
                        DB::raw('CONCAT(alumnos.nombre1, " ", alumnos.apellido1) AS nom_alumno'))
                ->where('matriculas.empresa_id', Auth::user()->empresa_id)
                ->where('matriculas.temporada_id', $informacion->temporada_id)
                ->where('matriculas.paralelo_id', $informacion->paralelo_id)
                ->where('matriculas.status', 5 )
                ->orderByRaw('3 ASC')
                ->get(); 

        return view ('cobros.edit')->with (compact('data', 'titulo', 'meses', 'conceptos', 'bancos', 'grados', 'alumnos'));
    }

/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {   

        $informacion = DB::table('cobros')
                        ->select('paralelo_id')
                        ->where('id', $id)
                        ->where('empresa_id', Auth::user()->empresa_id)
                        ->where('status', '!=', 3)
                        ->orderByRaw('id ASC')
                        ->first();

        $request['user_update'] = Auth::id();
        $datos = Cobros::find($id)->update($request->all());

        // if ($request->file('imagen')) {
        //     $path = Storage::disk('public')->put('documentos/conjuntos',$request->file('imagen'));
        //     $data->fill(['imagen'=>asset($path)])->save();
        // }

        return redirect('admin/cobros/paralelo/'.$informacion->paralelo_id)->with('success', 'Registro actualizado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| Destroy
|--------------------------------------------------------------------------
|
*/
    public function destroy($id)
    {

        $data = Cobros::find($id);
        $data->status = '3'; //Eliminado
        $data->save();

        return back()->with('eliminar', 'ok');
    }


/*
|--------------------------------------------------------------------------
| Envío de correo 
|--------------------------------------------------------------------------
|
*/

    public function envio_correo()
    {
        
        $data = DB::table('cobros')
                ->leftJoin('conjuntos', 'cobros.empresa_id', '=', 'conjuntos.id')
                ->leftJoin('torres', 'cobros.torre_id', '=', 'torres.id')
                ->leftJoin('bienes', 'cobros.bien_id', '=', 'bienes.id')
                ->leftJoin('periodos', 'cobros.periodo_id', '=', 'periodos.id')
                ->leftJoin('opciones', 'cobros.cobro_id', '=', 'opciones.id')
                ->leftJoin('usuarios_bienes', 'bienes.id', '=', 'usuarios_bienes.bien_id')
                ->leftJoin('users', 'usuarios_bienes.usuario_id', '=', 'users.id')
                ->leftJoin('opciones as opc1', 'usuarios_bienes.tipo_residente', '=', 'opc1.id')
                ->select(
                        'cobros.*',
                        'conjuntos.nombre as nom_conjunto',  
                        'torres.nombre as nom_torre',
                        'bienes.nombre as nom_bien',
                        'periodos.nombre as nom_periodo',
                        'opciones.nombre as nom_cobro',
                        DB::raw('CONCAT(users.name, " ", users.last) AS nom_usuario'),
                        'users.email',
                        'opc1.nombre as nom_propietario')
                ->where('cobros.notificacion', 1)
                ->whereIn('usuarios_bienes.tipo_residente', ['26', '28']) //Propietario y arrendatario
                ->where('usuarios_bienes.status', 1)
                ->orderByRaw('cobros.id ASC')
                ->get(); 

        $empresa = array(
                        "iDaves Ingeniería",
                        "https://idaves.com",
                        "3188482206 - 3186932083",
                        "contacto@idaves.com"
                    );

    

        foreach ($data as $info) 
        {

            $asunto = 'Pago exitoso: '.$info->nom_cobro.' ('.$info->nom_periodo.')';

            \Mail::send('emails/not_envio_email', compact('info', 'empresa'), function($message)use ($info, $asunto){
                $message->from('notificaciones@idaves.com', 'Sistema de notificaciones iDaves.com');
                $message->to($info->email)->cc(['davidcontreras07@gmail.com'])->subject($asunto);

            });

            //Actualizar estado de envío
            $data = Cobros::find($info->id);
            $data->notificacion = 2; //Mensaje enviado exitosamente
            $data->save();

        }    

        return 'ok';
    }

/*
|--------------------------------------------------------------------------
| Reenvio de correo
|--------------------------------------------------------------------------
|
*/

    public function reenvio($id)
    {
        
        //Actualizar estado de envío
        $data = Cobros::find($id);
        $data->status = 1; //Mensaje Listo para ser enviado
        $data->save();

        return redirect ('cobros')->with('success', 'Mensaje ingreso a la programación');

    }


/*
|--------------------------------------------------------------------------
| Reporte por alumno
|--------------------------------------------------------------------------
|
*/
    public function reporte($alumno_id, $paralelo_id)
    {

        $titulo = 'Cobros';

        $meses = DB::table('catalogos')->where('empresa_id', Auth::user()->empresa_id)->where('generalidad_id', 22)->where('status', 1)->orderByRaw('id ASC')->get();

        $conceptos = DB::table('catalogos')->where('empresa_id', Auth::user()->empresa_id)->where('generalidad_id', 23)->where('status', 1)->orderByRaw('id ASC')->get();
    
        $bancos = DB::table('catalogos')->where('empresa_id', Auth::user()->empresa_id)->where('generalidad_id', 24)->where('status', 1)->orderByRaw('id ASC')->get();

        $grados = DB::table('grados')->where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->orderByRaw('id ASC')->get(); 


        $data = DB::table('cobros')
                        ->leftJoin('alumnos', 'cobros.alumno_id', '=', 'alumnos.id')
                        ->leftJoin('temporadas', 'cobros.temporada_id', '=', 'temporadas.id')
                        ->leftJoin('catalogos', 'cobros.mes_id', '=', 'catalogos.id')
                        ->leftJoin('catalogos AS c2', 'cobros.concepto_id', '=', 'c2.id')
                        ->leftJoin('catalogos AS c3', 'cobros.banco_id', '=', 'c3.id')
                        ->leftJoin('grados', 'cobros.grado_id', '=', 'grados.id')
                        ->leftJoin('paralelos', 'cobros.paralelo_id', '=', 'paralelos.id')
                        ->select(
                                'cobros.id',
                                'cobros.fecha',
                                'cobros.valor',
                                'cobros.observacion',
                                DB::raw('CONCAT(alumnos.nombre1, " ", alumnos.apellido1) AS nom_alumno'),
                                'temporadas.nombre As nom_temporada',
                                'catalogos.nombre AS nom_mes',
                                'c2.nombre AS nom_concepto',
                                'c3.nombre AS nom_banco',
                                'grados.nombre AS nom_grado',
                                'paralelos.nombre AS nom_paralelo'
                        )
                        ->where('cobros.alumno_id', $alumno_id)
                        ->where('cobros.paralelo_id', $paralelo_id)
                        ->where('cobros.empresa_id', Auth::user()->empresa_id)
                        ->where('cobros.status', 1)
                        ->orderByRaw('cobros.id ASC')
                        ->get();

        return view ('cobros.reporte')->with (compact('titulo', 'meses', 'conceptos', 'bancos', 'grados', 'data'));
    }


/*
|--------------------------------------------------------------------------
| Alumnos, visualiza la lista junto con los meses y el detalle del pago
|--------------------------------------------------------------------------
|
*/
    public function show()
    { 

        $titulo = 'Cobros';

        //Se consulta el paralelo del alumno a partir del ID de usuario
        $info_usuario = DB::table('matriculas')
                        ->select('paralelo_id')
                        ->where('empresa_id', Auth::user()->empresa_id)
                        ->where('alumno_id', Auth::user()->alumno_id)
                        ->where('status', 5)
                        ->orderByRaw('id DESC')
                        ->first();

        //Se valida si contiene información
        if (empty($info_usuario)) 
        {
            $paralelo = 0; // No tiene paralelo

            return back()->with('danger', 'Vista disponible solo para el alumno');

        }else{
            $paralelo = 1;
        }


        $meses = DB::table('catalogos')
                ->select('id', 'sigla AS nombre')
                ->where('empresa_id', Auth::user()->empresa_id)
                ->where('generalidad_id', 22)
                ->where('status', 1)
                ->orderByRaw('id ASC')
                ->get();

        $data = DB::table('matriculas')
                ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')
                ->select(
                        'matriculas.id',
                        'matriculas.alumno_id',
                        'matriculas.paralelo_id',
                        DB::raw('CONCAT(alumnos.nombre1, " ", alumnos.apellido1) AS nom_alumno'))
                ->where('matriculas.empresa_id', Auth::user()->empresa_id)
                ->where('matriculas.alumno_id', Auth::user()->alumno_id)
                ->where('matriculas.paralelo_id', $info_usuario->paralelo_id)
                ->where('matriculas.status', 5 )
                ->orderByRaw('matriculas.id ASC')
                ->get(); 


        $cobros = DB::table('cobros AS c')
                ->leftJoin('catalogos AS ca', 'c.concepto_id', '=', 'ca.id')
                ->select('c.id', 'c.alumno_id', 'c.mes_id', 'c.fecha', 'c.valor','c.observacion', 'ca.nombre', 'c.status')
                ->where('c.empresa_id', Auth::user()->empresa_id)
                ->where('c.paralelo_id', $info_usuario->paralelo_id)
                ->where('c.alumno_id', Auth::user()->alumno_id)
                ->where('c.status', '!=', 3 )
                ->orderByRaw('c.id ASC')
                ->get(); 


        return view ('cobros.show')->with (compact('data', 'meses', 'titulo', 'cobros'));

    }


/*
|--------------------------------------------------------------------------
| Cargue de datos masivos a tabla cobros, para manejar estados pendientes y activos
|--------------------------------------------------------------------------
|
*/
    public function importarExcel(Request $request) 
    {
        
        Excel::import(new CobrosImport, request()->file('archivo_excel'));

       return back()->with('success', 'Usuarios registrados exitosamente.');
    }
}