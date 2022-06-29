<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/comedor')->group(function () {
    Route::post('pedir', 'App\Http\Controllers\RecipeController@store');
    Route::post('colas', 'App\Http\Controllers\RecipeController@showColas');
    Route::post('ingredientes', 'App\Http\Controllers\RecipeController@showIngredientes');
    Route::post('historico', 'App\Http\Controllers\RecipeController@showHistoric');
    Route::post('historial', 'App\Http\Controllers\RecipeController@showHistorial');
    Route::post('recetas', 'App\Http\Controllers\RecipeController@showRecetas');
    Route::post('preparar', 'App\Http\Controllers\RecipeController@update');
});
