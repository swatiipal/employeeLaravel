<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/employee', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee',[EmployeeController::class,'store'])->name('employee.store');
Route::get('/',[EmployeeController::class,'view'])->name('employee.view');
Route::get('/edit/{id}',[EmployeeController::class,'edit'])->name('employee.edit');