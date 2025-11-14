<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ComentarioController;

Route::resource('reportes', ReporteController::class);

Route::post('reportes/{reporte}/comentarios', [ComentarioController::class, 'store'])
    ->name('reportes.comentarios.store');