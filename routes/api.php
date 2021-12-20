<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|php
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});





//without auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/comments', [CommentController::class, 'index']);


//authorized
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('/comment')->group(function () {
        Route::post('/create', [CommentController::class, 'create']);
        Route::delete('/{id}', [CommentController::class, 'destroy']);
    });

    Route::get('/getUser', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

