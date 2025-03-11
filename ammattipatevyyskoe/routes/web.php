<?php

use App\Http\Controllers\KoeController;
use App\Http\Controllers\OpettajaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KoeController::class, "index"])->name("koe.index");

Route::get("/opettaja", [OpettajaController::class,"index"])->name("opettaja.index");
