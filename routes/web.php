<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DirectorController;
use App\Http\Controllers\EnfermeriaController;
use App\Http\Controllers\MedicoController;

use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ReporteController;



Route::get('/', function () {
    return view('welcome');
});



// ==========================
// DASHBOARDS
// ==========================

Route::get('/director/dashboard',
    [DirectorController::class, 'index'])
    ->middleware(['auth', 'director'])
    ->name('director.dashboard');

Route::get('/director/pedidos',
    [PedidoController::class, 'directorIndex'])
    ->middleware(['auth', 'director'])
    ->name('director.pedidos');

Route::get('/director/reportes',
    [ReporteController::class, 'directorIndex'])
    ->middleware(['auth', 'director'])
    ->name('director.reportes');

Route::patch('/director/pedidos/{solicitud}/estado',
    [PedidoController::class, 'directorUpdateStatus'])
    ->middleware(['auth', 'director'])
    ->name('director.pedidos.status');

Route::get('/enfermeria/dashboard',
    [EnfermeriaController::class, 'index'])
    ->middleware(['auth', 'enfermeria'])
    ->name('enfermeria.dashboard');

Route::get('/medico/dashboard',
    [MedicoController::class, 'index'])
    ->middleware(['auth', 'medico'])
    ->name('medico.dashboard');

Route::get('/dashboard', function () {

   return view('dashboard');

})->middleware(['auth', 'verified'])
  ->name('dashboard');




// ==========================
// RUTAS PROTEGIDAS
// ==========================

Route::middleware('auth')->group(function () {



    // ==========================
    // PROFILE
    // ==========================

    Route::get('/profile',
        [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile',
        [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile',
        [ProfileController::class, 'destroy'])
        ->name('profile.destroy');



    // ==========================
    // MEDICAMENTOS
    // ==========================

    Route::get('/medicamentos',
        [MedicamentoController::class,'index'])
        ->name('medicamentos.index');

    Route::get('/medicamentos/create',
        [MedicamentoController::class, 'create'])
        ->name('medicamentos.create');

    Route::post('/medicamentos/store',
        [MedicamentoController::class, 'store'])
        ->name('medicamentos.store');

    Route::get('/medicamentos/edit/{medicamento}',
        [MedicamentoController::class,'edit'])
        ->name('medicamentos.edit');

    Route::put('/medicamentos/update/{medicamento}',
        [MedicamentoController::class,'update'])
        ->name('medicamentos.update');

    Route::delete('/medicamentos/delete/{medicamento}',
        [MedicamentoController::class,'destroy'])
        ->name('medicamentos.destroy');



    // ==========================
    // PEDIDOS
    // ==========================

    Route::get('/pedidos',
        [PedidoController::class,'index'])
        ->name('pedidos.index');

    Route::post('/pedidos/store',
        [PedidoController::class,'store'])
        ->name('pedidos.store');


    // ==========================
    // REPORTES
    // ==========================

    Route::get('/reportes',
        [ReporteController::class,'index'])
        ->name('reportes.index');

});



require __DIR__.'/auth.php';