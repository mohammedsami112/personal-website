<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\projectsController;
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

// Auth 
Route::group(['prefix' => 'auth', 'controller' => authController::class], function() {
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
});


Route::group(['middleware' => 'auth:sanctum'], function() {

    // Projects
    Route::group(['prefix' => 'projects', 'controller' => projectsController::class], function() {

        Route::get('/', 'getProjects');
        Route::post('create', 'createProject');
    });

});
