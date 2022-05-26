<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\IntervencionController;

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

//Usuario
Route::get('/user', [UsuarioController::class, 'index']);
Route::get('/user/this', [UsuarioController::class, 'user'])->middleware('auth:api');
Route::get('/user/{id}', [UsuarioController::class, 'show']);
Route::post('/user', [UsuarioController::class, 'register']);
Route::post('/user/image/{id}', [UsuarioController::class, 'updateUserImage']);
Route::put('/user/{id}', [UsuarioController::class, 'update']);
Route::delete('/user/{id}', [UsuarioController::class, 'destroy']);

//Noticias
Route::get('/news', [NoticiaController::class, 'index']);
Route::get('/news/{id}', [NoticiaController::class, 'show']);
Route::get('/news/page/{page}', [NoticiaController::class, 'showPaginate']);
Route::post('/news', [NoticiaController::class, 'store']);
Route::put('/news/{id}', [NoticiaController::class, 'update']);
Route::delete('/news/{id}', [NoticiaController::class, 'destroy']);

//Solicitudes
Route::get('/requests', [SolicitudController::class, 'index']);
Route::get('/requests/{id}', [SolicitudController::class, 'show']);
Route::get('/requests/status/{id}', [SolicitudController::class, 'search']);
Route::post('/requests', [SolicitudController::class, 'store']);
Route::put('/requests/{id}', [SolicitudController::class, 'update']);
Route::put('/requests/{id}/status/{status}', [SolicitudController::class, 'updateStatus']);
Route::delete('/requests/{id}', [SolicitudController::class, 'destroy']);

//Intervenciones
Route::get('/interventions', [IntervencionController::class, 'index']);
Route::get('/interventions/{id}', [IntervencionController::class, 'show']);
Route::get('/interventions/request/{id}', [IntervencionController::class, 'search']);
Route::post('/interventions', [IntervencionController::class, 'store']);
Route::put('/interventions/{id}', [IntervencionController::class, 'update']);
Route::delete('/interventions/{id}', [IntervencionController::class, 'destroy']);
