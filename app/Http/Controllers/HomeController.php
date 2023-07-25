<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Matriculas;
use App\Traits\Funciones;
use DB;

class HomeController extends Controller
{

    use Funciones;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        return view('home');
    }




    public function d1()
    {

        $temporada_id = 1;


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


        //dd($total_alumnos_paralelos);

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

        $totalRecaudadoPorMes = DB::table('cobros')
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
                                ->groupBy('cobros.mes_id', 'catalogos.nombre')
                                ->get();

        //---------------------------------------------------------------------------------------------------------------------------------

 
        // Total pendiente por paralelo
        $totalPendientePorParalelo = DB::table('cobros')
                                    ->selectRaw('paralelo_id, SUM(valor) as total_pendiente')
                                    ->where('empresa_id', Auth::user()->empresa_id)
                                    ->where('temporada_id', $temporada_id)
                                    ->where('status', 2)
                                    ->groupBy('paralelo_id')
                                    ->get(); 


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



        return view('dashboard.home1')->with (compact(
                                            'total_h_m',
                                            'total_alumnos_paralelos',
                                            'totalRecaudadoPorMes',
                                            'totalPendientePorParalelo',
                                            'cantidadHMPorEdad',
                                            'cantidadAlumnosEdad',
                                            'alumnosActivos',
                                            'profesionalesActivos',
                                            'totalGrados',
                                            'totalRutas'
            ));

             

    }
}
