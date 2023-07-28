<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Matriculas;
use App\Traits\Funciones;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{

    use Funciones;
/*
|--------------------------------------------------------------------------
| Constructor
|--------------------------------------------------------------------------
|
*/
    public function __construct()
    {
        $this->middleware('auth');
    }

/*
|--------------------------------------------------------------------------
| Dashborad colegio
|--------------------------------------------------------------------------
|
*/
    public function index()
    {

        $temporada_id = 1;

        $validar_rol = DB::table('model_has_roles')
                        ->where('role_id', 6)
                        ->where('model_id', Auth::id())
                        ->count();

        $total_alumnos_paralelos = DB::table('matriculas')
                                    ->leftJoin('grados', 'matriculas.grado_id', '=', 'grados.id')
                                    ->leftJoin('paralelos', 'matriculas.paralelo_id', '=', 'paralelos.id')
                                    ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')
                                    ->select(
                                            'matriculas.paralelo_id',
                                            DB::raw('COUNT(*) as total_alumnos'),
                                            'grados.nombre AS nom_grado',
                                            'paralelos.nombre AS nom_paralelo',
                                            DB::raw('COUNT(CASE WHEN alumnos.genero_id = 18 THEN 1 END) AS total_hombres'),
                                            DB::raw('COUNT(CASE WHEN alumnos.genero_id = 19 THEN 1 END) AS total_mujeres'),
                                            DB::raw('COUNT(CASE WHEN alumnos.genero_id = 17 THEN 1 END) AS total_otro')
                                    )
                                    ->where('matriculas.temporada_id', $temporada_id)
                                    ->where('paralelos.temporada_id', $temporada_id)
                                    ->where('matriculas.empresa_id', Auth::user()->empresa_id)
                                    ->where('matriculas.status', 5)
                                    ->groupBy('matriculas.paralelo_id', 'grados.nombre', 'paralelos.nombre')
                                    ->get();

        $resultadoParalelos = [];

        foreach ($total_alumnos_paralelos as $item) {
            $resultadoParalelos[] = [
                "nom_grado" => "{$item->nom_grado}{$item->nom_paralelo}",
                "total_alumnos" => $item->total_alumnos,
                "total_hombres" => $item->total_hombres,
                "total_mujeres" => $item->total_mujeres,
            ];
        }


        //---------------------------------------------------------------------------------------------------------------------------------
        //Cantidad de hombres y mujeres en el colegio
        $total_h_m = DB::table('matriculas')
                        ->leftJoin('alumnos', 'matriculas.alumno_id', '=', 'alumnos.id')
                        ->select(
                            DB::raw('COUNT(CASE WHEN alumnos.genero_id = 18 THEN 1 END) AS total_hombres'),
                            DB::raw('COUNT(CASE WHEN alumnos.genero_id = 19 THEN 1 END) AS total_mujeres'),
                            DB::raw('COUNT(CASE WHEN alumnos.genero_id = 17 THEN 1 END) AS total_otro')
                        )
                        ->where('alumnos.empresa_id', Auth::user()->empresa_id)
                        ->where('matriculas.temporada_id', $temporada_id)
                        ->where('matriculas.status', 5)
                        ->first();

        $resultado = [];
        if ($total_h_m->total_mujeres > 0) {
            $resultado[] = ['tipo' => 'Mujeres', 'total' => $total_h_m->total_mujeres];
        }
        if ($total_h_m->total_hombres > 0) {
            $resultado[] = ['tipo' => 'Hombres', 'total' => $total_h_m->total_hombres];
        }

        if ($total_h_m->total_hombres > 0) {
            $resultado[] = ['tipo' => 'Otros', 'total' => $total_h_m->total_otro];
        }

        $total_h_m = $resultado;

        //---------------------------------------------------------------------------------------------------------------------------------

        //Cantidad de alumnos por edad
        $cantidadAlumnosEdad = DB::select("
                                            SELECT 
                                                edad,
                                                COUNT(*) AS total_alumnos
                                            FROM (
                                                SELECT 
                                                    FLOOR(DATEDIFF(CURDATE(), alumnos.fecha_nacimiento) / 365) AS edad
                                                FROM matriculas
                                                LEFT JOIN alumnos ON matriculas.alumno_id = alumnos.id
                                                WHERE matriculas.empresa_id = ? AND matriculas.temporada_id = ? AND matriculas.status = 5
                                            ) AS subconsulta
                                            GROUP BY edad
                                            ORDER BY edad ASC
                                        ", [Auth::user()->empresa_id, $temporada_id]);

                                        foreach ($cantidadAlumnosEdad as $item) {
                                            $resultadoEdades[] = [
                                                "edad" => $item->edad,
                                                "cantidad" => $item->total_alumnos
                                            ];
                                        }         

        $cantidadAlumnosEdad = $resultadoEdades;
        //---------------------------------------------------------------------------------------------------------------------------------
        //Cantidad alumnos activos
        $alumnosActivos = DB::table('matriculas')
                            ->where('empresa_id', Auth::user()->empresa_id)
                            ->where('temporada_id', $temporada_id)
                            ->where('status', 5)
                            ->count();

        //Cantidad profesionales activos
        $profesionalesActivos = DB::table('profesionales')
                            ->where('empresa_id', Auth::user()->empresa_id)
                            ->where('status', 1)
                            ->count();

        //---------------------------------------------------------------------------------------------------------------------------------

        $consultaCobros = DB::table('cobros')
                                ->leftJoin('catalogos', 'cobros.mes_id', '=', 'catalogos.id')
                                ->select(
                                    'cobros.mes_id',
                                    'catalogos.nombre AS nom_mes',
                                    DB::raw('SUM(valor) as total_recaudado'),
                                    DB::raw('SUM(CASE WHEN cobros.status = 1 THEN valor ELSE 0 END) as valor_realizado'),
                                    DB::raw('SUM(CASE WHEN cobros.status = 2 THEN valor ELSE 0 END) as valor_pendiente')
                                )
                                ->where('cobros.empresa_id', Auth::user()->empresa_id)
                                ->where('cobros.temporada_id', $temporada_id)
                                ->groupBy('cobros.mes_id', 'catalogos.nombre');

        //Se agrega la condición a la consulta para filtrar por el paralelo
        if($validar_rol == 1) 
        {
            $consultaCobros->where('cobros.alumno_id', Auth::user()->alumno_id);
        }

        //Se ejecuta la consulta
        $totalRecaudadoPorMes = $consultaCobros->get();



        //---------------------------------------------------------------------------------------------------------------------------------

        //Cantida de alumnos por genero y edad
        $cantidadHMPorEdad = DB::select("
                                        SELECT 
                                            edad,
                                            COUNT(CASE WHEN genero_id = 18 THEN 1 END) AS total_hombres,
                                            COUNT(CASE WHEN genero_id = 19 THEN 1 END) AS total_mujeres
                                        FROM (
                                            SELECT 
                                                FLOOR(DATEDIFF(CURDATE(), alumnos.fecha_nacimiento) / 365) AS edad,
                                                genero_id
                                            FROM matriculas
                                            LEFT JOIN alumnos ON matriculas.alumno_id = alumnos.id
                                            WHERE matriculas.empresa_id = ? AND matriculas.temporada_id = ? AND matriculas.status = 5
                                        ) AS subconsulta
                                        GROUP BY edad
                                        ORDER BY edad ASC
                                    ", [Auth::user()->empresa_id, $temporada_id]);

        //---------------------------------------------------------------------------------------------------------------------------------

        //Cantidad de grados
        $totalGrados = DB::table('matriculas')
                        ->select('paralelo_id')                        
                        ->where('temporada_id', $temporada_id)
                        ->where('empresa_id', Auth::user()->empresa_id)
                        ->where('status', 5)
                        ->groupBy('paralelo_id')
                        ->count();


        //Cantidad de rutas
        $totalRutas = DB::table('rutas')
                        ->select('id')                        
                        ->where('temporada_id', $temporada_id)
                        ->where('empresa_id', Auth::user()->empresa_id)
                        ->where('status', 1)
                        ->count();


        //---------------------------------------------------------------------------------------------------------------------------------

        // Obtenemos la fecha de ayer
        $ayer = Carbon::yesterday();

        // Consulta de las últimas actividades
        $actividadesGenerales = DB::table('actividades')
                                ->where('empresa_id', Auth::user()->empresa_id)
                                ->where('temporada_id', $temporada_id)
                                ->where('status', 1)
                                ->where('fecha_inicio', '>', $ayer)
                                ->orderBy('fecha_inicio', 'ASC')
                                ->limit(3)
                                ->get();

        //---------------------------------------------------------------------------------------------------------------------------------
        //Consulta para obtener los documentos por empresa
        $comunicados = DB::table('comunicados_documentos')
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
                    ->where('comunicados.created_at', '>', $ayer)
                    ->groupBy(
                            'comunicados.nombre',
                            'comunicados.descripcion',
                            'comunicados.archivo1',
                            'comunicados.archivo2',
                            'comunicados.archivo3',
                            'comunicados.imagen',
                            'comunicados.created_at'
                        )
                    ->orderByRaw('comunicados.id DESC')
                    ->limit(3)
                    ->get();


        //---------------------------------------------------------------------------------------------------------------------------------

        // Consulta de las últimas actividades
        $publicacionesBlog = DB::table('blogs')
                                ->where('empresa_id', Auth::user()->empresa_id)
                                ->where('status', 1)
                                ->orderBy('id', 'DESC')
                                ->limit(3)
                                ->get();



        if ($validar_rol == 1) // Rol de alumno 
        {

            //Se consulta el paralelo del alumno a partir del ID de usuario
            $info_usuario = DB::table('matriculas')
                            ->select('paralelo_id')
                            ->where('empresa_id', Auth::user()->empresa_id)
                            ->where('alumno_id', Auth::user()->alumno_id)
                            ->where('status', 5)
                            ->orderByRaw('id DESC')
                            ->first();


            // Consulta para visualizas las tareas activas
            $consultaTareas = DB::table('tareas')
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

            
            return view('dashboard.home2')->with (compact(
                                                        'totalRecaudadoPorMes',
                                                        'actividadesGenerales',
                                                        'comunicados',
                                                        'publicacionesBlog',
                                                        'consultaTareas'
            )); 

        }else{

           return view('dashboard.home1')->with (compact(
                                                        'total_h_m',
                                                        'total_alumnos_paralelos',
                                                        'totalRecaudadoPorMes',
                                                        'cantidadHMPorEdad',
                                                        'cantidadAlumnosEdad',
                                                        'alumnosActivos',
                                                        'profesionalesActivos',
                                                        'totalGrados',
                                                        'totalRutas',
                                                        'actividadesGenerales',
                                                        'comunicados',
                                                        'publicacionesBlog'
            )); 
        }

        
    }
}
