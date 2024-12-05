<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;


class CitaC extends Controller
{
    //

    function verCitas(){
        $citas=Cita::orderBy('fecha','DESC')->get();
        return view('cita',compact('citas'));
    }
    function modificarCita(Request $request){
        
    }
    function borrarCita(Request $request,$id){
        //recuperarCita y borrar
        $cita=Cita::find($id);
        if($cita!=null){
            if($cita->delete()){
                return back()->with('mensaje','Cita con id'.$cita->id.' borrada');
            }else{
                return back()->with('mensaje','Error, al borrar la cita');
            }
        }
    }
    function CrearCita(Request $request){
        //Validar
        $request->validate([

            "fecha"=>"required",
            "hora"=>"required",
            "cliente"=>"required"
        ]);

        $cita=new Cita();
        $cita->fecha=$request->fecha;
        $cita->hora=$request->hora;
        $cita->cliente=$request->cliente;
        if($cita->save()){
            return back()->with('mensaje','Cita con id '.$cita->id.' creada');
        }else{
            return back()->with('mensaje','Error, al crear la cita');
        }
    }

    function crearDetalle($id){
        return view('detalle');
    }
}
