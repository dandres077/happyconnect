<?php

namespace App\Http\Controllers;

use App\Marcas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MarcasRequest;
use App\Traits\Funciones;
use DB;

class MarcasController extends Controller
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

            $data = DB::table('marcas')
                    ->select('marcas.*')
                    ->where('status', '<>', 3 )
                    ->orderByRaw('id ASC')
                    ->get();

        }elseif($permiso == 2){ //Piloto

            $data = DB::table('marcas')
                    ->select('marcas.*')
                    ->where('user_create', Auth::id())
                    ->where('status', '<>', 3 )
                    ->orderByRaw('id ASC')
                    ->get();        
        }        

        $titulo = 'Marcas';
        

        return view('marcas.index', compact('data', 'titulo'));
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {
        $titulo = 'Marcas';

        return view('marcas.create', compact('titulo'));
    }


/*
|--------------------------------------------------------------------------
| store
|--------------------------------------------------------------------------
|
*/
    public function store(MarcasRequest $request)
    {

        $request['user_create'] = Auth::id();
        $data = Marcas::create($request->all());

        return redirect ('admin/marcas')->with('success', 'Registro creado exitosamente');
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

        $data = Marcas::find($id);

        if($permiso == 2){ //Piloto
             
            $this->authorize('view', $data);        
        } 

        $titulo = 'Marcas';

        return view ('marcas.edit')->with (compact('data', 'titulo'));
    }



/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(MarcasRequest $request, $id)
    {

        $permiso = $this->permisos(Auth::id()); 

        $data = Marcas::find($id);

        if($permiso == 2){ //Piloto
             
            $this->authorize('view', $data);        
        } 

        $request['user_update'] = Auth::id();
        $datos = Marcas::find($id)->update($request->all());
        
        return redirect ('admin/marcas')->with('success', 'Registro actualizado exitosamente');
    }



/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Marcas::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
    
        return redirect ('admin/marcas');
    }


/*
|--------------------------------------------------------------------------
| Activar publicación
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Marcas::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
    
        return redirect ('admin/marcas');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicación
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Marcas::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/marcas');
    }
}
