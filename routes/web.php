<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SecretController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::view('/', 'welcome')->name('home');

Route::prefix('secret')->name('secrets.')->group(function () {
    Route::get('/create', [SecretController::class, 'create'])->name('create');  // Форма создания
    Route::post('/', [SecretController::class, 'store'])->name('store');         // Сохранить секрет
    Route::get('/{token}', [SecretController::class, 'show'])->name('show');     // Показать секрет
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
