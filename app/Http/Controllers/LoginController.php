<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Redirect;

class LoginController extends Controller
{

 
    public function index(){
        if(Auth::check()){
            return redirect()->route('perfilC');
        }  
         /* return view('auth.login');   */
         return redirect()->route('xddd');

    }

    public function login(LoginRequest $request){
        /* dd($request); */
        $i = 0;
        if(!Auth::validate($request->only('email','password'))){
            /* return redirect()->to('login')->withErrors('Credenciales Incorrectas '); ///// CHECAR ESTE DESMADRE */
            return back()->with("msj",'El correo o la contraseña son erroneas');
        }
        $user=Auth::getProvider()->retrieveByCredentials($request->only('email','password'));
        Auth::login($user);

        $persona = (string) auth()->user()['name'];


      

       

    try {


/* "SELECT  p.id_rol, 
        p.id_persona,
        p.id_estacion,
        p.id_estado,
        u.foto,
        p.id_jlaboral ,
        p.id_hcomida, 
        p.id_hdescanso,
        u.nombre,
        u.id_usuario,
    
        e.descripcion AS estacion,
        est.descripcion AS estado,       
         jl.entrada || '-' || jl.salida AS jlaborals,      
        hc.entrada || '-' || hc.salida AS hcomidas,
        hd.entrada || '-' || hd.salida AS hdescansos 

        FROM historico_asignacion p
        JOIN usuarios u ON p.id_usuarios = u.id_usuario
        JOIN estaciones e ON p.id_estacion = e.id
        JOIN estados est ON p.id_estado = est.id_estado
        JOIN jlaborals jl ON p.id_jlaboral = jl.id
        JOIN hcomidas hc ON p.id_hcomida = hc.id
        JOIN hdescansos hd ON p.id_hdescanso = hd.id where  u.nombre  ='$persona'");
 */


        $query = DB::select(query: "SELECT  r.name AS id_rol, 
        p.id_persona,
        p.id_estacion,
        p.id_estado,
        u.foto,
        p.id_jlaboral ,
        p.id_hcomida, 
        p.id_hdescanso,
        u.nombre,
        u.id_usuario,   
        e.descripcion AS estacion,
        est.descripcion AS estado,
        jl.entrada || '-' || jl.salida AS jlaborals,      
        hc.entrada || '-' || hc.salida AS hcomidas,
        hd.entrada || '-' || hd.salida AS hdescansos 

        FROM historico_asignacion p
        JOIN roles r ON p.id_rol=r.id
        JOIN usuarios u ON p.id_usuarios = u.id_usuario
        JOIN estaciones e ON p.id_estacion = e.id
        JOIN estados est ON p.id_estado = est.id_estado  
        JOIN jlaborals jl ON p.id_jlaboral = jl.id
        JOIN hcomidas hc ON p.id_hcomida = hc.id      
        JOIN hdescansos hd ON p.id_hdescanso = hd.id where u.id_usuario ='$persona'");


        Session::put('id_usuario',$query[$i]->id_usuario); 
        Session::put('nombre',$query[$i]->nombre); 
        Session::put('estacion',$query[$i]->estacion); 
        Session::put('jlaborals',$query[$i]->jlaborals); 
        Session::put('hcomidas',$query[$i]->hcomidas); 
        Session::put('foto',$query[$i]->foto); 
        Session::put('hdescansos',$query[$i]->hdescansos);  
        Session::put('id_rol',$query[$i]->id_rol); 
        Session::put('id_persona',$query[$i]->id_persona); 
        Session::put('id_estado',$query[$i]->id_estado); 
        

         return redirect()->route('perfilC'); 


    } catch (\Throwable $th) {
        /* dd($th); */
       /*  return redirect()->to('login')->withErrors('Credenciales Incorrectas ');  *////// CHECAR ESTE DESMADRE
          return back()->with("msj",'Hubo un error al Iniciar Sesión '); 
    }



         
       


     


        

    }
}
