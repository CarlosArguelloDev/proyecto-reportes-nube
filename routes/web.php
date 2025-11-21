<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ZonaController;

// Mis reportes
Route::get('/mis-reportes', [ReporteController::class, 'misReportes'])->name('reportes.mis');
Route::get('/reportes/atendidos', [ReporteController::class, 'atendidos'])->name('reportes.atendidos');
Route::resource('reportes', ReporteController::class);
Route::post('reportes/{reporte}/comentarios', [ComentarioController::class, 'store'])
    ->name('reportes.comentarios.store');


Route::get('/zonas', [ZonaController::class, 'index'])->name('zonas.index');

