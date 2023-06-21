<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $data = DB::select("select count(id) AS invoiced, 
                                        marcas.nombre customer
                                        from marcas
                                        where status = 1 and
                                        user_create = ?
                                        group by nombre", [Auth::id()]);
        
        $permiso = $this->permisos(Auth::id());

        return view('home')->with(compact('data', 'permiso'));
    }
}
