<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Estacione;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Contracts\Permission;

class EstacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct() {
       
       /*  $this->middleware('permission:equipos',['only',['index','create','store','show','edit','update','destroy']]); */
       
     }

     
    public function index()
    {
        $query = DB::select("SELECT e.id,e.descripcion, 
       e.id_area, 
       e.id_ip, 
       e.asignado, 
       a.descripcion AS area_descripcion, 
       i.descripcion AS ip_descripcion
        FROM estaciones e 
        JOIN areas a ON a.id = e.id_area
        JOIN i_p_s i ON i.id = e.id_ip ");
        /* dd($query); */
        
        
        $ip=DB::select("select*from i_p_s where asignado=2");
        $area=DB::select("select*from areas");
        $silla=DB::select("select i.id_inventario ,c.descripcion,i.numeroinventario,i.numeroserie from inventarios i JOIN componentes__estacions c ON i.id_compe=c.id where id_compe=11");
        $archivero=DB::select("select i.id_inventario ,c.descripcion,i.numeroinventario,i.numeroserie from inventarios i JOIN componentes__estacions c ON i.id_compe=c.id where id_compe=10");
        $equipos=DB::select("select id_equipo from equipos");
        $componentes_equipos= DB::select("SELECT  e.id_equipo ,i.id_inventario, c.descripcion AS nombre_componente, i.numeroserie
        FROM componentes_equipos e
        JOIN inventarios i ON e.id_componente = i.id_inventario
        JOIN componentes__estacions c ON i.id_compe = c.ID");


        
        return view('estaciones.index')   
        ->with("estaciones",$query)
        ->with('ip',$ip)
        ->with('silla',$silla)
        ->with('area',$area)
        ->with('equipos', $equipos)
        ->with('componentes_equipos', $componentes_equipos)
        ->with('archivero',$archivero); 




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
       

         $validator = Validator::make(
            $request->all(),
            [
                'nombre' => 'required|max:60|unique:estaciones,descripcion', 
            ]
        );

        if ($validator->fails()) {
           $message = 'Hubo un problema al guardar el registro: ';
           return redirect()->route('estaciones.index')->with('error', $message);   
           }

 

   

     try {

           
           DB::insert("INSERT INTO estaciones (id, descripcion, id_area, id_ip, id_silla, id_archivero, asignado, created_at, updated_at) VALUES (ESTACIONES_ID_SEQ.NEXTVAL, '$request->nombre', '$request->area', '$request->ip', '$request->silla', '$request->archivero', '2', CURRENT_TIMESTAMP, NULL)");
           DB::update("update i_p_s SET asignado='3' WHERE id='$request->ip'"); 
            $message='La estacion fue creada';
            return redirect()->route('estaciones.index')->with('success',$message);

       } catch (\Throwable $e) {
          
            $message='La categoria NO fue creada';
            return redirect()->route('estaciones.index')->with('error',$message);
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
    public function edit(Estacione $estaciones)
    {
        dd($estaciones->id);
      /*   return view('estaciones.edit',['estaciones'=>$estaciones]);    */
    }

    /**
     * Update the specified resource in storage.
     */
    public function cambios(Request $request)
    {
    
        $estacion=$request->estacione;
        $ip=$request->id_ip;
        $asignado=$request->asignado;

        if($asignado==1){

            DB::update("update estaciones SET asignado='2' ,id_ip='1' WHERE id='$estacion'"); 

            DB::update("update i_p_s SET asignado='3' WHERE id='$ip'"); 

           /*  DB::insert("INSERT INTO categorias (id, nombre, descripcion, id_estado, created_at, updated_at) VALUES (CATEGORIAS_ID_SEQ.NEXTVAL, '$request->nombre', '$request->descripcion', 2, CURRENT_TIMESTAMP, NULL)"); 
             
            $cambio = DB::select("SELECT id,nombre FROM categorias  WHERE nombre LIKE '%MOBILIARIO%' AND ID_ESTADO=2");
             */ 
         
         $message='La estacion fue reactivada';
         return redirect()->route('estaciones.index')->with('success',$message); 
        }

        if($asignado==2){

            DB::update("update estaciones SET asignado='1' ,id_ip='1' WHERE id='$estacion'"); 

            DB::update("update   historico_asignacion SET id_estado='6' WHERE  id_estacion='$estacion' AND id_estado =2"); 

           /*  DB::insert("INSERT INTO categorias (id, nombre, descripcion, id_estado, created_at, updated_at) VALUES (CATEGORIAS_ID_SEQ.NEXTVAL, '$request->nombre', '$request->descripcion', 2, CURRENT_TIMESTAMP, NULL)"); 
             
            $cambio = DB::select("SELECT id,nombre FROM categorias  WHERE nombre LIKE '%MOBILIARIO%' AND ID_ESTADO=2");
             */ 
         
         $message='La estacion fue desactivada';
         return redirect()->route('estaciones.index')->with('success',$message); 
        }


        if($asignado==3){

            DB::update("update estaciones SET asignado='2'  WHERE id='$estacion'"); 

            DB::update("update i_p_s SET asignado='3' WHERE id='$ip'"); 

           /*  DB::insert("INSERT INTO categorias (id, nombre, descripcion, id_estado, created_at, updated_at) VALUES (CATEGORIAS_ID_SEQ.NEXTVAL, '$request->nombre', '$request->descripcion', 2, CURRENT_TIMESTAMP, NULL)"); 
             
            $cambio = DB::select("SELECT id,nombre FROM categorias  WHERE nombre LIKE '%MOBILIARIO%' AND ID_ESTADO=2");
             */ 
         
         $message='La estacion fue reactivada';
         return redirect()->route('estaciones.index')->with('success',$message); 
        }









      
    
    }

    /**
     * Remove the specified resource from storage.
     */
    /* public function destroy(string $id)
    {
       dd($id);
    } */


    public function destroy(string $id){

    }

    


}
