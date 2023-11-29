<?php

use App\Custom\Queries\Empleado;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\VentaController;
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
    // Route::get('/datos', function () {
    //     return DB::select("SELECT * FROM EMPLEADOS");
    // });
});

// Route::middleware('auth')->group(function () {
//     Route::get('/datos', function () {
//         // return DB::select("SELECT * FROM EMPLEADOS");
//         return (new Empleado)->getListaEmpleados();
//     });
// });

Route::controller(EmpleadoController::class)->group(function () {
    Route::get('empleados.index', 'index')->name('empleados.index');
    Route::get('empleados.edit/{id}', 'edit');
    // Route::get('empleados.delete/{id}', 'delete');
    Route::put('empleados.update/{id}', 'update')->name('empleados.update');
    Route::post('empleados.store', 'store')->name('empleados.store');
});

Route::controller(TareaController::class)->group(function () {
    Route::get('tareas.index', 'index')->name('tareas.index');
    Route::post('tareas.store', 'store')->name('tareas.store');
});

Route::controller(ClienteController::class)->group(function () {
    Route::get('clientes.index', 'index')->name('clientes.index');
    Route::post('clientes.store', 'store')->name('clientes.store');
});

Route::controller(VentaController::class)->group(function () {
    Route::get('ventas.index', 'index')->name('ventas.index');
    Route::post('ventas.store', 'store')->name('ventas.store');
});

require __DIR__.'/auth.php';
