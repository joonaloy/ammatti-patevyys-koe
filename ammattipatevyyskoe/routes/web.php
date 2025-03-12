<?php

use App\Http\Controllers\KoeController;
use App\Http\Controllers\OpettajaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/koe');
});

Route::get('/koe', [KoeController::class, "index"])->name("koe.index");
Route::get('/koe/login', [KoeController::class, "login_view"])->name("koe.login_view");
Route::post('/koe/login', [KoeController::class, "login"])->name("koe.login");
Route::post('/koe/result', [KoeController::class, "result"])->name("koe.result");


Route::get("/opettaja", [OpettajaController::class,"index"])->name("opettaja.index");
Route::get("/opettaja/login", [OpettajaController::class,"login_view"])->name("opettaja.login_view");
Route::post("/opettaja/login", [OpettajaController::class,"login"])->name("opettaja.login");
Route::get("/opettaja/create_user", [OpettajaController::class,"create_user_view"])->name("opettaja.create_user_view");
Route::post("/opettaja/create_user", [OpettajaController::class,"create_user"])->name("opettaja.create_user");


Route::get("/opettaja/view/{id}", [OpettajaController::class,"view"])->name("opettaja.view");
Route::delete("/opettaja/delete/{id}", [OpettajaController::class,"delete"])->name("opettaja.delete");

Route::get("/opettaja/questions", [OpettajaController::class,"questions"])->name("opettaja.questions");
Route::get("/opettaja/questions/edit/{group}/{series}", [OpettajaController::class,"edit_questions_view"])->name("opettaja.edit_questions_view");
Route::post("/opettaja/questions", [OpettajaController::class,"edit_questions"])->name("opettaja.edit_questions");




