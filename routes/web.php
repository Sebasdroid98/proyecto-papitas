<?php

use App\Custom\Queries\Empleado;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/datos', function () {
        return DB::select("SELECT * FROM EMPLEADOS");
    });
});

// Route::middleware('auth')->group(function () {
//     Route::get('/datos', function () {
//         // return DB::select("SELECT * FROM EMPLEADOS");
//         return (new Empleado)->getListaEmpleados();
//     });
// });

Route::controller(EmpleadoController::class)->group(function () {
    Route::get('empleados.index', 'index');
});

require __DIR__.'/auth.php';
