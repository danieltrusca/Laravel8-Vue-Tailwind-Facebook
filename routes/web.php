<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;




Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('{any}', [AppController::class, 'index'])
    ->where('any', '.*')
    ->middleware('auth')
    ->name('home');
