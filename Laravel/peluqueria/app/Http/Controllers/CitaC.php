<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\DetalleCita;
use App\Models\Servicio;
use Illuminate\Http\Request;


class CitaC extends Controller
{
    //

    function verCitas(){
        $citas=Cita::orderBy('fecha','DESC')->orderBy('hora')->get();
        return view('cita',compact('citas'));
    }
    function modificarCita(Request $request,$id){
        $cita=Cita::find($id);
        if($cita!=null){
           //Calculamos total
           foreach($cita->obtenerDetalle() as $d){
            $cita->total+=$d->precio;
           }

           if($cita->save()){
            return back()->with('mensaje','Cita finalizada');
           }else{
            return back()->with('mensaje','Error, no se ha podido finalizar la cita ');
           }
        }else{
            return back()->with('mensaje','Error, cita no existe');
        }
    }
    function borrarCita(Request $request,$id){
        //recuperarCita y borrar
        $cita=Cita::find($id);
        if(empty($cita->obtenerDetalle())){
        if($cita!=null){
            if($cita->delete()){
                return back()->with('mensaje','Cita con id'.$cita->id.' borrada');
            }else{
                return back()->with('mensaje','Error, al borrar la cita');
            }
        }
    }else{
        return back()->with('mensaje','Error, no se puede borrar mensaje');
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

    function cargarDetalle($id){
        //Recuperar Cita
        $cita=Cita::find($id);
        $servicios=Servicio::all();
        if($cita!=null){
            //Obtrenemos el detalle
            return view('detalle',compact('cita','servicios'));
        }else{
            return back()->with('mensaje','Error, no existe la');
        }
        
    }

    function insertarDetalle(Request $request,$id){

        $cita=Cita::find($id);
        if($cita!=null){
            $servicio= Servicio::find($request->servicio);
            if($servicio!=null){
                //Crear el detalle
                $d=new DetalleCita();
                $d->cita_id=$cita->id;
                $d->servicio_id=$servicio->id;
                $d->precio=$servicio->precio;
                if($d->save()){
                    return back()->with('mensaje','Servicio añadido');
                }
                else{
                    return back()->with('mensaje','Error, no se ha añadido el servicio');
                }
            }else{
                return back()->with('mensaje','Error, no existe el servicio');
            }
        }else{
            return back()->with('mensaje','Error no se encuentar la cita');
        }
    }
}