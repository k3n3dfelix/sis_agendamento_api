<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Rotas de tipo Usuário-----------------------------------------------------
Route::get('tipos', [TipoController::class,'index']);
Route::get('tipo/{id}', [TipoController::class,'show']);
Route::post('tipo', [TipoController::class, 'store']);
Route::put('tipo/{id}', [TipoController::class, 'update']);
Route::delete('tipo/{id}', [TipoController::class,'destroy']);


//Rotas de Usuários----------------------------------------------------------
Route::get('usuarios', [UsuarioController::class,'index']);
Route::get('usuario/{id}', [UsuarioController::class,'show']);
Route::post('usuario', [UsuarioController::class, 'store']);
Route::put('usuario/{id}', [UsuarioController::class, 'update']);
Route::delete('usuario/{id}', [UsuarioController::class,'destroy']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

//Route::get('beers', [TipoController::class,'liste']);
Route::get('tipos', [TipoController::class,'index']);
});
