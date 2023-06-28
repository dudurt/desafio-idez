<?php

use App\Http\Controllers\Api\CountyController;
use Illuminate\Support\Facades\Route;

Route::prefix('county')->group(function () {
    Route::get('list', [CountyController::class, 'list']);
});

Route::any('/', function () {
    return "Start of idez project...";
});