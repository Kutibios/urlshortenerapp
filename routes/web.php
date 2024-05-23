<?php

use App\Http\Controllers\UrlController;

Route::get('/', [UrlController::class, 'index']);
Route::post('/shorten', [UrlController::class, 'store']);

Route::get('/', [UrlController::class, 'index']);
Route::post('/shorten', [UrlController::class, 'store']);
Route::get('/{shortenedUrl}', [UrlController::class, 'redirect']);
