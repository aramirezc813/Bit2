<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
//use Storage;

class Personal extends Model
{
    use HasFactory;
    
    

    public function hanbleUploadImage($image){

        

        $file=$image;

        $name=time().$file->getClientOriginalName();

       
       //ambas funciones sirven paraguardar el archivo temporal en el proyecto
       // $file->move(public_path().'/img/personal/',$name);

        $file->move(public_path().'/storage/personal/',$name);
      
        
        /* Storage::putFileAs('/public/personal',$file,$name,'public'); */
        /* putFileAs('Storage/public/personal',$file,$name,'public'); */
        return $name;
    }
}
