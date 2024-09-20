<?php

use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/employee', [EmployeeController::class , 'index'])->middleware('auth:sanctum')->name('employee');
    Route::get('/employee/create', [EmployeeController::class , 'create'])->middleware('auth:sanctum')->name('employee.create');
    Route::get('/employee/{id}', [EmployeeController::class , 'edit'])->middleware('auth:sanctum')->name('employee.create');
    Route::post('/employee', [EmployeeController::class , 'store'])->middleware('auth:sanctum')->name('employee.store');
    Route::patch('/employee/{id}', [EmployeeController::class , 'update'])->middleware('auth:sanctum')->name('employee.update');
    Route::delete('/employee/{id}', [EmployeeController::class , 'destroy'])->middleware('auth:sanctum')->name('employee.destroy');
});
    