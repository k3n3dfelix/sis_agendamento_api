<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoController;

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
//Rotas de Tipos de Usuários
Route::get('tipos', [TipoController::class,'index'])->middleware(['auth:api', 'scope:1']);
Route::get('tipo/{id}', [TipoController::class,'show'])->middleware('auth:api');
Route::post('tipo', [TipoController::class, 'store'])->middleware('auth:api');
Route::put('tipo/{id}', [TipoController::class, 'update'])->middleware('auth:api');
Route::delete('tipo/{id}', [TipoController::class,'destroy'])->middleware('auth:api');

Route::get('beers', [TipoController::class,'liste']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

    Route::get('tipos', [TipoController::class,'index']);
});
