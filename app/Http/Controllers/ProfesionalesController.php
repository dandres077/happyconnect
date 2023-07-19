<?php

namespace App\Http\Controllers;

use App\Profesionales;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;


class ProfesionalesController extends Controller
{
/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {

        $data = DB::table('profesionales')
                ->leftJoin('users', 'profesionales.usuario_id', '=', 'users.id')
                ->select(
                    'profesionales.*',
                    DB::raw('CONCAT(users.name, " ", users.last) AS nom_usuario'),
                    DB::raw('(CASE WHEN profesionales.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
                ->where('profesionales.status', 1)
                ->where('users.status', 1)
                ->where('profesionales.empresa_id', Auth::user()->empresa_id)
                ->orderByRaw('users.last ASC')
                ->get();

        $titulo = 'Profesionales';

        return view('profesionales.index', compact('data',  'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {

        $users = DB::select('SELECT id, CONCAT(name, " " , last) AS nombre
                                FROM users t1
                                WHERE empresa_id = ? AND
                                status = 1
                                AND NOT EXISTS (SELECT NULL
                                                    FROM profesionales t2
                                                    WHERE t2.usuario_id = t1.id) ORDER BY name', [Auth::user()->empresa_id]);


        $civiles = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 19 )->orderByRaw('nombre ASC')->get();
        $generos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 4 )->orderByRaw('nombre ASC')->get();
        $tipo_docs = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 2 )->orderByRaw('nombre ASC')->get();
        $titulo = 'Profesionales';

        return view('profesionales.create', compact('titulo', 'civiles', 'generos', 'tipo_docs', 'users'));
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
        $request['empresa_id'] = Auth::user()->empresa_id;
        $data = Profesionales::create($request->all());

        if ($request->file('imagen')) {
             $path = Storage::disk('public')->put('images',$request->file('imagen'));
             $data->fill(['imagen'=>asset($path)])->save();
        }

        return redirect ('admin/profesionales')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = Profesionales::find($id); 
        $civiles = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 19 )->orderByRaw('nombre ASC')->get();
        $generos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 4 )->orderByRaw('nombre ASC')->get();
        $tipo_docs = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 2 )->orderByRaw('nombre ASC')->get();

        $usuario = DB::table('users')
                    ->select(DB::raw('CONCAT(users.name, " ", users.last) AS nombre'))
                    ->first();

        $titulo = 'Profesionales';

        return view ('profesionales.edit')->with (compact('data', 'titulo', 'civiles', 'generos', 'tipo_docs', 'usuario'));
    }



/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {

        $data = Profesionales::find($id);
        $data->telefono = $request->input('telefono');
        $data->direccion = $request->input('direccion');
        $data->ciudad = $request->input('ciudad');
        $data->celular = $request->input('celular');
        $data->email = $request->input('email');
        $data->genero_id = $request->input('genero_id');
        $data->tipo_documento = $request->input('tipo_documento');
        $data->n_documento = $request->input('n_documento');
        $data->fecha_nacimiento = $request->input('fecha_nacimiento');
        $data->civil_id = $request->input('civil_id');
        $data->estudios = $request->input('estudios');
        $data->perfil = $request->input('perfil');
        $data->experiencia = $request->input('experiencia');
        $data->user_update = Auth::id();
        $data->save();

        if ($request->file('imagen')) {
             $path = Storage::disk('public')->put('images',$request->file('imagen'));
             $data->fill(['imagen'=>asset($path)])->save();
        }

        
        return redirect ('admin/profesionales')->with('success', 'Registro actualizado exitosamente');
    }



/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Profesionales::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/profesionales')->with('eliminar', 'ok');;
    }


/*
|--------------------------------------------------------------------------
| Activar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Profesionales::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/profesionales');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Profesionales::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/profesionales');
    }

/*
|--------------------------------------------------------------------------
| show
|--------------------------------------------------------------------------
|
*/

    public function show()
    {

        $data = DB::table('profesionales')
                ->leftJoin('users', 'profesionales.usuario_id', '=', 'users.id')
                ->select(
                    'profesionales.*',
                    DB::raw('CONCAT(users.name, " ", users.last) AS nom_usuario'))
                ->where('profesionales.status', 1)
                ->where('profesionales.empresa_id', Auth::user()->empresa_id)
                ->orderByRaw('users.last ASC')
                ->get();

        $titulo = 'Profesionales';

        return view('profesionales.show', compact('data',  'titulo'));
    }
}