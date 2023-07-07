<?php

namespace App\Http\Controllers;

use App\PreguntasFrecuentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Traits\Funciones;
use DB;

class PreguntasFrecuentesController extends Controller
{
    use Funciones;
/*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {

        $titulo = 'FAQ';

        $data = DB::table('preguntas_frecuentes')
            ->leftJoin('catalogos', 'preguntas_frecuentes.categoria_id', '=', 'catalogos.id')
            ->select(
                    'preguntas_frecuentes.*',
                    'catalogos.nombre AS nom_categoria',
                    DB::raw('(CASE WHEN preguntas_frecuentes.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
            ->where('preguntas_frecuentes.status','!=', 3 )
            ->orderByRaw('preguntas_frecuentes.id ASC')
            ->get();    

        return view ('faq.index')->with (compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/
    
    public function create()
    {
        $titulo = 'FAQ';

        $categorias = DB::table('catalogos')
                ->select('id', 'nombre')
                ->where('empresa_id', Auth::user()->empresa_id)
                ->where('generalidad_id', 25)
                ->where('status', 1)
                ->orderByRaw('id ASC')
                ->get();

        return view ('faq.create')->with (compact('titulo', 'categorias'));
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
        $data = PreguntasFrecuentes::create($request->all());

        if ($request->file('archivo')) {
            $path = Storage::disk('public')->put('documentos',$request->file('archivo'));
            $data->fill(['archivo'=>asset($path)])->save();
        }

        return redirect ('admin/faq')->with('success', 'Registro creado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| show
|--------------------------------------------------------------------------
|
*/
    public function show($id = null)
    {

        $titulo = 'FAQ';

        $categorias = DB::table('preguntas_frecuentes')
                    ->leftJoin('catalogos', 'preguntas_frecuentes.categoria_id', '=', 'catalogos.id')
                    ->select('preguntas_frecuentes.categoria_id', 'catalogos.nombre AS nom_categoria')
                    ->where('preguntas_frecuentes.empresa_id', Auth::user()->empresa_id )
                    ->where('preguntas_frecuentes.status', 1 )
                    ->where('catalogos.generalidad_id', 25 )
                    ->where('catalogos.status', 1 )
                    ->orderByRaw('catalogos.nombre ASC')
                    ->distinct('catalogos.nombre')
                    ->get();


        if ($id) //Visualiza la información de una categoría
        {

           $textos = DB::table('preguntas_frecuentes')
                    ->where('categoria_id', $id )
                    ->where('empresa_id', Auth::user()->empresa_id)
                    ->where('status', 1 )
                    ->orderByRaw('id ASC')
                    ->get();  

        } else { // Visualiza la información general

            $textos = DB::table('preguntas_frecuentes')
                    ->where('categoria_id', $categorias[0]->categoria_id)
                    ->where('empresa_id', Auth::user()->empresa_id)
                    ->where('status', 1 )
                    ->orderByRaw('id ASC')
                    ->get(); 
        }



        return view ('faq.show')->with(compact('titulo', 'textos', 'categorias'));
    }

/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/
    public function edit($id)
    {
        $titulo = 'FAQ';

        $data = PreguntasFrecuentes::find($id); 

        $categorias = DB::table('catalogos')
                ->select('id', 'nombre')
                ->where('empresa_id', Auth::user()->empresa_id)
                ->where('generalidad_id', 25)
                ->where('status', 1)
                ->orderByRaw('id ASC')
                ->get();

        return view ('faq.edit')->with(compact('data', 'categorias', 'titulo'));
    }

/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/

    public function update(Request $request, $id)
    {
        $data = PreguntasFrecuentes::find($id);
        $data->categoria_id = $request->input('categoria_id');
        $data->nombre = $request->input('nombre');
        $data->descripcion= $request->input('descripcion');        
        $data->user_update = Auth::id();
        $data->save();

        if ($request->file('archivo')) {
            $path = Storage::disk('public')->put('documentos',$request->file('archivo'));
            $data->fill(['archivo'=>asset($path)])->save();
        }
        
        return redirect ('admin/faq')->with('success', 'Registro creado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = PreguntasFrecuentes::find($id);
        $data->status = '3'; //Eliminado
        $data->save();

        return redirect ('admin/faq')->with('success', 'Registro activado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| active
|--------------------------------------------------------------------------
|
*/

    public function active($id) 
    {
        $data = PreguntasFrecuentes::find($id);
        $data->status = '1'; //Activo
        $data->save();

        return redirect ('admin/faq')->with('success', 'Registro activado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| inactive
|--------------------------------------------------------------------------
|
*/

    public function inactive($id) 
    {

        $data = PreguntasFrecuentes::find($id);
        $data->status = '2';//Inactivo
        $data->save();

        return redirect ('admin/faq')->with('success', 'Registro inactivado exitosamente');
    }
}

