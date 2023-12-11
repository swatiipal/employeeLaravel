<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;

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
Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::get('/view/trash',[EmployeeController::class,'trash'])->name('register.trash');
Route::get('/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.delete');
Route::get('/trash/{id}', [EmployeeController::class, 'trash'])->name('employee.trash');

Route::get('/ajax',function(){
    return view('message');
});
Route::post('/getmsg',[AjaxController::class,'index']);

Route::get('/city',[EmployeeController::class,'city']);
Route::post('/city',[EmployeeController::class,'getCity']);