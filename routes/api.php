<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarouselItemsController; //nagbase ni sya asa gi import sa file
use App\Http\Controllers\Api\UserController;

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
// PUBLIC APIs
Route::post('/login', [AuthController::class,'login' ])->name('users.login');;
Route::post('/user', [UserController::class,'store' ])->name('users.store');
 

// PRIVATE APIs
Route::middleware(['auth:sanctum'])->group(function () {
Route::post('/logout', [AuthController::class,'logout' ]);

     Route::controller(CarouselItemsController::class)->group(function () { 
        Route::get('/carousel',             'index');
        Route::get('/carousel/{id}',        'show');
        Route::post('/carousel',            'store');
        Route::put('/carousel/{id}',        'update');
        Route::delete('/carousel/{id}',     'destroy');
    });
    
    Route::controller(UserController::class)->group(function () {    
        Route::get('/user',                 'index');
        Route::get('/user/{id}',            'show');
        Route::put('/user/{id}',            'update')->name('users.update');
        Route::put('/user/email/{id}',      'email')->name('users.email');
        Route::put('/user/password/{id}',   'password')->name('users.password');
        Route::delete('/user/{id}',         'destroy');
        });
});




// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/{id}', [UserController::class, 'show']);
// Route::post('/user', [UserController::class, 'store'])->name('users.store');
// Route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
// Route::put('/user/email/{id}', [UserController::class, 'email'])->name('users.email');
// Route::put('/user/password/{id}', [UserController::class, 'password'])->name('users.password');
// Route::delete('/user/{id}', [UserController::class, 'destroy']);