<?php

namespace App\Http\Controllers;

use App\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use DB;

class BlogsController extends Controller
{

    public static function fechaCastellano ($fecha, $opcion) {
      $fecha = substr($fecha, 0, 10);
      $numeroDia = date('d', strtotime($fecha));
      $dia = date('l', strtotime($fecha));
      $mes = date('F', strtotime($fecha));
      $anio = date('Y', strtotime($fecha));
      $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "S谩bado", "Domingo");
      $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
      $nombredia = str_replace($dias_EN, $dias_ES, $dia);
      $meses_ES = array("Ene", "Feb", "Mar", "Abr", "Mayo", "Jun", "Jul", "Ago", "Sept", "Oct", "Nov", "Dic");
      $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
      $nombreMes = str_replace($meses_EN, $meses_ES, $mes);

      if ($opcion == 1) {
          return $numeroDia;
      }elseif ($opcion == 2){
          return $nombreMes;
      }elseif ($opcion == 3){
          return $anio;  
      }else{
          return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;  
      }

    }

/*
|--------------------------------------------------------------------------
| Permisos
|--------------------------------------------------------------------------
|
*/
    public function permisos($id)
    {

        $rol = DB::table('role_user')
                ->select('id')
                ->where('role_id', 1)  //Administrador general
                ->where('user_id', $id)
                ->count();

        $rol2 = DB::table('role_user')
                ->select('id')
                ->where('role_id', 2)  //Administrador de la tienda
                ->where('user_id', $id)
                ->count();

        if ($rol>0) {
           return 1;
        }elseif($rol2>0){
            return 2;
        }else{
            return 3;
        }

   }
    /*
|--------------------------------------------------------------------------
| index
|--------------------------------------------------------------------------
|
*/

    public function index()
    {
        //$permiso = $this->permisos(Auth::id());
        $titulo = 'Blog';
        
        $data = DB::table('blogs')
                ->leftJoin('users', 'blogs.user_create', '=', 'users.id')
                ->leftJoin('users AS users2', 'blogs.user_update', '=', 'users2.id')
                ->leftJoin('catalogos', 'blogs.categoria_id', '=', 'catalogos.id')
                ->select(
                    'blogs.*',
                    'catalogos.nombre AS nom_categoria',
                    DB::raw('CONCAT(users.name, " ", users.last) AS creo'),
                    DB::raw('CONCAT(users2.name, " ", users2.last) AS actualizo'),
                    DB::raw('(CASE WHEN blogs.status = 1 THEN "Activo" ELSE "Inactivo" END) AS estado_elemento'))
                ->where('blogs.status', '<>', 3 )
                ->where('blogs.empresa_id', Auth::user()->empresa_id )
                ->orderByRaw('blogs.id DESC')
                ->get();
        
        return view('blogs.index', compact('data', 'titulo')); 
    }


/*
|--------------------------------------------------------------------------
| create
|--------------------------------------------------------------------------
|
*/

    public function create()
    {

        $titulo = 'Blog'; 
            
        $categorias = DB::table('catalogos')
                    ->select('id', 'nombre')
                    ->where('status', 1 )
                    ->where('generalidad_id', 27 )
                    ->orderByRaw('nombre ASC')
                    ->get();

        return view('blogs.create', compact('titulo', 'categorias'));

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
        $data = Blogs::create($request->all());

        if ($request->file('imagen')) {
            $path = Storage::disk('public')->put('images',$request->file('imagen'));
            $data->fill(['imagen'=>asset($path)])->save();
        }        

        return redirect ('admin/blog')->with('success', 'Registro creado exitosamente');

    }


/*
|--------------------------------------------------------------------------
| edit
|--------------------------------------------------------------------------
|
*/

    public function edit($id)
    {

        $data = Blogs::find($id); 

        $titulo = 'Blog'; 

        $categorias = DB::table('catalogos')
                    ->select('id', 'nombre')
                    ->where('status', 1 )
                    ->where('generalidad_id', 27 )
                    ->orderByRaw('nombre ASC')
                    ->get();            

            return view ('blogs.edit')->with (compact('data', 'titulo', 'categorias'));
        
    }



/*
|--------------------------------------------------------------------------
| update
|--------------------------------------------------------------------------
|
*/
    public function update(Request $request, $id)
    {
        
        $data = Blogs::find($id);
        $data->titulo = $request->input('titulo');
        $data->slug = $request->input('slug');
        $data->texto = $request->input('texto');
        $data->keywords = $request->input('keywords');
        $data->categoria_id = $request->input('categoria_id');
        $data->user_update = Auth::id();
        $data->save();

        if ($request->file('imagen')) {
            $path = Storage::disk('public')->put('images',$request->file('imagen'));
            $data->fill(['imagen'=>asset($path)])->save();
        }
        
        return redirect ('admin/blog')->with('success', 'Registro actualizado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| destroy
|--------------------------------------------------------------------------
|
*/

    public function destroy($id)
    {
        $data = Blogs::find($id);
        $data->status = 3;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/blog')->with('eliminar', 'ok');
    }


/*
|--------------------------------------------------------------------------
| Activar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = Blogs::find($id);
        $data->status = 1;
        $data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/blog')->with('success', 'Registro activado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicaci贸n
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = Blogs::find($id);
        $data->status = 2;
        $data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/blog')->with('success', 'Registro inactivado exitosamente');
    }

/*
|--------------------------------------------------------------------------
| show
|--------------------------------------------------------------------------
|
*/

    public function show()
    {

        $data = DB::table('blogs')
                ->leftJoin('users', 'blogs.user_create', '=', 'users.id')
                ->leftJoin('catalogos', 'blogs.categoria_id', '=', 'catalogos.id')
                ->select(
                    'blogs.*',
                    'catalogos.nombre AS nom_categoria',
                    'users.imagen AS img_usuario',
                    DB::raw('CONCAT(users.name, " ", users.last) AS nom_usuario'),
                    DB::raw('DATE_FORMAT(blogs.created_at, "%d-%m-%Y") AS created_at'))
                ->where('blogs.status', 1)
                ->where('blogs.empresa_id', Auth::user()->empresa_id)
                ->orderByRaw('blogs.created_at DESC')
                ->get();

        $titulo = 'Entradas';

        return view('blogs.show', compact('data',  'titulo'));
    }

/*
|--------------------------------------------------------------------------
| Ver entrada
|--------------------------------------------------------------------------
|
*/

    public function show_entrada($id)
    {

        $data = DB::table('blogs')
                ->leftJoin('users', 'blogs.user_create', '=', 'users.id')
                ->leftJoin('catalogos', 'blogs.categoria_id', '=', 'catalogos.id')
                ->select(
                    'blogs.*',
                    'catalogos.nombre AS nom_categoria',
                    'users.imagen AS img_usuario',
                    DB::raw('CONCAT(users.name, " ", users.last) AS nom_usuario'),
                    DB::raw('DATE_FORMAT(blogs.created_at, "%d-%m-%Y") AS created_at'))
                ->where('blogs.id', $id)
                ->where('blogs.status', 1)
                ->where('blogs.empresa_id', Auth::user()->empresa_id)
                ->first();

        $titulo = 'Entradas';

        return view('blogs.ver', compact('data',  'titulo'));
    }
}


