<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;

Route::controller(AbsensiController::class)->group(function (): void {
    Route::get('/', 'home')->name('home');
    Route::get('/ukm', 'ukm')->name('organizations.ukm');
    Route::get('/ukk', 'ukk')->name('organizations.ukk');
    Route::get('/organizations/{id}', 'show')->whereNumber('id')->name('organizations.show');
});
