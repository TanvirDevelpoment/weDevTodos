<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\ItemController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/items',[ItemController::class, 'index']);
Route::get('/completedItems',[ItemController::class, 'completedItems']);
Route::get('/inCompletedItems',[ItemController::class, 'inCompletedItems']);
Route::get('/deleteCompletedItems',[ItemController::class, 'deleteCompletedItems']);
Route::put('/updateItemName/{id}',[ItemController::class, 'updateItemName']);
Route::prefix('/item')->group(function(){
    Route::post('/store',[ItemController::class, 'store']);
    Route::put('/{id}',[ItemController::class, 'update']);
    Route::delete('/{id}',[ItemController::class, 'destroy']);
});
