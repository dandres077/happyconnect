<?php

namespace App\Http\Controllers;

use App\Empresas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

class EmpresasController extends Controller
{
/*
|--------------------------------------------------------------------------
| Cifrado
|--------------------------------------------------------------------------
|
*/
    function encrypt_decrypt($action, $string) {

         $output = false; 
         $encrypt_method = "AES-256-CBC";
         $secret_key = 'DISC';
         $secret_iv = 'MAGISTER';   

         $key = hash('sha256', $secret_key);
         $iv = substr(hash('sha256', $secret_iv), 0, 16);
         
        if( $action == 'encrypt' ) {
           $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
           $output = base64_encode($output);
         }else if( $action == 'decrypt' ){
           $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
         
        return $output;      
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
        $data = DB::table('empresas')
            ->select(
                'empresas.*',
                DB::raw('(CASE WHEN status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
            ->where('id', Auth::user()->empresa_id )
            ->where('status', '<>', 3 )
            ->orderByRaw('id ASC')
            ->get();

        $titulo = 'Empresas';

        return view('empresas.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $titulo = 'Empresas';

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

        return view('empresas.create', compact(
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

        $request['user_create'] = Auth::id();
        $data = Empresas::create($request->all());
        
        if ($request->file('imagen')) {
             $path = Storage::disk('public')->put('images',$request->file('imagen'));
             $data->fill(['imagen'=>asset($path)])->save();
        }

        $data->grados()->sync($request->get('grados')); 

        return redirect ('admin/empresas')->with('success', 'Registro creado exitosamente');;
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = Empresas::find($id); 
        $titulo = 'Empresas';

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

        $grados = DB::table('grados')->select('id', 'nombre')->where('status', 1 )->orderByRaw('id ASC')->get();

        $g_c = DB::table('grados_empresas')
            ->select('empresa_id', 'grado_id')
            ->where('empresa_id', $id)
            ->get();

        $validador = count($g_c);

        return view('empresas.edit', compact(
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
                                                'grados',
                                                'g_c',
                                                'validador')
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

        $data = Empresas::find($id);
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

        $data->grados()->sync($request->get('grados')); 

        
        return redirect ('admin/empresas')->with('success', 'Registro actualizado exitosamente');;
    }



/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Empresas::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/empresas');
    }


/*
|--------------------------------------------------------------------------
| Activar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Empresas::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/empresas');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Empresas::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/empresas');
    }


/*
|--------------------------------------------------------------------------
| API -> Busqueda de departamentos por país
|--------------------------------------------------------------------------
|
*/

    public function departamentos($pais_id)
    {
        $departamentos = DB::table('departamentos')
                        ->select('id', 'nombre')
                        ->where('pais_id', $pais_id )
                        ->get();

        return $departamentos;
    }


/*
|--------------------------------------------------------------------------
| API -> Busqueda de ciudades por departamento
|--------------------------------------------------------------------------
|
*/

    public function ciudades($departamento_id)
    {
        $ciudades = DB::table('ciudades')
                        ->select('id', 'nombre')
                        ->where('departamento_id', $departamento_id )
                        ->get();

        return $ciudades;
    }
}