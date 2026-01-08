<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;

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

// Public Auth Routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/forgot-password', 'forgotPassword');
    Route::post('/reset-password',  'resetPassword');
});


// Public Category Routes
Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index');
    Route::get('/categories/featured', 'featured');
    Route::get('/categories/{identifier}', 'show');
    Route::get('/subcategories', 'subcategories');
    Route::get('/subcategories/{identifier}', 'showSubcategory');
    Route::get('/categories/{categoryIdentifier}/subcategories', 'subcategoriesByCategory');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout',  'logout');
        Route::get('/profile',  'profile');
        Route::put('/profile',  'updateProfile');
        Route::post('/change-password',  'changePassword');
    });
});
