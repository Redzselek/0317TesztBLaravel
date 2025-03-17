<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


Route::get('/', function () {
    return view('welcome');
});


Route::controller(ApiController::class)->group(function () {
    Route::get('/api/movies', 'Filmek');
    Route::get('/api/movies/{query}', 'FilmKereses');
    Route::post('/api/rentals', 'Kolcsonzes');
    Route::put('/api/rentals/{id}/return', 'Visszavitel');
    Route::get('/api/rentals', 'Kolcsonzesek');
});