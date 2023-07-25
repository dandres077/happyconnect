<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsuariosRequest;
use App\Http\Requests\UsuariosUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Traits\Funciones;
use App\User;
use DB;
use Hash;

class UserController extends Controller
{
    use Funciones; //Viene de Traits


/*-- ----------------------------
-- Función Random
-- ----------------------------*/

    function generarCodigo($longitud) 
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$';
        $max = strlen($caracteres) - 1;
        $codigo = '';
    
        for ($i = 0; $i < $longitud; $i++) {
            $aleatorio = mt_rand(0, $max);
            $caracter = $caracteres[$aleatorio];
            $codigo .= $caracter;
        }
    
        return $codigo;
    }
    
    public function eliminarSlash($cadena) 
    {
        return str_replace('/', '', $cadena);
    }

/*-- ----------------------------
-- Index
-- ----------------------------*/

     public function index() 
    {

        //$data = User::all();

        $data = DB::table('users')
                    ->select('users.*')
                    ->where('empresa_id', Auth::user()->empresa_id)
                    ->orderByRaw('id ASC')
                    ->get();

        return view ('usuarios.index')->with (compact('data'));

    }


/*-- ----------------------------
-- Create
-- ----------------------------*/

    public function create() 
    {

        $roles = Role::get();

        return view ('usuarios.create')->with (compact('roles'));

    }

/*-- ----------------------------
-- Store
-- ----------------------------*/
    public function store(Request $request) 
    {

    	$user = new User();
        $user->empresa_id = Auth::user()->empresa_id;
        $user->name = $request->input('name');
        $user->last = $request->input('last');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->imagen = 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png';
    	$user->save();

        $user->roles()->sync($request->get('roles'));        

        return redirect ('admin/usuarios')->with('success', 'Registro creado exitosamente');
    }


/*-- ----------------------------
-- Edit
-- ----------------------------*/
    public function edit($id) 
    {
        $user = User::find($id);        
        $roles = Role::get();
        $rol_user = DB::table('model_has_roles')
            ->select('model_has_roles.*')
            ->where('model_id', '=', $id)
            ->get();

        return view ('usuarios.edit')->with(compact('user', 'roles', 'rol_user', 'id'));
    }


/*-- ----------------------------
-- Update
-- ----------------------------*/
    public function update(Request $request, $id)
    {

    	$user = User::find($id);
        $user->name = $request->input('name');
        $user->last = $request->input('last');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $user->roles()->sync($request->get('roles'));        

        return redirect ('admin/usuarios')->with('success', 'Registro creado exitosamente');
    }



/*-- ----------------------------
-- Destroy
-- ----------------------------*/
    public function destroy($id) 
    {
        $user = User::find($id);
        $user->status = 3;
        $user->save();
        return back();
    }


/*-- ----------------------------
-- Show
-- ----------------------------*/

     public function show() 
    {
        $users = DB::table('users')
            ->select('users.*')
            ->where('users.id', Auth::id())
            ->get();

        return view ('usuarios.show')->with (compact('users'));
    }


/*-- ----------------------------
    -- Edit Perfil
    -- ----------------------------*/
    public function editarperfil($id) 
    {
        if ($id != Auth::id())
        return redirect('perfil');

        $user = User::find($id); 

        return view ('usuarios.editperfil')->with(compact('user'));
    }


/*-- ----------------------------
-- Update Perfil
-- ----------------------------*/
    public function updateperfil(Request $request, $id)
    {      
        if ($id != Auth::id())
        return redirect('perfil');    

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->last = $request->input('last');
        $user->save();
        
        if ($request->file('imagen')) {
            $path = Storage::disk('public')->put('img/users',$request->file('imagen'));
            $user->fill(['imagen'=>asset($path)])->save();
        }

        //$idioma = session(['lang' => Auth::user()->lang]);

        return redirect ('admin/perfil')->with('success', 'Perfil actualizado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| Activar publicación
|--------------------------------------------------------------------------
|
*/

    public function active($id)
    {

        $data = User::find($id);
        $data->status = 1;
        //$data->user_update = Auth::id();
        $data->save();
  
        return redirect ('admin/usuarios')->with('success', 'Registro activado exitosamente');
    }


/*
|--------------------------------------------------------------------------
| Desactivar publicación
|--------------------------------------------------------------------------
|
*/

    public function inactive($id)
    {
        $data = User::find($id);
        $data->status = 2;
        //$data->user_update = Auth::id();
        $data->save();

        return redirect ('admin/usuarios')->with('success', 'Registro inactivado exitosamente');
    }

/*-- ----------------------------
-- Cambio de contraseña
-- ----------------------------*/
    public function pwd(Request $request)
    {

        $user = User::find($request->input('user_id'));
        $user->password = bcrypt($request->input('password'));
        $user->save();


        return redirect ('admin/usuarios')->with('success', 'Contraseña actualizada exitosamente');
    }

/*-- ----------------------------
-- Recuperar - Vista
-- ----------------------------*/
    public function recuperar() 
    {   
        return view ('auth.recuperar');
    }

/*-- ----------------------------
-- Recuperar: envio de email con token 
-- ----------------------------*/
    public function recuperar_envio(Request $request)  
    {   

        $user = User::where('email', $request->input('email'))->first();

        if (! $user)
        return redirect ('login')->with('danger', 'El email ingresado no existe en nuestras bases de datos');

        $token = $this->generarCodigo(6);
        $token = bcrypt($token);
        $token = $this->eliminarSlash($token);
        
        $user->remember_token = $token; // Eliminar los / del hash generado
        $user->save();

        
        $usuario = DB::table('users')->select('name', 'email')->where('email', $request->input('email'))->first();
        
        $data = array(
                    $usuario->name, //Nombre del usuario
                    $token,         //Token
                    $usuario->email //Email
        );
        

        $empresa = array(
                        "iDaves Ingeniería",
                        "https://idaves.com",
                        "3188482206 - 3186932083",
                        "comercial@idaves.com"
        );

        Mail::send('emails/recuperar_pwd', compact('data', 'empresa'), function($message)use ($data){
            $message->from('notificaciones@idaves.com', 'Sistema de notificaciones iDaves.com');
            $message->to($data[2])->bcc(['davidcontreras07@gmail.com'])->subject('Recuperación de contraseña');

        });

        return redirect('/login')->with('success', 'Se te ha enviado un email para completar el proceso, valida tu SPAM.');
    }



/*-- ----------------------------
-- Contraseña Nueva - Vista
-- ----------------------------*/
    public function recuperar_pwd($token) 
    {   

        $user = User::where('remember_token', $token)->first();

        if (! $user)
        return redirect ('login')->with('danger', 'No es posible continuar con el proceso, intentalo de nuevo');

        return view('auth.resetear')->with(compact('token'))->with('success', 'Ingresa una contraseña nueva para tu cuenta');

    }


/*-- ----------------------------
-- Contraseña Nueva - Vista
-- ----------------------------*/
    public function nueva_pwd(Request $request) 
    {   

        $user = User::where('remember_token', $request->input('token'))->first();
        if (! $user)
        return redirect ('login')->with('danger', 'No es posible continuar con el proceso, intentalo de nuevo');

        $user->password = bcrypt($request->input('password'));
        $user->remember_token = null;
        $user->save();
    
        return redirect('/login')->with('success', 'Has cambiado correctamente tu contraseña');

    }
}
