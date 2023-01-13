<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageManagementController;
use App\Http\Controllers\UserController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::post("login",[UserController::class,'index']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/images', [ImageManagementController::class, 'index']);
    Route::post('/images', [ImageManagementController::class, 'store']);
    Route::get('/images/{image}', [ImageManagementController::class, 'show']);
    Route::put('/images/{image}', [ImageManagementController::class, 'update']);
    Route::delete('/images/{image}', [ImageManagementController::class, 'destroy']);
});