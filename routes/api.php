<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;


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




//ruta para iniciar sesion por defecto {"email":"pablocerezo@gmail.com" , "password":12345}
Route::post('login', [AuthController::class, 'login']);


//Proteccion de rutas con token - Laravel Sanctum

//ruta para crear usuario
Route::middleware('auth:sanctum')->post('users/registro', [AuthController::class, 'store']);

//ruta para listar usuarios
Route::middleware('auth:sanctum')->get('users', [AuthController::class, 'show']);

//ruta para modificar usuarios
Route::middleware('auth:sanctum')->put('users/{id}', [AuthController::class, 'update']);

//ruta para eliminar usuarios
Route::middleware('auth:sanctum')->delete('users/{id}', [AuthController::class, 'delete']);


//--------------------------------------------------------------
//ruta para crear roles
Route::middleware('auth:sanctum')->post('roles/create', [RoleController::class, 'create']);

//ruta para listar roles
Route::middleware('auth:sanctum')->get('roles', [RoleController::class, 'show']);

//ruta para modificar roles
Route::middleware('auth:sanctum')->put('roles/{id}', [RoleController::class, 'update']);

//ruta para eliminar roles
Route::middleware('auth:sanctum')->delete('roles/{id}', [RoleController::class, 'delete']);


//--------------------------------------------------------------------------
//asignar rol a un usuario
Route::middleware('auth:sanctum')->post('users/{id}/asignar-rol', [RoleController::class, 'asignarRol']);

//Listar usuarios que pertenecen a rol
Route::middleware('auth:sanctum')->get('roles/{id}/users', [RoleController::class, 'listaRolUsuarios']);







