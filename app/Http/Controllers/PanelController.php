<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
Use App\Mail\CorreoElectronico;
Use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;
use PhpParser\Node\Stmt\TryCatch;

class PanelController extends Controller
{
    public function __construct() {
       
       /*  $this->middleware('permission:panel',['only',['index','create','store','show','edit','update','destroy']]); */
       
     }
    public function index()
    {
         
         try {
            $query = DB::select("SELECT  p.id_rol, 
                    p.id_persona,
                    p.id_usuarios,
                    p.id_estacion,
                    p.id_estado,
                    u.foto,
                    p.id_jlaboral ,   
                    p.id_hdescanso,
                    u.nombre,
                    e.descripcion AS estacion,
                    est.descripcion AS estado,    
                    d.id_dias AS dias,
                    jl.entrada || ' - ' || jl.salida AS jlaborals,      
                    hd.entrada || ' - ' || hd.salida AS hdescansos
                    FROM historico_asignacion p
                    JOIN usuarios u ON p.id_usuarios = u.id_usuario
                    JOIN estaciones e ON p.id_estacion = e.id
                    JOIN estados est ON p.id_estado = est.id_estado        
                    JOIN jlaborals jl ON p.id_jlaboral = jl.id       
                    JOIN hdescansos hd ON p.id_hdescanso = hd.id 
                    JOIN dias d ON jl.id_dias = d.id_dias
                    WHERE p.id_estado=2");
                
            
        } catch (\Throwable $th) {
            //throw $th;
        }

    return view('panel.index',['personal'=>$query]);

   
    
    } 




    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $asignacionesParaGuardar = [];

         foreach ($request->asignaciones as $asignacion) {
            [$personaId, $estacion, $area] = explode('|', $asignacion);

            $asignacionesParaGuardar[] = [
                'persona_id' => $personaId,
                'estacion' =>  $estacion  ,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Eliminar asignaciones anteriores (ajusta según tu lógica)
        DB::table('propuesta_asignacions')->delete();

        foreach ($request->asignaciones as $asignacion) {
            [$personaId, $estacion] = explode('|', $asignacion);

            DB::insert("INSERT INTO propuesta_asignacions (id, id_usuarios, id_estacion,created_at, updated_at) VALUES (PROPUESTA_ASIGNACIONS_ID_SEQ.NEXTVAL, '$personaId', '$estacion', CURRENT_TIMESTAMP, NULL)"); 
            
        
        }

    return redirect()->route('panel.index')->with('success', 'Asignaciones guardadas correctamente.');
} 




    

    /**
     * Display the specified resource.
     */
    public function show(string $request) 
    {
     
       
    }







    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

     
    public function destroy(string $id)
    {
        //
    }

    public function propuesta()
    {
       

        try {
            $query = DB::select("SELECT  
                    ha.id_rol, 
                    ha.id_persona,
                    ha.id_usuarios,
                    ha.id_jlaboral,   
                    u.nombre,
                    p.id_estacion, 
                    jl.entrada || ' - ' || jl.salida AS jlaborals,        
                    ha.created_at AS fecha_asignacion_anterior
                    FROM propuesta_asignacions p
                    JOIN usuarios u ON p.id_usuarios = u.id_usuario
                    LEFT JOIN historico_asignacion ha ON ha.id_usuarios = p.id_usuarios
                    JOIN jlaborals jl ON ha.id_jlaboral = jl.id       
                    JOIN dias d ON jl.id_dias = d.id_dias
                    WHERE  ha.id_estado=2");
                
            
        } catch (\Throwable $th) {
            return redirect()->route('panel.index')->with('success', 'No existe una Propuesta Previa para visualizar.'); 
        }

    return view('panel.propuesta',['asignaciones'=>$query]);



    }


    public function correoRechazo(Request $request) 
    {
        $query = DB::select("SELECT  
                    ha.id_rol, 
                    ha.id_persona,
                    ha.id_usuarios,
                    ha.id_jlaboral,   
                    u.nombre,
                    p.id_estacion, 
                    jl.entrada || ' - ' || jl.salida AS jlaborals,        
                    ha.created_at AS fecha_asignacion_anterior
                    FROM propuesta_asignacions p
                    JOIN usuarios u ON p.id_usuarios = u.id_usuario
                    LEFT JOIN historico_asignacion ha ON ha.id_usuarios = p.id_usuarios
                    JOIN jlaborals jl ON ha.id_jlaboral = jl.id       
                    JOIN dias d ON jl.id_dias = d.id_dias
                    WHERE  ha.id_estado=2");



        dd($request);

         /*  // Envio de Credenciales mamalonas
                  Mail::to($request->email)
                    ->send(new CorreoElectronico($request->all()));   */


       
    }




}
