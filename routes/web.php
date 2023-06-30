<?php

use App\Http\Controllers\Api\CityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/buscaibge');
});

Route::get('/buscaibge', [CityController::class, 'index']);

Route::get('/buscaibgeEstado', [CityController::class, 'listCities'])->name('pagintedcities');