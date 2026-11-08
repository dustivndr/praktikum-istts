<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;

Route::controller(AbsensiController::class)->group(function (): void {
    Route::get('/', 'login')->name('home');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('login.authenticate');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'storeRegistration')->name('register.store');
    Route::post('/logout', 'logout')->name('logout');

    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/switch-mode/{mode}', 'switchMode')->whereIn('mode', ['ketua', 'mahasiswa'])->name('switch-mode');

    Route::prefix('admin')->name('admin.')->group(function (): void {
        Route::get('/dashboard', 'adminDashboard')->name('dashboard');
        Route::get('/organizations/{type?}', 'organizations')->whereIn('type', ['UKM', 'UKK'])->name('organizations');
        Route::get('/organizations/create', 'createOrganization')->name('organizations.create');
        Route::post('/organizations', 'storeOrganization')->name('organizations.store');
        Route::get('/organizations/{id}/detail', 'organizationShow')->whereNumber('id')->name('organizations.show');
        Route::post('/organizations/{id}/members', 'addMember')->whereNumber('id')->name('organizations.members.store');
        Route::get('/schedules', 'schedules')->name('schedules');
        Route::get('/schedules/create', 'createSchedule')->name('schedules.create');
        Route::post('/schedules', 'storeSchedule')->name('schedules.store');
        Route::post('/schedules/{scheduleId}/attendance', 'storeAttendance')->whereNumber('scheduleId')->name('attendance.store');
    });

    Route::prefix('mahasiswa')->name('student.')->group(function (): void {
        Route::get('/dashboard', 'studentDashboard')->name('dashboard');
        Route::get('/organizations', 'studentOrganizations')->name('organizations');
        Route::get('/explore', 'explore')->name('explore');
        Route::post('/organizations/{id}/join', 'joinOrganization')->whereNumber('id')->name('organizations.join');
        Route::get('/schedules', 'studentSchedules')->name('schedules');
        Route::get('/attendance', 'studentAttendance')->name('attendance');
    });

    Route::prefix('ketua')->name('chairman.')->group(function (): void {
        Route::get('/dashboard', 'chairmanDashboard')->name('dashboard');
    });
});
