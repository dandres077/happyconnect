<?php

namespace App\Http\Controllers;

use App\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Traits\Funciones;
use DB;


class ProveedoresController extends Controller
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
        $permiso = $this->permisos(Auth::id());  
 
        $titulo = 'Proveedores';

        $consulta = DB::table('proveedores')
                    ->select(
                            'proveedores.*', 
                            DB::raw('(CASE WHEN proveedores.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
                    ->where('proveedores.status', '<>', 3 )
                    ->orderByRaw('proveedores.id ASC');
        

        if($permiso == 2)
        {
            $consulta->where('proveedores.empresa_id', Auth::user()->empresa_id);

        }

        $data = $consulta->get();  
        
        return view ('proveedores.index')->with (compact('data', 'titulo'));
    }

/*
|--------------------------------------------------------------------------
| Create
|--------------------------------------------------------------------------
|
*/
    public function create()
    {
        $titulo = 'Proveedores';

        $empresas = DB::table('empresas')->where('id', Auth::user()->empresa_id)->orderByRaw('nombre ASC')->get();

        return view ('proveedores.create')->with (compact('empresas', 'titulo'));
    }

/*
|--------------------------------------------------------------------------
| Store
|--------------------------------------------------------------------------
|
*/
    public function store(Request $request)
    {

        $request['empresa_id'] = Auth::user()->empresa_id;
        $request['user_create'] = Auth::id();
        $data = Proveedores::create($request->all());

        return redirect ('admin/proveedores')->with('success', 'Registro creado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| Edit
|--------------------------------------------------------------------------
|
*/
    public function edit($id)
    {
        $data = Proveedores::find($id);

        $titulo = 'Proveedores';


        return view ('proveedores.edit')->with (compact('data', 'titulo'));
    }

/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {
        $request['user_update'] = Auth::id();

        $datos = Proveedores::find($id)->update($request->all());

        return redirect ('admin/proveedores')->with('success', 'Registro actualizado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| Destroy
|--------------------------------------------------------------------------
|
*/
    public function destroy($id)
    {
        $data = Proveedores::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/proveedores')->with('eliminar', 'ok');
    }

/*
|--------------------------------------------------------------------------
| Activar
|--------------------------------------------------------------------------
|
*/
    public function active($id) 
    {
        $data = Proveedores::find($id);
        $data->status = '1'; //Activo
        $data->save();

        return redirect ('admin/proveedores')->with('success', 'Registro activado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| Inactivar
|--------------------------------------------------------------------------
|
*/
    public function inactive($id) 
    {

        $data = Proveedores::find($id);
        $data->status = '2';//Inactivo
        $data->save();

        return redirect ('admin/proveedores')->with('success', 'Registro inactivado exitosamente');
    }
}

