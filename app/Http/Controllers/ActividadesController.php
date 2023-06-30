<?php

namespace App\Http\Controllers;

use App\Actividades;
use Illuminate\Http\Request;
use App\Traits\Funciones;
use Illuminate\Support\Facades\Auth;
use DB;

class ActividadesController extends Controller
{

    use Funciones; // Funciones para todo el sistema : App/Traits/Funciones

/*
|--------------------------------------------------------------------------
| Index
|--------------------------------------------------------------------------
|
*/
    public function index()
    {
        $titulo = 'Calendario de actividades';      

        $empresa_id = Auth::user()->empresa_id; 

        return view('actividades.index', compact('titulo', 'empresa_id'));
    }


/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
|
*/
    public function consulta($id)
    {

        $data = DB::table('actividades')
                ->select(
                        'actividades.id', 
                        'actividades.nombre', 
                        'actividades.fecha_inicio AS start', 
                        'actividades.fecha_fin AS end', 'observaciones',
                        DB::raw('CONCAT(users.name, " ", users.last) AS usuario_crea')
                )
                ->leftJoin('users', 'actividades.user_create', '=', 'users.id')
                ->where('actividades.empresa_id', $id )
                ->where('actividades.status', 1 )
                ->get();

        return $data;


    }


/*
|--------------------------------------------------------------------------
| Reseva -> Visualiza el fullcalendar con la reserva indicada
|--------------------------------------------------------------------------
|
*/
    public function reserva($reserva_id)
    {
        $titulo = 'Actividades';  
        
        $info_reserva = DB::table('actividades')
                        ->select('id', 'fecha_inicio')
                        ->where('id', $reserva_id )
                        ->first(); 
                        

        $fecha_reserva = date("Y-m-d", strtotime($info_reserva->fecha_inicio)); 

        $data = DB::table('actividades')
                ->select(
                        'actividades.id', 
                        'actividades.nombre', 
                        'actividades.fecha_inicio AS start', 
                        'actividades.fecha_fin AS end', 'observaciones',
                        DB::raw('CONCAT(users.name, " ", users.last) AS usuario_crea')
                )
                ->leftJoin('users', 'actividades.user_create', '=', 'users.id')
                ->where('actividades.empresa_id', Auth::user()->empresa_id )
                ->where('actividades.status', 1 )
                ->get();

        $empresa_id = Auth::user()->empresa_id;

        return view('actividades.index', compact('titulo',  'data', 'fecha_reserva', 'empresa_id'));
    }

/*
|--------------------------------------------------------------------------
| Crear
|--------------------------------------------------------------------------
|
*/
    public function create()
    {
        //
    }

/*
|--------------------------------------------------------------------------
| Guardar
|--------------------------------------------------------------------------
|
*/
    public function store(Request $request)
    {

        $fecha_inicio = str_replace("/","-",$request->input('fecha_inicio'));
        $fecha_inicio = date("Y-m-d H:i:s", strtotime($fecha_inicio));
        $fecha_fin = str_replace("/","-",$request->input('fecha_fin'));
        $fecha_fin = date("Y-m-d H:i:s", strtotime($fecha_fin));

        $temporadas = DB::table('temporadas')
                ->select('id')
                ->where('status', 1 )
                ->orderByRaw('id DESC')
                ->first(); 

        //Registro de la reserva
        $request['temporada_id'] = $temporadas->id;
        $request['fecha_inicio'] = $fecha_inicio;
        $request['fecha_fin'] = $fecha_fin;
        $request['user_create'] = Auth::id();
        $request['empresa_id'] = Auth::user()->empresa_id;
        $data = Actividades::create($request->all());

        return redirect ('admin/actividades/')->with('success', 'Reserva exitosa');

    }

/*
|--------------------------------------------------------------------------
| Actualizar
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request)
    {

        $fecha_inicio_act = str_replace("/","-",$request->input('fecha_inicio_act'));
        $fecha_fin_act = str_replace("/","-",$request->input('fecha_fin_act'));

        $request['fecha_inicio'] = date("Y-m-d H:i:s", strtotime($fecha_inicio_act));
        $request['fecha_fin'] = date("Y-m-d H:i:s", strtotime($fecha_fin_act));        
        $request['observaciones'] = $request->input('observaciones_act');
        $request['user_update'] = Auth::id();

        $data = Actividades::find($request->input('id'))->update($request->all());


        return redirect ('admin/actividades')->with('success', 'Actualización exitosa');
    }

/*
|--------------------------------------------------------------------------
| Eliminar
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $reserva = DB::table('reservas')
                    ->where('id', $id)
                    //->where('empresa_id', Auth::user()->empresa_id)
                    ->delete();
        return 1;     

    }
    

/*
|--------------------------------------------------------------------------
| Desactivar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Actividades::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return 1;
    }

/*
|--------------------------------------------------------------------------
| Show
|--------------------------------------------------------------------------
|
*/
    public function show()
    {

        $titulo = 'Actividades';  

        $data = DB::table('actividades')
                ->leftJoin('temporadas', 'actividades.temporada_id', '=', 'temporadas.id')
                ->select(
                    'actividades.*',
                    'temporadas.nombre AS nom_temporada')
                ->where('actividades.status', 1 )
                ->orderByRaw('actividades.fecha_inicio DESC')
                ->get();


        return view('actividades.view', compact('titulo', 'data'));    

    }

/*
|--------------------------------------------------------------------------
| Disponibilidad
|--------------------------------------------------------------------------
|
*/
    public function disponibilidad($mes, $ano)
    {


        if ((int)$mes >= 12 ) 
        {
            $mes = 12;
            $mes_anterior = 11;
            $mes_siguiente = 1;
            $ano_menu_siguiente = $ano + 1;
            $ano_menu_anterior = $ano;

        }

        if ((int)$mes == 01 ) 
        {
            $mes = 01;
            $mes_anterior = 12;
            $mes_siguiente = $mes + 1;
            $ano_menu_siguiente = $ano;
            $ano_menu_anterior = $ano - 1;
        }

        if ((int)$mes >= 2 && (int)$mes <= 11) 
        {
            //$mes = 01;
            $mes_anterior = $mes - 1;
            $mes_siguiente = $mes + 1;
            $ano_menu_siguiente = $ano;
            $ano_menu_anterior = $ano;
            
        }
        
        $mes = intval($mes);
        

        // Nombre de los meses para el titulo

        $meses[1] = "Enero";
        $meses[2] = "Febrero";
        $meses[3] = "Marzo";
        $meses[4] = "Abril";
        $meses[5] = "Mayo";
        $meses[6] = "Junio";
        $meses[7] = "Julio";
        $meses[8] = "Agosto";
        $meses[9] = "Septiembre";
        $meses[10] = "Octubre";
        $meses[11] = "Noviembre";
        $meses[12] = "Diciembre";

        $dias = date('t'); // D铆as del mes actual

        $nombre_mes = $meses[$mes];


        $titulo = 'Disponibilidad';  


        $dias_mes = date('t', mktime(0, 0, 0, $mes, 1, $ano)); ; // Identifica cuantos d铆as tiene un mes

        
        $inicio = $ano.'-'.$mes.'-01';
        $final = $ano.'-'.$mes.'-'.$dias_mes;

        $dia_inicio = strtotime($inicio);
        $dia_final = strtotime($final);

  
        $habitaciones = DB::table('habitaciones')
                        ->where('status', 1 )
                        ->orderByRaw("CAST(SUBSTRING_INDEX(habitaciones.nombre, '-', 1) AS UNSIGNED)")
                        ->orderByRaw("SUBSTRING_INDEX(habitaciones.nombre, '-', -1)")
                        ->get();
                        
        $reservas = DB::select("SELECT  habitacion_id, 
                                        DATE_FORMAT(fecha_inicio, '%Y-%m-%d') AS fecha_inicio, 
                                        DATE_FORMAT(fecha_fin, '%Y-%m-%d') AS fecha_fin
                                        FROM reservas 
                                        WHERE MONTH(fecha_inicio) IN ($mes_anterior, $mes) AND YEAR(fecha_fin) = $ano");

        /*$contador = count($reservas); // SI no existe reservas en el mes visualiza el mes anterior

        if (count($reservas) == 0) 
        {
            return back()->with('danger', 'No existen reservas para el mes solicitado');

        }*/


        return view('reservas.disponibilidad', compact('titulo', 
                                                        'dias', 
                                                        'habitaciones', 
                                                        'dia_inicio', 
                                                        'dia_final', 
                                                        'reservas', 
                                                        'nombre_mes', 
                                                        'ano', 
                                                        'mes_siguiente', 
                                                        'mes_anterior', 
                                                        'ano_menu_anterior', 
                                                        'ano_menu_siguiente'));    

    }
}
