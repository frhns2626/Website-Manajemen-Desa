<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendudukController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);


Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/penduduk', [PendudukController::class, 'index']);
Route::get('/penduduk/create', [PendudukController::class, 'create']);
Route::get('/penduduk/{id}', [PendudukController::class, 'edit']);
Route::post('/penduduk', [PendudukController::class, 'store']);
Route::put('/penduduk/{id}', [PendudukController::class, 'update']);
Route::delete('/penduduk/{id}', [PendudukController::class, 'destroy']);
