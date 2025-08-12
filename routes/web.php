<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Auth
Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);


Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware('role:Admin,User');

Route::get('/penduduk', [PendudukController::class, 'index'])->middleware('role:Admin');
Route::get('/penduduk/create', [PendudukController::class, 'create'])->middleware('role:Admin');
Route::get('/penduduk/{id}', [PendudukController::class, 'edit'])->middleware('role:Admin');
Route::post('/penduduk', [PendudukController::class, 'store'])->middleware('role:Admin');
Route::put('/penduduk/{id}', [PendudukController::class, 'update'])->middleware('role:Admin');
Route::delete('/penduduk/{id}', [PendudukController::class, 'destroy'])->middleware('role:Admin');

Route::get('/daftar-akun', [UserController::class, 'account_list_view'])->middleware('role:Admin');


Route::get('/permintaan-akun', [UserController::class, 'account_request_view'])->middleware('role:Admin');
Route::post('/permintaan-akun/approval/{id}', [UserController::class, 'account_approval'])->middleware('role:Admin');

Route::get('/profile', [UserController::class, 'profile_view'])->middleware('role:Admin,User');
Route::post('/profile/{id}', [UserController::class, 'update_profile'])->middleware('role:Admin,User');
Route::get('/changePassword', [UserController::class, 'changePassword_view'])->middleware('role:Admin,User');
Route::post('/changePassword/{id}', [UserController::class, 'changePassword'])->middleware('role:Admin,User');