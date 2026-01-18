<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v2\AuthController as V2AuthController;
use App\Http\Controllers\Api\v1\CourseController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/course', [CourseController::class, 'store']);
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
});


Route::prefix('v2')->group(function () {

    Route::post('register', [V2AuthController::class, 'register']);
    Route::post('login', [V2AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [V2AuthController::class, 'logout']);
    });

});



