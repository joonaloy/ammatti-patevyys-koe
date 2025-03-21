<?php

use App\Http\Controllers\KoeController;
use App\Http\Controllers\OpettajaController;
use App\Http\Middleware\opettajaAuth;
use App\Http\Middleware\userAuth;
use Illuminate\Support\Facades\Route;
//index sivu on koe
Route::get('/', function () {
    return redirect('/koe');
});
//jokainen reitti
Route::get('/koe', [KoeController::class, "index"])->name("koe.index")->middleware(userAuth::class);
Route::get('/koe/login', [KoeController::class, "login_view"])->name("koe.login_view");
Route::post('/koe/login', [KoeController::class, "login"])->name("koe.login");
Route::post('/koe/result', [KoeController::class, "result"])->name("koe.result")->middleware(userAuth::class);


Route::get("/opettaja", [OpettajaController::class, "index"])->name("opettaja.index")->middleware(opettajaAuth::class);
Route::get("/opettaja/login", [OpettajaController::class, "login_view"])->name("opettaja.login_view");
Route::post("/opettaja/login", [OpettajaController::class, "login"])->name("opettaja.login");
Route::get("/opettaja/create_user", [OpettajaController::class, "create_user_view"])->name("opettaja.create_user_view")->middleware(opettajaAuth::class);
Route::post("/opettaja/create_user", [OpettajaController::class, "create_user"])->name("opettaja.create_user")->middleware(opettajaAuth::class);


Route::get("/opettaja/view/{id}", [OpettajaController::class, "view"])->name("opettaja.view")->middleware(opettajaAuth::class);
Route::get("/opettaja/delete/{id}", [OpettajaController::class, "delete"])->name("opettaja.delete")->middleware(opettajaAuth::class);

Route::get("/opettaja/questions", [OpettajaController::class, "questions"])->name("opettaja.questions")->middleware(opettajaAuth::class);
Route::post("/opettaja/questions/edit", [OpettajaController::class, "edit_questions_view"])->name("opettaja.edit_questions_view")->middleware(opettajaAuth::class);
Route::post("/opettaja/questions", [OpettajaController::class, "edit_questions"])->name("opettaja.edit_questions")->middleware(opettajaAuth::class);
