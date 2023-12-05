<?php

use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\RegisterController;
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
Route::middleware( 'auth:sanctum' )->get( '/user', function ( Request $request
) {
    return $request->user();
} )->middleware( 'ability:user-show' );
