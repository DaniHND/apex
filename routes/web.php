<?php

use App\Http\Controllers\AgenteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('agentes', AgenteController::class);
