<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Rutas sin autentificación
Route::post('login',[LoginController::class,'login']);
Route::post('registro',[LoginController::class,'registro']);

//Rutas con autentificación
Route::post('logout',[LoginController::class,'logout'])->middleware('auth:sanctum');
Route::get('pedidos',[PedidoController::class,'index'])->middleware('auth:sanctum');
Route::get('productos',[ProductoController::class,'index'])->middleware('auth:sanctum');
Route::post('pedidos',[PedidoController::class,'store'])->middleware('auth:sanctum');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
