<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
Use App\Mail\CorreoElectronico;
Use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



use function Laravel\Prompts\select;

class PersonalController extends Controller
{
    public function __construct() {
       
         $this->middleware('permission:personal',['only',['index','create','store','show','edit','update','destroy','Vistaformato']]);
        $this->middleware('permission:perfilpersonal',['only',['index','create','store','show','edit','update','destroy']]);
        $this->middleware('permission:perfilpasw',['only',['perfilC']]); 

       
     }

    public function index()
    {   
        $query = DB::select("SELECT  r.name AS id_rol, 
        p.id_persona,
        p.id_estacion,
        p.id_estado,
        u.foto,
        p.id_jlaboral ,
        p.id_hcomida, 
        p.id_hdescanso,
        p.id_usuarios,
        u.nombre,
        
    
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
        JOIN hdescansos hd ON p.id_hdescanso = hd.id AND p.id_estado != 6");

         $roles = DB::select("select * from roles");
         
         $estacion=DB::select("SELECT es.id,es.descripcion,es.id_area, a.descripcion AS area,es.id_ip, i.descripcion AS ip,es.asignado FROM estaciones es JOIN areas a ON es.id_area = a.id JOIN i_p_s i ON es.id_ip = i.id AND es.asignado =2");
         $jlaborals = DB::select("select j.id,j.id_dias, j.salida,j.entrada,d.descripcion from jlaborals j JOIN dias d ON d.id_dias=j.id_dias");
         $hcomidas = DB::select("select * from hcomidas");
         $hdescansos = DB::select("select * from hdescansos");

         // configuracion de contraseña
         $comb = "abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPRSTUVWXYZ23456789";
            $shfl = str_shuffle($comb);
             $pwd = substr($shfl,0,8);

        
        

        return view('personal.index')
        ->with("personal",$query)
        ->with("roles",$roles)
        ->with("estacion",$estacion)
        ->with("jlaborals",$jlaborals)
        ->with("hcomidas",$hcomidas)
        ->with("hdescansos",$hdescansos)
        ->with("pwd",$pwd);  


    }
   
    /**
     * Show the form for creating a new resource.
     */



    public function create()
    {
        return view('personal.create');
    }

    public function password(){

        return view('personal/password'/* ,['personal'=>$query] */);  
    }
    public function createpassword(Request $request){

    return view('personal/createpassword'/* ,['personal'=>$query] */);  
}




    public function perfilC()
    {
       
        
        
        
       
        $query=session('foto');

       /*  dd($query); */
    
 
         return view('personal/perfilC' ,['personal'=>$query] );  
        
        /*   */

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
       
           $validator = Validator::make(
            $request->all(), 
            [
               'nombre' =>'required|max:60|unique:usuarios',
               'email'=>'required|unique:users',
            ]
        );
        if ($validator->fails()) {
           $message = 'Hubo un problema al guardar el registro: ';
           return redirect()->route('personal.index')->with('error', $message);   
           } 


        try {
            
            $personal=new Personal();
            $name=$personal->hanbleUploadImage($request->file('imagen'));

            

            
            DB::insert("INSERT INTO usuarios (id_usuario, foto, nombre, id_estado, created_at, updated_at) 
            VALUES (USUARIOS_ID_USUARIO_SEQ.NEXTVAL, '$name', '$request->nombre', 2, CURRENT_TIMESTAMP, NULL)");
 

           

            $creoregistro=session('id_usuario');
            $usuario = DB::select("SELECT MAX(ID_USUARIO) AS ultimo_id FROM USUARIOS");
            $id_usuario = $usuario[0]->ultimo_id; 


            $rol = DB::select("SELECT id from roles");
            $rol_id = $rol[0]->id;
           

           
            DB::insert("INSERT INTO historico_asignacion (id_persona, id_usuarios, id_rol, id_estacion, id_jlaboral, id_hcomida,
            id_hdescanso, id_estado, creoregistro, created_at, updated_at)VALUES (HISTORICO_ASIGNACION_ID_PERSON.NEXTVAL, $id_usuario, 
            '$rol_id',$request->estacion, $request->jlaboral,  $request->hcomida, $request->hdescanso, 2, '$creoregistro',CURRENT_TIMESTAMP, NULL)"); 


            DB::update("update estaciones SET asignado='3'  WHERE id='$request->estacion'"); 

 
            $user = User::create([
                            'name'=>$id_usuario,
                            'email' => $request->email,
                            'password' => bcrypt($request->password), 
                        ]); 
                        $user->assignRole($request->rol);    
            
            

            if($request->checkbox == "true") {
       
                // Envio de Credenciales mamalonas
                  Mail::to($request->email)
                    ->send(new CorreoElectronico($request->all()));  
            }  
 
             
            $message='El personal fue agregado';
            return redirect()->route('personal.index')->with('success',$message);   

        } catch (\Throwable $th) {
            $message = 'Hubo un problema al guardar el registro: ';
            return redirect()->route('personal.index')->with('error', $message);   
        } 
          
     
    } 

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $query = DB::select(query: "SELECT  p.id_rol, 
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
        JOIN hdescansos hd ON p.id_hdescanso = hd.id where p.id_persona ='$id'");

        $estacion=DB::select("SELECT es.id,es.descripcion,es.id_area, a.descripcion AS area,es.id_ip, i.descripcion AS ip,es.asignado FROM estaciones es JOIN areas a ON es.id_area = a.id JOIN i_p_s i ON es.id_ip = i.id AND es.asignado =2");
        $jlaborals = DB::select("select * from jlaborals");
        $hcomidas = DB::select("select * from hcomidas");
        $hdescansos = DB::select("select * from hdescansos");


        

         return view('personal.edit')
         ->with("personal",$query)       
         ->with("estacion",$estacion)
         ->with("jlaborals",$jlaborals)
         ->with("hcomidas",$hcomidas)
         ->with("hdescansos",$hdescansos)
        ; 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Perfil xDDD ahorita checamos lo del nombre
     */
    public function destroy(string $id)
    {
      

        try {
             DB::update("update usuarios SET id_estado=1 WHERE id_usuario=$id"); 
             DB::update("update historico_asignacion SET id_estado=1 WHERE id_usuarios=$id");  
             // falta query para liberar la estación

            return redirect()->route('personal.index');  
            
        } catch (\Throwable $th) {
            $message = 'Hubo un problema al eliminar el registro: ';
            return redirect()->route('personal.index')->with('error', $message);  
        }
         
        
       
       
    }


    
    public function Vistaformato(Request $request){
       
        
       $tipoReporte="me mame xDDDD";
      
        $personal = DB::select("SELECT  p.id_rol, 
        p.id_persona,
        p.id_estacion,
        p.id_estado,
        u.foto,
        p.id_jlaboral ,
        p.id_hcomida, 
        p.id_hdescanso,
        u.nombre,
        /* r.name, */
        e.descripcion AS estacion,
        est.descripcion AS estado,       
        jl.entrada || '-' || jl.salida AS jlaborals,      
        hc.entrada || '-' || hc.salida AS hcomidas,
        hd.entrada || '-' || hd.salida AS hdescansos

        FROM historico_asignacion p
        /* JOIN roles r ON p.id_rol=r.id */
        JOIN usuarios u ON p.id_usuarios = u.id_usuario
        JOIN estaciones e ON p.id_estacion = e.id
        JOIN estados est ON p.id_estado = est.id_estado
        JOIN jlaborals jl ON p.id_jlaboral = jl.id
        JOIN hcomidas hc ON p.id_hcomida = hc.id
        JOIN hdescansos hd ON p.id_hdescanso = hd.id WHERE p.id_estado=2");

                                
          

          
               
           $pdfu = Pdf::loadView('plantillas/Pruebapdf' ,compact('personal') );
            
            $pdfu->set_paper('a4', 'landscape');
            $pdfu->render();           
            return $pdfu->stream();     
    
   
}


public function actualizarF(Request $request)
    {

        try {
            
              $personal=new Personal();
             $foto=$personal->hanbleUploadImage($request->file('imagenA')); 

              
          

            DB::update("update usuarios SET foto='$foto' WHERE id_usuario=$request->id_usuarios");
           
             
            $message='Actualización Correcta';
            return redirect()->route('personal.index')->with('success',$message);    

        } catch (\Throwable $th) {
             $message = 'Hubo un problema al guardar el registro: ';
            return redirect()->route('personal.index')->with('error', $message);   
        }  
          
     
    } 



    
}