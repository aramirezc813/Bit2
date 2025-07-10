<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ComponentesController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\EstacionesController;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\IpController;
use App\Http\Controllers\RolController;
use App\Models\Estacione;
use Illuminate\Support\Facades\Route;



Route::get('/',[LoginController::class, 'Index'])->name('/');




// Index
Route::get('xddd', function () { return view('auth.login');})->name('xddd'); 


Route::post('login',[LoginController::class,'login']);
  Route::get('login',[LoginController::class,'index'])->name('login');   
Route::get('/logout',[LogoutController::class,'logout'])->name('logout');
 

Route::get('/401', function () {
    return view('pages.401');
});


Route::get('/404', action: function () {
    return view('pages.404');
});


Route::get('/500', function () {
    return view('pages.500');
});



Route::view('/area','area.index');
Route::resource('area',AreaController::class);

//JALA TODO EL CRUD AUTOMATICAMENTE
Route::view('/categorias','categorias.index');
Route::resource('categorias',CategoriasController::class);

//JALA TODO EL CRUD AUTOMATICAMENTE
Route::view('/componentes','componentes.index');
Route::resource('componentes',ComponentesController::class); 


Route::view('/equipos','equipos.index');
Route::resource('equipos', EquiposController::class);

Route::view('/estaciones','estaciones.index');
Route::resource('estaciones', EstacionesController::class);


//JALA TODO EL CRUD AUTOMATICAMENTE
Route::view('/panel','panel.index')->name('panel');
Route::resource('panel',PanelController::class); 

//JALA TODO EL CRUD AUTOMATICAMENTE
Route::view('/personal','personal.index');
Route::resource('personal',PersonalController::class); 


Route::view('/roles','roles.index');
Route::resource('roles', RolController::class);

Route::view('/horarios','horarios.index');
Route::resource('horarios', HorariosController::class);

 
Route::get('/mostrar_categoria', [InventarioController::class, 'mostrar_categoria'])->name('mostrar_categoria'); 
Route::post('/realizarconsulta', [InventarioController::class, 'realizarConsulta'])->name('realizarconsulta');

Route::post('/infoEquipo', [EquiposController::class, 'infoEquipo'])->name('infoEquipo');


//JALA TODO EL CRUD AUTOMATICAMENTE
Route::view('/inventario','inventarios.index');
Route::resource('inventario',InventarioController::class);


//JALA TODO EL CRUD AUTOMATICAMENTE
Route::view('/ip','ip.index');
Route::resource('ip',IpController::class);  



Route::post('estaciones/cambios/{estacione}/{id_ip}/{asignado}', [EstacionesController::class, 'cambios'])->name('estaciones.cambios');



/* Carga toda la informacion del personal : ESTE SE CREO  SE SUPONE ES LA PRIMERA VISTA QUE VAMOS A MOSTRAR*/ 
 
Route::controller(PersonalController::class)->group(function(){   
   // Route::get('/perfilC','perfilC')->name('perfilC'); 
    Route::get('/perfilC','perfilC')->name('perfilC')->middleware('auth'); 
});

Route::controller(PersonalController::class)->group(function(){   
    Route::get('/password','password')->name('password');
});



Route::controller(PersonalController::class)->group(function(){   
    Route::get('/createpassword','createpassword')->name('createpassword');
});



Route::post('/vistaformato', [PersonalController::class, 'Vistaformato'])->name('vistaformato');
