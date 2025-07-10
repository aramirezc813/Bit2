<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
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

      
         dd($request->input('asignaciones')); 
        /*   $request->validate([
        'asignaciones' => 'required|array',
    ]); */

    $asignacionesParaGuardar = [];

    foreach ($request->asignaciones as $asignacion) {
        [$personaId, $estacion, $area] = explode('|', $asignacion);

        $asignacionesParaGuardar[] = [
            'persona_id' => $personaId,
            'estacion' => $estacion,
            'area' => $area,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    // Aquí puedes mostrar qué vas a guardar:
    dd($asignacionesParaGuardar);


    





       /*  $asignaciones = $request->input('asignaciones'); */

        // Procesa cada asignación y guarda en la base de datos o lo que necesites
        /* foreach ($asignaciones as $asignacion) {
            // Lógica para guardar las asignaciones en la base de datos
            // $asignacion contiene el nombre del empleado asignado a una celda específica
        } */

/* 
        {
    $request->validate([
        'asignaciones' => 'required|array',
    ]);

    // Eliminar asignaciones anteriores (ajusta según tu lógica)
    DB::table('asignacions')->delete();

    foreach ($request->asignaciones as $asignacion) {
        [$personaId, $estacion, $area] = explode('|', $asignacion);

        DB::table('asignacions')->insert([
            'persona_id' => $personaId,
            'estacion' => $estacion,
            'area' => $area,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return redirect()->route('panel.index')->with('success', 'Asignaciones guardadas correctamente.');
} */




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
}
