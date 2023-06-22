<?php

namespace App\Http\Controllers;

use App\EmpresasSedes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

class EmpresasSedesController extends Controller
{
/*
}
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {
        $data = DB::table('empresas_sedes')
            ->select(
                'empresas_sedes.*',
                DB::raw('(CASE WHEN status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
            ->where('empresa_id', Auth::user()->empresa_id )
            ->where('status', '<>', 3 )
            ->orderByRaw('id ASC')
            ->get();

        $titulo = 'Sedes';

        return view('sedes.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $titulo = 'Sedes';

        $paises = DB::table('paises')->select('id', 'nombre')->where('status', 1 )->orderByRaw('nombre ASC')->get();
        $dptos = DB::table('departamentos')->select('id', 'nombre')->where('pais_id', $paises[0]->id )->where('status', 1 )->orderByRaw('nombre ASC')->get();
        $ciudades = DB::table('ciudades')->select('id', 'nombre')->where('departamento_id', $dptos[0]->id )->where('status', 1 )->orderByRaw('nombre ASC')->get();
        $estratos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 10 )->orderByRaw('nombre ASC')->get();
        $sectores = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 9 )->orderByRaw('nombre ASC')->get();
        $zonas = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 11 )->orderByRaw('nombre ASC')->get();
        $calendarios = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 5 )->orderByRaw('nombre ASC')->get();
        $jornadas = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 8 )->orderByRaw('nombre ASC')->get();
        $generos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 7 )->orderByRaw('nombre ASC')->get();
        $grados = DB::table('grados')->select('id', 'nombre')->where('status', 1 )->orderByRaw('id ASC')->get();

        return view('sedes.create', compact(
                                                'titulo', 
                                                'paises', 
                                                'dptos', 
                                                'ciudades', 
                                                'estratos', 
                                                'sectores', 
                                                'zonas', 
                                                'calendarios', 
                                                'jornadas', 
                                                'generos',
                                                'grados')
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

        $request['empresa_id'] = Auth::user()->empresa_id;
        $request['user_create'] = Auth::id();
        $data = EmpresasSedes::create($request->all());
        
        if ($request->file('imagen')) {
             $path = Storage::disk('public')->put('images',$request->file('imagen'));
             $data->fill(['imagen'=>asset($path)])->save();
        }

        //$data->grados()->sync($request->get('grados')); 

        return redirect ('admin/sedes')->with('success', 'Registro creado exitosamente');;
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = EmpresasSedes::find($id); 

        $titulo = 'Sedes';

        $paises = DB::table('paises')->select('id', 'nombre')->where('status', 1 )->orderByRaw('nombre ASC')->get();
        $dptos = DB::table('departamentos')->select('id', 'nombre')->where('status', 1 )->orderByRaw('nombre ASC')->get();
        $ciudades = DB::table('ciudades')->select('id', 'nombre')->where('status', 1 )->orderByRaw('nombre ASC')->get();
        $estratos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 10 )->orderByRaw('nombre ASC')->get();
        $sectores = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 9 )->orderByRaw('nombre ASC')->get();
        $zonas = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 11 )->orderByRaw('nombre ASC')->get();
        $calendarios = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 5 )->orderByRaw('nombre ASC')->get();
        $jornadas = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 8 )->orderByRaw('nombre ASC')->get();
        $generos = DB::table('catalogos')->select('id', 'nombre')->where('status', 1 )->where('generalidad_id', 7 )->orderByRaw('nombre ASC')->get();
        $grados = DB::table('grados')->select('id', 'nombre')->where('status', 1 )->orderByRaw('id ASC')->get();

        return view('sedes.edit', compact(
                                                'data',
                                                'titulo', 
                                                'paises', 
                                                'dptos', 
                                                'ciudades', 
                                                'estratos', 
                                                'sectores', 
                                                'zonas', 
                                                'calendarios', 
                                                'jornadas', 
                                                'generos',
                                                'grados')
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

        $data = EmpresasSedes::find($id);
        $data->nombre = $request->input('nombre');
        $data->documento = $request->input('documento');
        $data->pais_id = $request->input('pais_id');
        $data->departamento_id = $request->input('departamento_id');  
        $data->ciudad_id = $request->input('ciudad_id'); 
        $data->estrato_id = $request->input('estrato_id');
        $data->sector_id = $request->input('sector_id');
        $data->zona_id = $request->input('zona_id');
        $data->calendario_id = $request->input('calendario_id');
        $data->jornada_id = $request->input('jornada_id');
        $data->genero_id = $request->input('genero_id');
        $data->direccion = $request->input('direccion');
        $data->telefono = $request->input('telefono');
        $data->celular = $request->input('celular');
        $data->email = $request->input('email');
        $data->rector = $request->input('rector');
        $data->texto = $request->input('texto');        
        $data->user_update = Auth::id();
        $data->save();

        if ($request->file('imagen')) {
            $path = Storage::disk('public')->put('images',$request->file('imagen'));
            $data->fill(['imagen'=>asset($path)])->save();
        }
    
        return redirect ('admin/sedes')->with('success', 'Registro actualizado exitosamente');;
    }



/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = EmpresasSedes::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/sedes');
    }


/*
|--------------------------------------------------------------------------
| Activar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = EmpresasSedes::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/sedes');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = EmpresasSedes::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/sedes');
    }
}