<?php

use App\Http\Controllers\LoginC;
use App\Http\Controllers\ProductosC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return a la ruta de inicio
    return redirect()->route('inicio');
});

Route::controller(LoginC::class)->group(
    function () {
        Route::get('login', 'vistaLogin')->name('login');
        Route::post('login', 'loguear')->name('loguear');
        Route::get('registrar', 'vistaRegistro')->name('vistaRegistro');
        Route::post('registrar', 'registrar')->name('registrar');
        Route::get('cerrar', 'cerrarSesion')->name('cerrar');
    }
);
Route::controller(ProductosC::class)->group(
    function () {
        //el middlewere hace que si ya esetoy autenticado me deja /entrar si no me redirige a login
        Route::get('inicio', 'verProductos')->name('inicio');
        Route::post('addCarrito', 'addCarrito')->name('addCarrito');
        Route::get('cesta', 'verCesta')->name('cesta');
        Route::post('tratarCarrito/{idP}', 'tratarCarrito')->name('tratarCarrito');
        Route::post('crearPedido', 'crearPedido')->name('crearPedido');
        Route::get('pedidos', 'verPedidos')->name('pedidos');

    }
);
