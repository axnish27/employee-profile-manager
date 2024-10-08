<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;


// Route::get('/', function () {return view('admin');})->name('index')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'auth:sanctum'])->group(function () {
    Route::get('company/draw', [CompanyController::class, 'draw'])->name('company.draw');
    Route::resource('companys', CompanyController::class);
});



require __DIR__.'/auth.php';
require __DIR__.'/api.php';
