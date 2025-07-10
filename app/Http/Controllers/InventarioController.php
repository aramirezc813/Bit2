<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Http\Requests\UpdateInventarioRequest;
use GrahamCampbell\ResultType\Success;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Contracts\Permission;
use App\Http\Requests\StoreInventarioRequest;







 


class InventarioController extends Controller
{
    public function __construct() {
        
       /*  $this->middleware('permission:inventario',['only',['index','create','store','show','edit','update','destroy']]); */
        
     }


    /**
     * Display a listing of the resource.
     */ 


    public function index()
    {
      
       try {

       
        $query = DB::select("SELECT i.id_inventario, i.numeroInventario AS numeroinventario,  i.numeroSerie AS numeroserie,cat.nombre AS categoria, es.descripcion AS estado, compE.descripcion AS componente 
        FROM inventarios i 
        JOIN categorias cat ON i.id_categoria = cat.id 
        JOIN estados es ON i.id_estado = es.id_estado 
        JOIN COMPONENTES__ESTACIONS compE ON i.id_compE = compE.id");  

        if (auth()->user()->can('agregar_solo_mobiliario')) {
           
            $categoria = DB::select("SELECT id,nombre FROM categorias  WHERE nombre LIKE '%MOBILIARIO%' and id_estado =2");
            }
        
        if (auth()->user()->can('agregar_solo_electronico')) {
            
            $categoria = DB::select("SELECT id,nombre FROM categorias  WHERE nombre NOT LIKE '%MOBILIARIO%' and id_estado =2");
             }

        if (auth()->user()->can('agregar_todo')) {
            
            $categoria = DB::select("SELECT id,nombre FROM categorias WHERE id_estado =2"); 
            }



        } catch (\Throwable $th) {

            echo( "NO jalo");   
        }


            
            
            


       /*   $consulta=DB::select("SELECT *FROM categorias WHERE id_estado =2"); */


        

       

   return view('inventario.index')
         ->with("inventario",$query)
         ->with("cat",$categoria);   
 




    }
   
    
    public function realizarconsulta(Request $request)
    {
        


         try {
                    // Obtener el id del documento desde el request
                    $idDocumento = $request->input('id');
                    
                    // Realizar la consulta usando parámetros para evitar inyección SQL
                     $consulta = DB::select("SELECT id, descripcion FROM COMPONENTES__ESTACIONS WHERE id_categoria = $idDocumento"); 

                    

                    
                    // Verificar si se encontraron resultados
                    if (count($consulta) > 0) {
                        return response()->json(['uaS' => $consulta]);
                    } else {
                        return response()->json(['uaS' => []]); // Si no hay resultados, devuelve un array vacío
                    }
                } catch (\Exception $e) {
                    // Manejo de errores
                    return response()->json(['error' => 'Hubo un problema al realizar la consulta', 'message' => $e->getMessage()]);
                }  
    }

   
    
    public function create()
    {


        if (auth()->user()->can('agregar_solo_mobiliario')) {
           
            $categoria = DB::select("SELECT id,nombre FROM categorias  WHERE nombre LIKE '%MOBILIARIO%' ");
        }
        
        if (auth()->user()->can('agregar_solo_electronico')) {
            
            $categoria = DB::select("SELECT id,nombre FROM categorias  WHERE nombre NOT LIKE '%MOBILIARIO%' ");
        }

        if (auth()->user()->can('agregar_todo')) {
            
            $categoria = DB::select("SELECT id,nombre FROM categorias ");
        }


/* 


        $query1 = DB::select("select * from categorias ");  */
        return view('inventario.create',['inventario'=>$categoria]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       

           // TENGO PROBLEMAS PARA QUE RECONOZCA EL ARCHIVO  StoreInventarioRequest EN TEORIA TENDRIA QUE JALAR LA VALIDACION DE ESE :V  ASI QUE POR ESO EN ESTE SILO TIENE  

            $numeroInventario = $request->numeroInventario;
            $numeroSerie = $request->numeroSerie;

           
        
           
             $validator = Validator::make(
                $request->all(),  
                [
                    'numeroInventario' => 'required|max:60',/* |unique:inventarios */
                    'numeroSerie' => 'required|max:60',/* |unique:inventarios */ 
                ]
            );

    
        if ($validator->fails()) {
            
             $message = 'Hubo un problema al guardar el registro: ';
            return redirect()->route('inventario.index')->with('error', $message);  
            }   
 

         try {

                  DB::insert("INSERT INTO inventarios 
            (id_inventario, id_compE, id_categoria, id_estado, fecha_hora, numeroInventario, numeroSerie, CREATED_AT, UPDATED_AT) 
            VALUES (INVENTARIOS_ID_INVENTARIO_SEQ.NEXTVAL, $request->tipoComp, $request->tipoCat, 4, CURRENT_TIMESTAMP, '$request->numeroInventario',  '$request->numeroSerie', CURRENT_TIMESTAMP, NULL)");
   
            $message = 'El registro fue creado exitosamente.';
            return redirect()->route('inventario.index')->with('success', $message);   
    
        } catch (\Throwable $e) {
            $message = 'Hubo un problema al guardar el registro: ';
            return redirect()->route('inventario.index')->with('error', $message);   
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
    public function edit(Request $request)
    {
       /* dd($inventario); */
        /* return view('inventario.edit',['inventario'=>$inventario]);  */ 
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
    public function destroy(Request $request)
    {
        dd($request);
    }


   


}
