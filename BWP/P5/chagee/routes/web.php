<?php

use App\Http\Controllers\ChageeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [ChageeController::class, 'index']);

// Route::get('/about', function () {
//     return view('about');
// });
Route::get('/about', [ChageeController::class, 'about']);

// Route::get('/menu', function () {
//     return view('menu');
// });
Route::get('/menu', [ChageeController::class, 'menu']);

// Route::get('/media', function () {
//     return view('media');
// });
Route::get('/media', [ChageeController::class, 'media']);

// Route::get('/contact', function () {
//     return view('contact');
// });
Route::get('/contact', [ChageeController::class, 'contact']);