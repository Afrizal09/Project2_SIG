<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegencyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jumlah_penduduk', [RegencyController::class, 'jumlah_penduduk']);
Route::get('/agama', [KabKotaController::class, 'agama']);
