<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CobaController;
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
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/ambil', [CobaController::class, 'show']);
    Route::get('/logout', [CobaController::class, 'logout']);
    Route::post('/tambah', [CobaController::class, 'store']);
    Route::get('/edit/{id}', [CobaController::class, 'edit']);
    Route::put('/update/{id}', [CobaController::class, 'update']);
    Route::delete('/hapus/{id}', [CobaController::class, 'destroy']);

});




Route::post('/login',[CobaController::class,'login']);


