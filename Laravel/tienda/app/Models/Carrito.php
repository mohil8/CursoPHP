<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    //Relación 1:1 un registro de carrito tiene un solo usuario
    function usuario(){
        return $this->belongsTo(User::class);
    }
    function producto(){
        return $this->belongsTo(Producto::class);
    }
}
