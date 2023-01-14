<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageManagementTableController;
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
    Route::get('images', [ImageManagementTableController::class, 'index']);
    Route::post('cimages', [ImageManagementTableController::class, 'store']);//post (title,description,img(file))
    Route::get('images/{id}', [ImageManagementTableController::class, 'show']);
    Route::post('imagesup', [ImageManagementTableController::class, 'update']);//post (id,title,description,img(file))
    Route::post('imgdel/{id}', [ImageManagementTableController::class, 'destroy']);
});

