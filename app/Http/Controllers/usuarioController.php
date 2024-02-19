<?php

namespace App\Http\Controllers;

use App\Models\ususario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class usuarioController extends Controller
{
    //
    public function registro(Request $request){
        $usuario = new ususario();




        $usuario->nombre = $request->nombre;
        $usuario->pass = hash('sha1', $request->pass);
        $usuario->nivel = 2;

        if($request->pass == $request->pass2){
            $usuario->save();
            $message = 'Usuario registrado';

        }else{
            $message = 'Error al registrar';
        }



        return redirect()->route('/')->with('message',$message);
        //return $request;
    }
}
