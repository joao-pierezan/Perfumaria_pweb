<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfumeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\VendasController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
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

Route::get(
    '/perfume/report-longevidade/{id}',
    [PerfumeController::class, 'reportLongevidade']
)->name('perfume.reportLongevidade');

Route::get(
    '/perfume/{id}',
    [PerfumeController::class, 'show']
)->name('perfume.show');

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
    '/usuario/search',
    [UsuarioController::class, 'search']
)->name('usuario.search');

// Rotas para Notas Olfativas
Route::get('/notas', [NotasController::class, 'index'])->name('notas.index');
Route::get('/notas/create', [NotasController::class, 'create'])->name('notas.create');
Route::post('/notas/store', [NotasController::class, 'store'])->name('notas.store');
Route::get('/notas/edit/{id}', [NotasController::class, 'edit'])->name('notas.edit');
Route::put('/notas/update/{id}', [NotasController::class, 'update'])->name('notas.update');
Route::delete('/notas/{id}', [NotasController::class, 'destroy'])->name('notas.destroy');
Route::post('/notas/search', [NotasController::class, 'search'])->name('notas.search');

Route::get('vendas/report', [VendasController::class, 'report'])->name('vendas.report');
Route::get('vendas/chart', [VendasController::class, 'chart'])->name('vendas.chart');
Route::get('vendas/search', [VendasController::class, 'search'])->name('vendas.search');
Route::resource('vendas', VendasController::class);
