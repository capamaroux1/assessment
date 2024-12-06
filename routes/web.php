<?php

use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false
]);

Route::middleware(['auth','can:is_admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('calendar-events', App\Http\Controllers\CalendarEventController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
});
