<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //Relacion 1: n entre usuaario y carrito
    //Un usuario puede tener varios regustros
    // pero un producto es de un solo usuario
    function productosCarrito(){
        return $this->hasMany(Carrito::class)->get();
    }


    function pedidos(){
        return $this->hasMany(Pedido::class)->get();
    }
}
