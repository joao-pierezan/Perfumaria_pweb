<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\perfumeController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('main');
});

// Rotas para Perfume
Route::get('/perfume', [PerfumeController::class, 'index']);
Route::get('/perfume/create', [PerfumeController::class, 'create']);
Route::post(
    '/perfume/store',
    [PerfumeController::class, 'store']
)->name('perfume.store');

Route::get('/perfume/edit/{id}',
    [PerfumeController::class, 'edit']
)->name('perfume.edit');
Route::put(
    '/perfume/update/{id}',
    [PerfumeController::class, 'update']
)->name('perfume.update');

Route::delete(
    '/perfume/{id}',
    [PerfumeController::class, 'destroy']
)->name('perfume.destroy');

Route::get(
    '/perfume/search',
    [PerfumeController::class, 'search']
)->name('perfume.search');

// Rotas para Avaliações
Route::get(
    '/avaliacoes', 
    [App\Http\Controllers\AvaliacoesController::class, 'index']
)->name('avaliacoes.index');

Route::get(
    '/avaliacoes/create', 
    [App\Http\Controllers\AvaliacoesController::class, 'create']
)->name('avaliacoes.create');

Route::post(
    '/avaliacoes/store', 
    [App\Http\Controllers\AvaliacoesController::class, 'store']
)->name('avaliacoes.store');

Route::get(
    '/avaliacoes/edit/{id}', 
    [App\Http\Controllers\AvaliacoesController::class, 'edit']
)->name('avaliacoes.edit');

Route::put(
    '/avaliacoes/update/{id}', 
    [App\Http\Controllers\AvaliacoesController::class, 'update']
)->name('avaliacoes.update');

Route::delete(
    '/avaliacoes/{id}', 
    [App\Http\Controllers\AvaliacoesController::class, 'destroy']
)->name('avaliacoes.destroy');

Route::post(
    '/avaliacoes/search', 
    [App\Http\Controllers\AvaliacoesController::class, 'search']
)->name('avaliacoes.search');

//rotas para usuarios

Route::get('/usuario', [UsuarioController::class, 'index']);
Route::get('/usuario/create', [UsuarioController::class, 'create']);
Route::post(
    '/usuario/store',
    [UsuarioController::class, 'store']
)->name('usuario.store');

Route::get('/usuario/edit/{id}',
    [UsuarioController::class, 'edit']
)->name('usuario.edit');
Route::put(
    '/usuario/update/{id}',
    [UsuarioController::class, 'update']
)->name('usuario.update');

Route::delete(
    '/usuario/{id}',
    [UsuarioController::class, 'destroy']
)->name('usuario.destroy');

Route::post(
    '/perfume/search',
    [UsuarioController::class, 'search']
)->name('usuario.search');
Route::get('/perfume/{id}', [PerfumeController::class, 'show'])->name('perfume.show');

