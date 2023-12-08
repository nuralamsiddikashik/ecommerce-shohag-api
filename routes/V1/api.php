<?php

use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\RegisterController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::get( 'test', [TestController::class, 'index'] );
Route::post( 'register', [RegisterController::class, 'register'] );
Route::post( 'login', [LoginController::class, 'login'] );
Route::delete( 'logout', [LoginController::class, 'logout'] )->middleware(
    'auth:sanctum' );

Route::middleware( ['auth:sanctum'] )->group( function () {
    Route::controller( RoleController::class )->group( function () {
        Route::post( 'roles/{role}/sync-permissions', 'syncPermissions' )->
            middleware(
            'ability:role-edit' );
        Route::get( 'roles', 'index' )->name( 'roles.index' )->middleware(
            'ability:role-list' );
        Route::get( 'roles/{role}', 'show' )->name( 'role.show' )->middleware(
            'ability:role-show' );
        Route::post( 'roles', 'store' )->name( 'roles.store' )->middleware(
            'ability:role-create' );
        Route::put( 'roles/{role}', 'update' )->name( 'roles.update' )->
            middleware(
            'ability:role-edit' );
        Route::delete( 'roles/{role}', 'destroy' )->name( 'roles.delete' )->
            middleware(
            'ability:role-delete' );
    } );
    Route::middleware( 'auth:sanctum' )->get( '/user', function ( Request
         $request
    ) {
        return $request->user();
    } )->middleware( 'ability:user-show' );
} );
