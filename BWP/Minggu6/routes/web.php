<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;


Route::get('/', [MovieController::class, 'index'])->name('movies.index');

// ini untuk isa nerima id yang dilempar jadinya ada /{id}
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
