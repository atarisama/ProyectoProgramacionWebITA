<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\EnfermeriaController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/director/dashboard',[DirectorController::class, 'index'])->middleware(['auth', 'director'])->name('director.dashboard');
Route::get('/enfermeria/dashboard',[EnfermeriaController::class, 'index'])->middleware(['auth', 'enfermeria'])->name('enfermeria.dashboard');

Route::get('/dashboard', function () {
   return view('dashboard');
})->middleware(['auth', 'verified',])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
