<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EquiposController extends Controller
{
    public function __construct() {
      /*  
         $this->middleware('permission:equipos',['only',['index','create','store','show','edit','update','destroy']]);  */
       
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = DB::select("select * from equipos ");
        $inventario=DB::select("select i.id_inventario ,c.descripcion,i.numeroinventario,i.numeroserie from inventarios i JOIN componentes__estacions c ON i.id_compe=c.id where i.id_estado=4 and i.id_compe !=11 and i.id_compe !=10");
      /*   dd($inventario); */
      $consulta= DB::select("SELECT  e.id_equipo ,i.id_inventario, c.descripcion AS nombre_componente, i.numeroserie
                                FROM componentes_equipos e
                                JOIN inventarios i ON e.id_componente = i.id_inventario
                                JOIN componentes__estacions c ON i.id_compe = c.ID");

                         

        
        return view('equipos.index')   
        ->with("equipos",$query)
        ->with('inventario',$inventario) 
        ->with('consulta', $consulta); 

    }
    
  /*   public function infoEquipo(Request $request)
    {
    
        // Obtener el id del equipo desde el request
        $idEquipo = $request->input('id_equipo');
        
        // Realizar la consulta usando parámetros para evitar inyección SQL
        $consulta = DB::select("SELECT i.id_inventario, c.descripcion AS nombre_componente, i.numeroserie
                                FROM componentes_equipos e
                                JOIN inventarios i ON e.id_componente = i.id_inventario
                                JOIN componentes__estacions c ON i.id_compe = c.ID
                                WHERE e.ID_EQUIPO = ?", [$idEquipo]);
    
        // Retornar los datos en formato JSON
        return response()->json(['componentes' => $consulta]); 
    } */
    
 



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd("xD");
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
{
    // Obtener el parámetro 'componentes' del request
    $arrayid_componente = $request->get('componentes', []); // Si no existe, se convierte en un array vacío


    // Iniciar una transacción para asegurar la atomicidad
    DB::beginTransaction();
    try {
        // Crear un nuevo equipo en la base de datos
        DB::insert("INSERT INTO equipos (id_equipo, fecha_alta, fecha_baja, created_at, updated_at) 
                    VALUES (EQUIPOS_ID_EQUIPO_SEQ.NEXTVAL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL, NULL)");
        
        // Obtener el ID del último equipo insertado 
        $id_equipo = DB::select("SELECT MAX(id_equipo) AS ultimo_id FROM equipos");
        $equipo = $id_equipo[0]->ultimo_id;

        // Verificar si hay componentes seleccionados
        if (is_array($arrayid_componente) && count($arrayid_componente) > 0) {
            // Recorrer cada componente y agregarlo a la tabla componentes_equipos
            foreach ($arrayid_componente as $componente_id) {
                DB::insert("INSERT INTO componentes_equipos (id_ce, id_equipo, id_componente, created_at, updated_at) 
                            VALUES (COMPONENTES_EQUIPOS_ID_CE_SEQ.NEXTVAL, ?, ?, NULL, NULL)", 
                            [$equipo, $componente_id]);

                // Actualizar el estado del componente en inventarios
                DB::update("UPDATE inventarios SET id_estado = '3' WHERE id_inventario = ?", [$componente_id]);
            }
        }

        // Confirmar la transacción si todo ha salido bien
        DB::commit();

        // Mensaje de éxito
        $message = 'El equipo fue creado correctamente';
        return redirect()->route('equipos.index')->with('success', $message);
    } catch (\Exception $e) {
        // Deshacer la transacción si ocurre un error
        DB::rollBack();

        // Manejar el error (puedes registrar el error aquí si lo necesitas)
        $message = 'Hubo un problema al guardar el registro: ' . $e->getMessage();
        return redirect()->route('equipos.index')->with('error', $message);
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
