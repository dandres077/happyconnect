<?php

namespace App\Http\Controllers;

use App\Mensajes;
use App\Respuestas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Traits\Funciones;
use DB;

class MensajesController extends Controller
{

    use Funciones;

    public static function fechaCastellano ($fecha, $opcion) {
      $fecha = substr($fecha, 0, 10);
      $numeroDia = date('d', strtotime($fecha));
      $dia = date('l', strtotime($fecha));
      $mes = date('F', strtotime($fecha));
      $anio = date('Y', strtotime($fecha));
      $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
      $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
      $nombredia = str_replace($dias_EN, $dias_ES, $dia);
      $meses_ES = array("Ene", "Feb", "Mar", "Abr", "Mayo", "Jun", "Jul", "Ago", "Sept", "Oct", "Nov", "Dic");
      $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
      $nombreMes = str_replace($meses_EN, $meses_ES, $mes);

      if ($opcion == 1) {
          return $numeroDia;
      }elseif ($opcion == 2){
          return $nombreMes;
      }elseif ($opcion == 3){
          return $anio;  
      }else{
          return $numeroDia." ".$nombreMes;  
      }

    }



public function mensajes_sinleer()
{
    $sin_leer = DB::table('mensajes')
                ->leftJoin('empresas', 'mensajes.empresa_id', '=', 'empresas.id')
                ->leftJoin('temporadas', 'mensajes.temporada_id', '=', 'temporadas.id')
                ->leftJoin('users', 'mensajes.usuario_recibe', '=', 'users.id')
                ->leftJoin('respuestas', 'mensajes.id', '=', 'respuestas.mensaje_id')
                ->select(
                        'mensajes.*',
                        'empresas.nombre AS nom_empresa',
                        'temporadas.nombre AS nom_temporada')
                ->where('mensajes.empresa_id', Auth::user()->empresa_id)
                ->where('mensajes.usuario_recibe', Auth::id())
                ->where('mensajes.status', '!=' , 3)
                ->orWhere('respuestas.usuario_recibe', Auth::id())
                ->where('respuestas.status', '!=' , 3)
                ->count();

    return $sin_leer;
}


/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/
    public function index()
    { 

        /*1   Admin       
        2   AdminConjunto       
        3   Empresarial     
        4   Residente */

        $permiso = $this->permisos(Auth::id()); 

        $titulo = 'Mensajes';

        $data = DB::table('mensajes')
                ->leftJoin('empresas', 'mensajes.empresa_id', '=', 'empresas.id')
                ->leftJoin('temporadas', 'mensajes.temporada_id', '=', 'temporadas.id')
                ->leftJoin('users', 'mensajes.usuario_recibe', '=', 'users.id')
                ->leftJoin('respuestas', 'mensajes.id', '=', 'respuestas.mensaje_id')
                ->select(
                    'mensajes.*',
                    'empresas.nombre AS nom_empresa',
                    'temporadas.nombre AS nom_temporada',
                    DB::raw('(SELECT COUNT(*) FROM respuestas WHERE respuestas.mensaje_id = mensajes.id) AS contador'),
                    DB::raw('CONCAT(COALESCE(users.name, ""), " ", COALESCE(users.last, "")) AS nom_envia')
                )
                ->where(function ($query) {
                    $query->where('mensajes.empresa_id', Auth::user()->empresa_id)
                        ->where('mensajes.usuario_recibe', Auth::id())
                        ->where('mensajes.status', '!=' , 3)
                        ->orWhere(function ($query) {
                            $query->where('respuestas.usuario_recibe', Auth::id())
                                ->where('respuestas.status', '!=' , 3);
                        });
                })
                ->orderByRaw('mensajes.id DESC')
                ->get();


        $sin_leer = new MensajesController;
        $sin_leer = $sin_leer->mensajes_sinleer();

        return view ('mensajes.index')->with(compact('data', 'sin_leer', 'titulo'));

    }

/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/
    public function enviados()
    {

        $titulo = 'Mensajes';

        $data = DB::table('mensajes')
                ->leftJoin('empresas', 'mensajes.empresa_id', '=', 'empresas.id')
                ->leftJoin('temporadas', 'mensajes.temporada_id', '=', 'temporadas.id')
                ->leftJoin('users', 'mensajes.usuario_recibe', '=', 'users.id')
                ->leftJoin('respuestas', 'mensajes.id', '=', 'respuestas.mensaje_id')
                ->select(
                    'mensajes.*',
                    'empresas.nombre AS nom_empresa',
                    'temporadas.nombre AS nom_temporada',
                    DB::raw('(SELECT COUNT(*) FROM respuestas WHERE respuestas.mensaje_id = mensajes.id) AS contador'),
                    DB::raw('CONCAT(COALESCE(users.name, ""), " ", COALESCE(users.last, "")) AS nom_envia')
                )
                ->where(function ($query) {
                    $query->where('mensajes.empresa_id', Auth::user()->empresa_id)
                        ->where('mensajes.usuario_envia', Auth::id())
                        ->where('mensajes.status', '!=' , 3)
                        ->orWhere(function ($query) {
                            $query->where('respuestas.usuario_envia', Auth::id())
                                ->where('respuestas.status', '!=' , 3);
                        });
                })
                ->orderByRaw('mensajes.id DESC')
                ->get();


        $sin_leer = Mensajes::all()->where('status', 1)->count();

        return view ('mensajes.enviados')->with(compact('data', 'sin_leer', 'titulo'));

    }

/*
|--------------------------------------------------------------------------
| eliminados
|--------------------------------------------------------------------------
|
*/
    public function trash()
    {

        $titulo = 'Mensajes';

        $data = DB::table('mensajes')
                ->leftJoin('empresas', 'mensajes.empresa_id', '=', 'empresas.id')
                ->leftJoin('temporadas', 'mensajes.temporada_id', '=', 'temporadas.id')
                ->leftJoin('users', 'mensajes.usuario_recibe', '=', 'users.id')
                ->select(
                        'mensajes.*',
                        'empresas.nombre AS nom_empresa',
                        'temporadas.nombre AS nom_temporada',)
                ->where('mensajes.empresa_id', Auth::user()->empresa_id)
                ->where('mensajes.usuario_envia', Auth::id())
                ->where('mensajes.status' , 3)
                ->get();


        $sin_leer = Mensajes::all()->where('status', 1)->count();

        return view ('mensajes.trash')->with(compact('data', 'sin_leer', 'titulo'));

    }

/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/
    public function create()
    {

        $titulo = 'Mensajes';  

        $sin_leer = new MensajesController;
        $sin_leer = $sin_leer->mensajes_sinleer();

        $permiso = $this->permisos(Auth::id());
        $empresa = Auth::user()->empresa_id;

        $temporada_id = 1; 

        
        if($permiso == 2 || $permiso == 1) //Es funcionario debe ver a los alumnos
        {
            $grados = DB::table('paralelos')
                    ->leftJoin('grados', 'paralelos.grado_id', '=', 'grados.id')
                    ->select('grados.id', 'grados.nombre')
                    ->where('paralelos.empresa_id', Auth::user()->empresa_id )
                    ->where('paralelos.temporada_id', $temporada_id )
                    ->where('paralelos.status', 1 )
                    ->groupBy('grados.id', 'grados.nombre')
                    ->get();

            $paralelos = DB::table('paralelos')
                        ->where('empresa_id', Auth::user()->empresa_id )
                        ->where('empresa_id', $temporada_id )
                        ->where('grado_id', $grados[0]->id)
                        ->where('status', 1 )
                        ->get();

            return view ('mensajes.create')->with(compact('titulo', 'permiso', 'sin_leer', 'grados', 'paralelos', 'empresa', 'temporada_id'));
        }

        if($permiso == 5) //Es alumno, entonces debe reflejar a los administrativos
        { 
            $funcionarios = DB::table('model_has_roles')
                            ->leftjoin('users', 'model_has_roles.model_id', '=', 'users.id')
                            ->select(
                                'users.id',
                                DB::raw('CONCAT(users.name, " " ,users.last) AS administrador'))
                            ->where('users.empresa_id', Auth::user()->empresa_id)
                            ->where('users.status', 1)
                            ->get();

            return view ('mensajes.create')->with(compact('titulo', 'funcionarios', 'permiso', 'sin_leer', 'empresa', 'temporada_id'));
        }
        
    }

/*
|--------------------------------------------------------------------------
| store
|--------------------------------------------------------------------------
|
*/
    public function store(Request $request)
    {
        
        $data = DB::table('users')
                    ->select('id')
                    ->where('empresa_id', Auth::user()->empresa_id)
                    ->where('alumno_id', $request->input('usuario_recibe'))
                    ->where('status', 1)
                    ->first();

        dd($data->alumno_id);


        $request['empresa_id'] = Auth::user()->empresa_id;
        $request['usuario_envia'] = Auth::id();
        $request['usuario_recibe'] = $data->alumno_id;
        $request['user_create'] = Auth::id();
        $data = Mensajes::create($request->all());

        if ($request->file('adjunto')) {
            $path = Storage::disk('public')->put('documentos/conjuntos',$request->file('adjunto'));
            $data->fill(['adjunto'=>asset($path)])->save();
        }

        return redirect ('admin/mensajes')->with('success', 'Registro creado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| store_response --> Respuesta a un mensaje
|--------------------------------------------------------------------------
|
*/
    public function store_response(Request $request)
    {

        // $data = DB::table('bienes')
        //             ->leftjoin('usuarios_bienes', 'bienes.id', '=', 'usuarios_bienes.bien_id')
        //             ->select(
        //                 'usuarios_bienes.usuario_id')
        //             ->where('bienes.empresa_id', Auth::user()->empresa_id)
        //             ->where('bienes.oficina', 1)
        //             ->first();


        $request['empresa_id'] = Auth::user()->empresa_id;
        $request['usuario_envia'] = Auth::id();
        //$request['usuario_recibe'] =$data->usuario_id;
        $request['user_create'] = Auth::id();
        $data = Respuestas::create($request->all());

        if ($request->file('adjunto')) {
            $path = Storage::disk('public')->put('documentos/conjuntos',$request->file('adjunto'));
            $data->fill(['adjunto'=>asset($path)])->save();
        }

        return redirect ('admin/mensajes')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/
    public function edit($id)
    {

    }

/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {

    }

/*
|--------------------------------------------------------------------------
| show
|--------------------------------------------------------------------------
|
*/
    public function show($id)
    {
        // 1: Sin leer, 2:Leido: 3: eliminado

        $titulo = 'Mensajes';  


        $data = DB::table('mensajes')
                    ->leftJoin('users', 'mensajes.usuario_envia', '=', 'users.id')
                    ->leftJoin('users as u2', 'mensajes.usuario_recibe', '=', 'u2.id')
                    ->select('mensajes.*',
                            DB::raw('CONCAT(users.name, " " ,users.last) AS usuario_env'),
                            DB::raw('CONCAT(u2.name, " " ,u2.last) AS usuario_rec'))
                    ->where('mensajes.id', $id)
                    ->where('mensajes.empresa_id', Auth::user()->empresa_id)            
                    ->get();

        $historial = DB::table('respuestas')
                        ->leftJoin('users', 'respuestas.usuario_envia', '=', 'users.id')
                        ->leftJoin('users as u2', 'respuestas.usuario_recibe', '=', 'u2.id')
                        ->select('respuestas.*',
                                DB::raw('CONCAT(users.name, " " ,users.last) AS usuario_env'),
                                DB::raw('CONCAT(u2.name, " " ,u2.last) AS usuario_rec'))
                        ->where('respuestas.mensaje_id', $id)
                        ->where('respuestas.empresa_id', Auth::user()->empresa_id)            
                        ->get();


        $estado = Mensajes::find($id);
        $estado->status = '2'; 
        $estado->save();

        Respuestas::where('mensaje_id', $id)->update(['status' => 2]);


        $sin_leer = Mensajes::all()->where('status', 1)->count();


        return view ('mensajes.view')->with (compact('data', 'sin_leer', 'titulo', 'historial'));
    }

/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/
    public function destroy($id) 
    {
        $data = Mensajes::find($id);
        $data->status = '3'; 
        $data->save();

        Respuestas::where('mensaje_id', $id)->update(['status' => 3]);

        return redirect ('admin/mensajes')->with('success', 'Registro eliminado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| important
|--------------------------------------------------------------------------
|
*/

    public function important($id, $estado) 
    {
        $data = Mensajes::find($id);
        $data->importante = $estado; 
        $data->save();

        return redirect ('admin/mensajes')->with('success', 'Registro eliminado exitosamente');
    }



/*
|--------------------------------------------------------------------------
| importants
|--------------------------------------------------------------------------
|
*/
    public function importantes()
    {
        $data = Mensajes::all()->where('status','!=', 4)->where('importante', 1);
        $sin_leer = Mensajes::all()->where('status', 1)->count();
        return view ('mensajes.trash')->with(compact('data', 'sin_leer'));

    }




}
