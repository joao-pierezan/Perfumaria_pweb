<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\perfumeController;

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

Route::post(
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