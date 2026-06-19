<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

Route::get('/', [PortfolioController::class, 'beranda'])->name('beranda');
Route::get('/profil', [PortfolioController::class, 'profil'])->name('profil');
Route::get('/pengalaman/{id}', [PortfolioController::class, 'detail'])->name('detail');

Route::get('/hobi/film', [PortfolioController::class, 'hobiFilm'])->name('hobi.film');
Route::get('/hobi/musik', [PortfolioController::class, 'hobiMusik'])->name('hobi.musik');
Route::get('/hobi/buku', [PortfolioController::class, 'hobiBuku'])->name('hobi.buku');
Route::get('/hobi/olahraga', [PortfolioController::class, 'hobiOlahraga'])->name('hobi.olahraga');