<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function login(Request $request){
        $request->validate([
            'email'=>'required',
            'ps'=>'required'
        ]);

        try {
            $credenciales = ['email' => $request->email, 'password' => $request->ps];
            //Validación de las credenciales
            //devuelve true o false
            if (Auth::attempt($credenciales)) {
               //Obtener el usuario
               $u = User::find(Auth::user()->id);
               //Generamos un token de autentificación que lo va a devolver esta petición
               $token=$u->createToken('auth_token')->plainTextToken;
               return response()->json([
                'mensaje'=>'Login correcto',
                'token'=>$token,
                'nombreUs' => $u->name,
               ]);
            } else {
                return response()->json('Datos incorrectos',401);
            }
        } catch (\Throwable $th) {
            return response()->json('Error:'.$th->getMessage(),500);
        }
    }

    function registro(Request $request){
        //Validar datos
        $request->validate([
            'nombre'=>'required',
            'email'=>'required|unique:App\Models\User,email',
            'ps'=>'required|min:3|max:10|same:ps',
            'ps2'=>'required|min:3|max:10|same:ps'
        ]);
        try {
            //Crear usuario
            $u = new User();
            $u->name=$request->nombre;
            $u->email=$request->email;
            $u->password=Hash::make($request->ps);
            if($u->save()){
                return $u;
            }else{
                return response()->json('Error al crear el usuario',500);
            }
        } catch (\Throwable $th) {
            return response()->json('Error:'.$th->getMessage(),500);
        }
    }

    function logout(Request $request){

        try {
            $request->user()->tokens()->delete();
            return response()->json('Sesión cerrada',200);

        } catch (\Throwable $th) {
            return response()->json('Error'.$th->getMessage(),500);
        }
    }
}
