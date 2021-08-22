<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\AgendaController;

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
Route::get('tipos', [TipoController::class,'index'])->middleware(['auth:api']);
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

//Rotas de Aulas----------------------------------------------------------
Route::get('aulas', [AulaController::class,'index']);
Route::get('aula/{id}', [AulaController::class,'show']);
Route::post('aula', [AulaController::class, 'store']);
Route::put('aula/{id}', [AulaController::class, 'update']);
Route::delete('aula/{id}', [AulaController::class,'destroy']);

//Rotas de Aulas----------------------------------------------------------
Route::get('agendas', [AgendaController::class,'index']);
Route::get('agenda/{id}', [AgendaController::class,'show']);
Route::post('agenda', [AgendaController::class, 'store']);
Route::put('agenda/{id}', [AgendaController::class, 'update']);
Route::delete('agenda/{id}', [AgendaController::class,'destroy']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

//Route::get('beers', [TipoController::class,'liste']);
Route::get('tipos', [TipoController::class,'index']);
});
