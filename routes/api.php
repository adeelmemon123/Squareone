<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;


// In routes/web.php
Route::get('/test', function () {
    return 'Hello, World!';


});


Route::middleware('api')->group(function () {
    Route::post('register', [RegisterController::class, 'register']);
});





