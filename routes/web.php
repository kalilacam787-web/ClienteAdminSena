<?php

use App\Http\Controllers\AdminSenaController;
use App\Http\Controllers\AdminSenaCommentsController;
use App\Http\Controllers\ApiTableController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminSenaController::class, 'index'])->name('home');
Route::get('/computadores', fn () => app(ApiTableController::class)->index('computers'))->name('computadores');
Route::post('/computadores', [AdminSenaController::class, 'guardarComputador'])->name('computadores.guardar');
Route::get('/aprendices', fn () => app(ApiTableController::class)->index('apprentices'))->name('aprendices');
Route::post('/aprendices', [AdminSenaController::class, 'guardarAprendiz'])->name('aprendices.guardar');
Route::get('/ofertas', fn () => app(ApiTableController::class)->index('courses'))->name('ofertas');
Route::post('/ofertas', [AdminSenaController::class, 'guardarOferta'])->name('ofertas.guardar');
Route::get('/roles', [AdminSenaController::class, 'roles'])->name('roles');
Route::put('/roles/{role}', [AdminSenaController::class, 'actualizarRol'])->name('roles.actualizar');
Route::get('/centros', fn () => app(ApiTableController::class)->index('training-centers'))->name('centros');
Route::get('/comentarios', [AdminSenaCommentsController::class, 'index'])->name('comentarios');
Route::get('/datos-api/{table}', [ApiTableController::class, 'index'])->name('datos-api.show');
