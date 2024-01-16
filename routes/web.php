<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ExcelImportController;

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



Route::get('/employee', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/', [EmployeeController::class, 'view'])->name('employee.view') ;
Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit')->middleware('guard');
Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('employee.update')->middleware('guard');
Route::get('/view/trash', [EmployeeController::class, 'trash'])->name('employee.trash')->middleware('guard');
Route::get('/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.delete')->middleware('guard');
Route::get('employee/force-delete/{id}', [EmployeeController::class, 'forceDelete'])->name('employee.force-delete')->middleware('guard');
Route::get('/restore/{id}', [EmployeeController::class, 'restore'])->name('employee.restore')->middleware('guard');

Route::get(
    '/login',
    function () {
        session()->put('email', 1);
        return redirect('/');
    }
);
Route::get(
    '/logout',
    function () {
        session()->forget('email');
        return redirect('/');
    }
);
Route::get(
    '/no-access',
    function () {
        echo "You are not allowed to access this Page...";
        die;
    }
);

Route::get('/city', [EmployeeController::class, 'city']);
Route::post('/city', [EmployeeController::class, 'getCity']);

//Excel Import Export
Route::get('employee/import/', [EmployeeController::class, 'index'])->name('import.employee');
Route::post('employee/import/', [EmployeeController::class, 'import']);

Route::get('employee/export/', [EmployeeController::class, 'export'])->name('export.employee');

Route::get('/login',[EmployeeController::class, 'login']);
Route::post('/login', [EmployeeController::class, 'storedata'])->name('login.store');