<?php

use App\Http\Controllers\AdminSenaCommentsController;
use App\Http\Controllers\AdminSenaController;
use App\Http\Controllers\ApiTableController;
use Illuminate\Support\Facades\Route;

// Página principal del panel administrativo.
Route::get('/', [AdminSenaController::class, 'index'])->name('home');
Route::get('/dashboard', [AdminSenaController::class, 'index'])->name('dashboard');

// CRUD de computadores: listar, crear, actualizar y eliminar.
Route::get('/computadores', [AdminSenaController::class, 'computadores'])->name('computadores');
Route::post('/computadores', [AdminSenaController::class, 'guardarComputador'])->name('computadores.guardar');
Route::put('/computadores/{computer}', [AdminSenaController::class, 'actualizarComputador'])->name('computadores.actualizar');
Route::delete('/computadores/{computer}', [AdminSenaController::class, 'eliminarComputador'])->name('computadores.eliminar');

// CRUD de aprendices.
Route::get('/aprendices', [AdminSenaController::class, 'aprendices'])->name('aprendices');
Route::post('/aprendices', [AdminSenaController::class, 'guardarAprendiz'])->name('aprendices.guardar');
Route::put('/aprendices/{apprentice}', [AdminSenaController::class, 'actualizarAprendiz'])->name('aprendices.actualizar');
Route::delete('/aprendices/{apprentice}', [AdminSenaController::class, 'eliminarAprendiz'])->name('aprendices.eliminar');

// CRUD de ofertas de formación.
Route::get('/ofertas', [AdminSenaController::class, 'ofertas'])->name('ofertas');
Route::post('/ofertas', [AdminSenaController::class, 'guardarOferta'])->name('ofertas.guardar');
Route::put('/ofertas/{offer}', [AdminSenaController::class, 'actualizarOferta'])->name('ofertas.actualizar');
Route::delete('/ofertas/{offer}', [AdminSenaController::class, 'eliminarOferta'])->name('ofertas.eliminar');

// CRUD de roles del sistema.
Route::get('/roles', [AdminSenaController::class, 'roles'])->name('roles');
Route::post('/roles', [AdminSenaController::class, 'guardarRol'])->name('roles.guardar');
Route::put('/roles/{role}', [AdminSenaController::class, 'actualizarRol'])->name('roles.actualizar');
Route::delete('/roles/{role}', [AdminSenaController::class, 'eliminarRol'])->name('roles.eliminar');

// Vistas informativas y consulta de tablas de la API externa.
Route::get('/centros', [AdminSenaController::class, 'centros'])->name('centros');
Route::get('/comentarios', [AdminSenaCommentsController::class, 'index'])->name('comentarios');
Route::get('/datos-api/{table}', [ApiTableController::class, 'index'])->name('datos-api.show');
