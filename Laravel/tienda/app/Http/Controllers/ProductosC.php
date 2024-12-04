<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;

class ProductosC extends Controller
{
    public function __construct()
    {
        //Comprobar si hay us logueado con Middleware Auth
        $this->middleware('auth');
    }

    function verProductos()
    {
        /*recuperamos los productos (equivale a select* from productos)
        y los devuelve en un array*/
        $productos = Producto::all();
        //el compact es para pasar datos equivalente a un array asociativo
        return view('productos/verProductos', compact('productos'));
        //return view('productos/verProductos','productos' =>$productos);
    }
    function addCarrito(Request $request)
    {
        //comprueba si hay stock y si lo hay inserta el producto en el carrito

        //obtener los datos del producto
        //Equivale a select * from productos wherre id = idP
        //request es como $_post
        $p = Producto::find($request->btnAdd);
        if ($p != null) {

            if ($p->stock > 0) {
                //Comprobamos si el producto está ya en la cesta
                $productoC = Carrito::where('producto_id', $p->id)
                    ->where('user_id', Auth::user()->id)->first();
                if ($productoC == null) {

                    //Crear producto en carrito
                    $productoC = new Carrito();
                    $productoC->producto_id = $p->id;
                    $productoC->cantidad = 1;
                    $productoC->precioU = $p->precio;
                    $productoC->user_id = Auth::user()->id;
                } else {
                    //Incrementamos en 1 la cantidad
                    $productoC->cantidad += 1;
                    $productoC->precioU = $p->precio;
                }
                //guardamos cambios: hacemos un insert o un update pero solo hay que hacer lo siguiente
                if ($productoC->save()) {
                    return back()->with('mensaje', 'Producto añadido a la cesta' . $productoC->producto_id);
                } else {
                    return back()->with('error', 'No se ha añadido el producto en la cesta');
                }
            } else {
                //a la variable error le estamos asignando un mensaje
                return back()->with('error', 'No hay stock ' . $request->btnAdd);
            }
        } else {
            return back()->with('error', 'El producto no existe ' . $request->btnAdd);
        }
    }
    function verCesta()
    {
        //Obtener los productos en el carrito del usuario
        $productosC = Carrito::where('user_id', Auth::user()->id)->get();
        //Cargar la vista de la cesta
        return view('productos/verCesta', compact('productosC'));
    }

    function tratarCarrito(Request $request, $idP)
    {
        if (isset($request->btnBorrar)) {
            $p = Carrito::find($request->btnBorrar);

            if ($p != null) {
                //esto se hace para borrar
                if ($p->delete()) {
                    return back()->with('mensaje', 'Borrado con exito');
                } else {
                    return back()->with('error', 'Error el producto no se ha eliminado del carrito');
                }
            } else {
                return back()->with('error', 'Error el producto no esta en el carrito o no existe');
            }
        } elseif (isset($request->cantidad)) {
            //si la cantidad es mayor que 0 busco por id
            if ($request->cantidad > 0) {
                //es un select wherre id
                $p = Carrito::find($idP);
                if ($p->cantidad != $request->cantidad) {
                    //comprobar si hay stock

                    if ($p->producto->stock >= $request->cantidad) {
                        //modificar el product en el carrito
                        $p->cantidad = $request->cantidad;
                        if ($p->save()) {

                            return back()->with('mensaje', ' Cantidad modificada');
                        } else {
                            return back()->with('error', 'Error,  cantidad no mdificada');
                        }
                    } else {
                        return back()->with('error', 'Error, el producto no dispone de cantidad suficiente');
                    }
                    //esto es coomo un roll back
                    return back();
                }
            } else {
                return back()->with('error', 'Error, cantidad incorrecta');
            }
        }
    }
    function crearPedido(Request $request){
        //Comprobar que hay stock u que los precios no han cambiado
        //informar de caso necesario
        $carrito= Carrito::where('user_id',Auth::user()->id)->get(); 
        foreach ($carrito as $c) {
            //Comprobar si ha cambiado el precio
            if($c->precioU !=$c->producto->precio ){
                return back()->with('error','Error el producto'.$c->producto->precio.' ha cambiado de precio, Borra el producto y vuelve a añadirlo');

            }
            //comprobar si hay stock
            if($c->producto->stock < $c->cantidad ){
                return back()->with('error','Error no hay stock para el producto'.$c->producto->nombre.' Borra el producto');

            }
        }
        //Convertir cada línea del carrito en un pedido
        //y vaciar el carritp
        //Vamos a hacer varios insert,varios update y varios delete
        //por lo que tenemos una transacción    
        try {
            DB::transaction(function () {
              //recuperamos el carrito para poder hacer el pedido
              $carrito= Carrito::where('user_id',Auth::user()->id)->get();  
              foreach($carrito as $c){
                //Crear pedido 
                $p= new Pedido();
                //id del usuario actuasl
                $p->user_id=Auth::user()->id;
                $p->producto_id= $c->producto_id;
                $p->cantidad= $c->cantidad;
                $p->precioU= $c->precioU;
                if($p->save()){
                    //modificar stock del producto
                    $c->producto->stock-= $c->cantidad;
                    //borra despues de hacer el pedido
                    if($c->producto->save()){
                        $c->delete();
                    }
                }
                
                
            }
        });
        return redirect()->route('pedidos')->with('mensaje','Pedido creado con exito');
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }
    function verPedidos(){
        //recuperar los pedidos del usuario
        $pedidos= Pedido::where('user_id',Auth::user()->id)->get();  
        //redirigir a la vista ver pedidos
        return view('productos/verPedidos', compact('pedidos'));
    }

}
