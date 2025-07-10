<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreComponentesRequest;
use App\Http\Requests\UpdateComponentesRequest;
use App\Models\Componentes_Estacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Gate;
use App\Models\User ;

class ComponentesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct() {
        
       /*  $this->middleware('permission:componentes',['only',['index','create','store','show','edit','update','destroy']]);  */
       
     }
    public function index()
    {
        if (auth()->user()->can('agregar_solo_mobiliario')) {
           
            $categoria = DB::select("SELECT id,nombre FROM categorias  WHERE nombre LIKE '%MOBILIARIO%' AND ID_ESTADO=2");
        }
        
        if (auth()->user()->can('agregar_solo_electronico')) {
            
            $categoria = DB::select("SELECT id,nombre FROM categorias  WHERE nombre NOT LIKE '%MOBILIARIO%' AND ID_ESTADO= 2 ");
        }

        if (auth()->user()->can('agregar_todo')) {
            
            $categoria = DB::select("SELECT id,nombre FROM categorias WHERE ID_ESTADO =2");
        }

        
        $query = DB::select("SELECT  c.id,  c.descripcion, cat.nombre AS categoria, c.id_estado FROM COMPONENTES__ESTACIONS c  JOIN  categorias cat ON c.id_categoria = cat.id ");
        

        return view('componentes.index')   
        ->with("componentes",$query)
        ->with('categoria',$categoria);  
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        /* if (auth()->user()->can('agregar_solo_mobiliario')) {
           
            $categoria = DB::select("SELECT id,nombre FROM categorias  WHERE nombre LIKE '%MOBILIARIO%' ");
        }
        
        if (auth()->user()->can('agregar_solo_electronico')) {
            
            $categoria = DB::select("SELECT id,nombre FROM categorias  WHERE nombre NOT LIKE '%MOBILIARIO%' ");
        }

        if (auth()->user()->can('agregar_todo')) {
            
            $categoria = DB::select("SELECT id,nombre FROM categorias ");
        }



        
        return view('componentes.create',['categoria'=>$categoria]);  */
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
      
         try {
            DB::insert("insert into COMPONENTES__ESTACIONS(descripcion,id_categoria,id_estado) values('$request->descripcion ','$request->categoria',2)");
        } catch (\Throwable $e) {
            var_dump($e);
        }  
        $message='El componente fue creada';
        return redirect()->route('componentes.index')->with('success',$message);  
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
    public function edit(Componentes_Estacion $componente)
    {
     
           $categoria = DB::select("SELECT id,nombre FROM categorias");
          
          
          /* return view('componentes.edit',['componentes'=>$componente,'categoria'=>$categoria]);  */
        
          return view('componentes.edit')   
          ->with("componentes",$componente)
          ->with("categoria",$categoria);  
          
    }

    /**
     * Update the specified resource in storage.
     */

     
    public function update(Request $request ,Componentes_Estacion $componente)
     {
         /* dd($componente->id );   */
       
         /* dd("update componentes__estacions SET descripcion='$request->descripcion',id_categoria='$request->categoria' WHERE id='$componente->id'");  */
        
        DB::update("update COMPONENTES__ESTACIONSs SET descripcion='$request->descripcion',id_categoria=$request->categoria WHERE id='$componente->id'"); 
        $message='El tipo de Componente fue actualizada';
        return redirect()->route('componentes.index')->with('success',$message);  


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Componentes_Estacion $componente)
    {
       /*  dd("update componentes__estacions SET id_estado='1' WHERE id='$componente->id'"); */
         if($componente->id_estado==2){
            DB::update("update COMPONENTES__ESTACIONS SET id_estado='1' WHERE id='$componente->id'"); 
            $message='El componente fue eliminada correctamente';
            
         }else{
            DB::update("update COMPONENTES__ESTACIONS SET id_estado='2' WHERE id='$componente->id'"); 
            $message='El componente fue restaurada correctamente';
          
            

         } 
          return redirect()->route('componentes.index')->with('success',$message); 
    }
}
