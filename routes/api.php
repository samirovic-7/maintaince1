<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ActivitylogController;
use App\Http\Controllers\Api\V1\Permission\RoleController;
use App\Http\Controllers\Api\V1\Permission\PermissionController;
use App\Http\Controllers\LocalizationController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('user-auth_butt',[AuthController::class,'logout']);
    
});

Route::post('user-register',[AuthController::class,'register']);
Route::post('user-login',[AuthController::class,'login']);


Route::get('activities',[ActivitylogController::class,'index']);


Route::get('users',[AuthController::class,'users']);
Route::get('user',[AuthController::class,'user']);
Route::resource('language',LocalizationController::class);

Route::get('getAllPermissios', [PermissionController::class,'index']);
Route::post('getPermissionById/{id}', [PermissionController::class,'getPermissionForUser']);
Route::post('updatePermission', [PermissionController::class,'update']);
Route::post('storePermission', [PermissionController::class,'store']);
Route::post('permissionDelete/{id}', [PermissionController::class,'delete']);


Route::get('getAllRoles', [RoleController::class,'index']);   
Route::post('ruleById', [RoleController::class,'getRoleForUser']);
Route::post('storeRole', [RoleController::class,'store']);
Route::post('updateRole', [RoleController::class,'updateRole']);
Route::post('deleteRole/{id}', [RoleController::class,'destroy']);


Route::middleware('tenant')->group(function() {
    // routes
});

