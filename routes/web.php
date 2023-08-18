<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', [\App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.index');
Route::get('employee', [\App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');
Route::post('employee/store', [\App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
Route::get('employee/{id?}', [\App\Http\Controllers\EmployeeController::class, 'show'])->name('employee.show');
Route::get('employee/edit/{id?}', [\App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('employee/{id}', [\App\Http\Controllers\EmployeeController::class, 'update'])->name('employee.update');