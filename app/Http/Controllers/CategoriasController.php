<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriastRequest;
use App\Http\Requests\UpdateCategoriaRequest; 
use App\Models\Categoria;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Contracts\Permission;

class CategoriasController extends Controller
{

    public function __construct() {
       /*  $this->middleware('permission:categorias',['only',['index','create','store','show','edit','update','destroy']]);   */
      
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = DB::select("select * from categorias ");
        /* dd($query); */
        return view('categorias.index',['categorias'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) /** StoreCategoriastRequest $request*/
    {
      

         //  estabamos homoge... awuanta
       
         $validator = Validator::make(
             $request->all(), 
             [
                'nombre' =>'required|max:60|unique:categorias',
                'descripcion'=>'nullable|max:255',
             ]
         );
         if ($validator->fails()) {
            $message = 'Hubo un problema al guardar el registro: ';
            return redirect()->route('categorias.index')->with('error', $message);   
            }






        try {

            /*MySQL
             DB::insert("insert into categorias(nombre,descripcion,id_estado) values('$request->nombre','$request->descripcion ',2)"); */

             DB::insert("INSERT INTO categorias (id, nombre, descripcion, id_estado, created_at, updated_at) VALUES (CATEGORIAS_ID_SEQ.NEXTVAL, '$request->nombre', '$request->descripcion', 2, CURRENT_TIMESTAMP, NULL)"); 
             $message='La categoria fue creada';
             return redirect()->route('categorias.index')->with('success',$message);

        } catch (\Throwable $e) {
           /*  var_dump($e); */
             $message='La categoria NO fue creada';
             return redirect()->route('categorias.index')->with('error',$message);
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
    public function edit(Categoria $categoria)

    {   
         return view('categorias.edit',['categorias'=>$categoria]);   
    }

    /**
     * Update the specified resource in storage.
     */    

    public function update(  Request $request,UpdateCategoriaRequest $prueba,Categoria $categoria)
    {
  
      
        
         DB::update("update categorias SET nombre='$request->nombre',descripcion='$request->descripcion' WHERE id='$categoria->id'"); 
         $message='La categoria fue actualizada';
         return redirect()->route('categorias.index')->with('success',$message); 
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        
        
         if($categoria->id_estado==2){
            DB::update("update categorias SET id_estado='1' WHERE id='$categoria->id'"); 
            DB::update("update  componentes__estacions  SET id_categoria='2' WHERE id_categoria='$categoria->id'"); 
            $message='La categoria fue eliminada correctamente';
            
         }else{
            DB::update("update categorias SET id_estado='2' WHERE id='$categoria->id'"); 
            $message='La categoria fue restaurada correctamente';
          
            

         }
         return redirect()->route('categorias.index')->with('success',$message);

    }



   
}
