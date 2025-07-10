<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(){
        Session::forget('nombre');
        Session::forget('estacion');
        Session::forget('jlaborals');
        Session::forget('hcomidas');
		Session::forget('hdescansos');
        Session::forget('foto');
        Session::forget('id_rol');
        Session::forget('id_persona');
        Session::forget('id_estado');
        Session::forget('id_jlaboral');
		Session::forget('id_hcomida');
        Session::forget('id_hdescanso');
		

 


        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
