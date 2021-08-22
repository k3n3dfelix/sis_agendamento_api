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
Route::get('tipo/{id}', [TipoController::class,'show'])->middleware(['auth:api']);
Route::post('tipo', [TipoController::class, 'store'])->middleware(['auth:api']);
Route::put('tipo/{id}', [TipoController::class, 'update'])->middleware(['auth:api']);
Route::delete('tipo/{id}', [TipoController::class,'destroy'])->middleware(['auth:api']);


//Rotas de Usuários----------------------------------------------------------
Route::get('usuarios', [UsuarioController::class,'index'])->middleware(['auth:api']);
Route::get('usuario/{id}', [UsuarioController::class,'show'])->middleware(['auth:api']);
Route::post('usuario', [UsuarioController::class, 'store'])->middleware(['auth:api']);
Route::put('usuario/{id}', [UsuarioController::class, 'update'])->middleware(['auth:api']);
Route::delete('usuario/{id}', [UsuarioController::class,'destroy'])->middleware(['auth:api']);

//Rotas de Aulas----------------------------------------------------------
Route::get('aulas', [AulaController::class,'index'])->middleware(['auth:api']);
Route::get('aula/{id}', [AulaController::class,'show'])->middleware(['auth:api']);
Route::post('aula', [AulaController::class, 'store'])->middleware(['auth:api']);
Route::put('aula/{id}', [AulaController::class, 'update'])->middleware(['auth:api']);
Route::delete('aula/{id}', [AulaController::class,'destroy'])->middleware(['auth:api']);

//Rotas de Agendas----------------------------------------------------------
Route::get('agendas', [AgendaController::class,'index'])->middleware(['auth:api']);
Route::get('agenda/{id}', [AgendaController::class,'show'])->middleware(['auth:api']);
Route::post('agenda', [AgendaController::class, 'store'])->middleware(['auth:api']);
Route::put('agenda/{id}', [AgendaController::class, 'update'])->middleware(['auth:api']);
Route::delete('agenda/{id}', [AgendaController::class,'destroy'])->middleware(['auth:api']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

//Route::get('beers', [TipoController::class,'liste']);
Route::get('tipos', [TipoController::class,'index']);
});
