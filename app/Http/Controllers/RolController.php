<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;



class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $query = DB::select("select * from roles");
            $permisos = DB::select("select *from permissions");
        
            
        } catch (\Throwable $th) {
            //throw $th;
        }

    return view('roles.index',['rol'=>$query,'permisos'=>$permisos]); 
    /* return view('panel.index'); */

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
       
       
        // Validación
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required' 
        ]);

      

        try {
            
    
            // Inicia transacción
            DB::beginTransaction();
    
            // Crear el rol
           
            $rol = Role::create(['name' => $request->name]);


            $rol->syncPermissions($request->permission);
            
            
    
            // Confirmar transacción
            DB::commit();
    
            // Retornar a la vista con un mensaje de éxito
            return redirect()->route('roles.index')->with('success', 'Rol Registrado');
        } catch (Exception $e) {
            // Si ocurre un error, realizar rollback y mostrar el error
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al registrar el rol: ' . $e->getMessage());
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
