<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', function () {
    return 'Hello World';
});


Route::get('loop', function () {
    return view('loop');
});

Route::get('test-controller', [TestController::class, 'test']);

Route::get('test-controller2', [TestController::class, 'test2']);