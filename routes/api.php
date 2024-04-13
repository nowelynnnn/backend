<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarouselItemsController; // Comment about import
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

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
Route::post('/login', [AuthController::class, 'login'])->name('users.login');
Route::post('/user', [UserController::class, 'store'])->name('users.store');

// PRIVATE APIs
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('users.logout');

    Route::controller(CarouselItemsController::class)->group(function () {
        Route::get('/carousel', 'index');
        Route::get('/carousel/{id}', 'show');
        Route::post('/carousel', 'store');
        Route::put('/carousel/{id}', 'update');
        Route::delete('/carousel/{id}', 'destroy');
    });
    
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index');
        Route::get('/user/{id}', 'show');
        Route::put('/user/{id}', 'update')->name('users.update');
        Route::put('/user/email/{id}', 'email')->name('users.email');
        Route::put('/user/password/{id}', 'password')->name('users.password');
        Route::put('/user/image/{id}', 'image')->name('users.image');
        Route::delete('/user/{id}', 'destroy');
    });

    // User specific APIs
    Route::get('/profile/show', [ProfileController::class, 'show']); // GET for reading
    Route::put('/profile/image', [ProfileController::class, 'image'])->name('profile.image'); // Update for a specific user
});
