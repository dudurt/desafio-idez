<?php

use App\Http\Controllers\Api\CityController;
use Illuminate\Support\Facades\Route;

Route::prefix('city')->group(function () {
    Route::get('list', [CityController::class, 'list']);
});

Route::any('/', function () {
    return "Start of idez project...";
});