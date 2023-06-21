<?php

namespace App\Http\Controllers;

use App\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ModelosRequest;
use App\Traits\Funciones;
use DB;

class ModeloController extends Controller
{
    use Funciones;
/*
}
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {
        $permiso = $this->permisos(Auth::id()); 
        
        if ($permiso == 1) { //Administrador general

            $data = DB::table('modelos')
            ->leftJoin('marcas', 'modelos.marca_id', '=', 'marcas.id')
            ->select(
                'modelos.*',
                'marcas.nombre as nom_marca',
                DB::raw('(CASE WHEN modelos.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
            ->where('modelos.status', '<>', 3 )
            ->orderByRaw('modelos.id ASC')
            ->get();

        }elseif($permiso == 2){ //Piloto

            $data = DB::table('modelos')
            ->leftJoin('marcas', 'modelos.marca_id', '=', 'marcas.id')
            ->select(
                'modelos.*',
                'marcas.nombre as nom_marca',
                DB::raw('(CASE WHEN modelos.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
            ->where('modelos.user_create', Auth::id())
            ->where('modelos.status', '<>', 3 )
            ->orderByRaw('modelos.id ASC')
            ->get();
        }
        
        $titulo = 'Modelos';

        return view('modelos.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $permiso = $this->permisos(Auth::id()); 
        
        if ($permiso == 1) { //Administrador general

            $marcas = DB::table('marcas')->select('marcas.*')->where('status', 1 )->get();

        }elseif($permiso == 2){ //Piloto

            $marcas = DB::table('marcas')->select('marcas.*')->where('user_create', Auth::id())->where('status', 1 )->get();
        }

        $titulo = 'Modelos';

        return view('modelos.create', compact('titulo', 'marcas'));
    }


/*
|--------------------------------------------------------------------------
| store
|--------------------------------------------------------------------------
|
*/
    public function store(ModelosRequest $request)
    {

        $request['user_create'] = Auth::id();
        $data = Modelo::create($request->all());

        return redirect ('admin/modelos')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {
        $permiso = $this->permisos(Auth::id()); 

        $data = Modelo::find($id); 
        
        if ($permiso == 1) { //Administrador general

            $marcas = DB::table('marcas')->select('marcas.*')->where('status', 1 )->get();

        }elseif($permiso == 2){ //Piloto

            $this->authorize('view', $data);

            $marcas = DB::table('marcas')->select('marcas.*')->where('user_create', Auth::id())->where('status', 1 )->get();
        }      
        $titulo = 'Modelos';

        return view ('modelos.edit')->with (compact('data', 'titulo', 'marcas'));
    }



/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(ModelosRequest $request, $id)
    {
        $data = Modelo::find($id);         

        $permiso = $this->permisos(Auth::id()); 

        if($permiso == 2){ //Piloto
             
            $this->authorize('view', $data);        
        } 

        $request['user_update'] = Auth::id();
        $datos = Modelo::find($id)->update($request->all());

        return redirect ('admin/modelos')->with('success', 'Registro actualizado exitosamente');
    }



/*
|--------------------------------------------------------------------------
| Activar publicación
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Modelo::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/modelos');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicación
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {       

        $data = Modelo::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/modelos');
    }

/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

public function destroy($id)
{
    $data = Modelo::find($id);
    $data->status = 3;
    $data->user_update = Auth::id();
    $data->save();

    return redirect ('admin/modelos')->with('eliminar', 'ok');
}
}