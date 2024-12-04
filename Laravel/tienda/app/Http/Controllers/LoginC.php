<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Email;

class LoginC extends Controller
{
    function vistaLogin()
    {
        return view('usuarios/login');
    }

    function loguear(Request $request)
    {
        //Validar
        $request->validate([
            'email' => 'required', //|email:rfc,dns',
            'ps' => 'required'

        ]);
        //Crear array con us y ps
        $credenciales = ['email' => $request->email, 'password' => $request->ps];
        //Validación de las credenciales
        //devuelve true o false
        if (Auth::attempt($credenciales)) {
            //reinicamos la sesion
            $request->session()->regenerate();
            //redirigimos a inicio
            return redirect()->route('inicio');
        } else {
            return back()->with('mensaje', 'Datos Incorrectas');
        }
    }
    function vistaRegistro()
    {
        return view('usuarios/registro');
    }
    function registrar(Request $request)
    {
        //MEtodo que se llama desde el formulario de registro al pulsar en crear
        //Validar los campos
        //las validaciones van en un array asociativo
        $request->validate([
            'nombre' => 'required',

            'email' => 'required|email:rfc,dns|unique:App\Models\User,email',
            'ps' => 'required|min:3|max:10',
            'ps2' => 'required|min:3|max:10|same:ps'
        ]);
        //si no hay errores en las validaciones, creamos el suaurio
        //y autenticamos
        $u = new User();
        //Rellenamos los datos
        $u->name = $request->nombre;
        $u->email = $request->email;
        $u->password = Hash::make($request->ps);

        //creamos el usuario: Hace insert en users
        if ($u->save()) {
            Auth::login($u);
            return redirect()->route('inicio');
        } else {
            return back()->with('mensaje', 'Error no se ha podido crear el usuario');
        }
    }
    function cerrarSesion()
    {
        //para cerrar sesion
        Auth::logout();
        return redirect()->route('inicio');
    }
}
