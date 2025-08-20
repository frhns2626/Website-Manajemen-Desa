<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Auth
Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);

//Admin
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware('role:Admin,User');

Route::get('/notifications', function () {
    return view('pages.notifications');
});
Route::post('/notification/{id}/read', function ($id) {
    $notification = \Illuminate\Support\Facades\DB::table('notifications')->where('id', $id);
    $notification->update([
        'read_at' => \Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'),
    ]);

    $dataArray = json_decode($notification->firstOrFail()->data, true);

    if (isset($dataArray['complaint_id'])) {
        return redirect('/complaint');
    }

    return back();
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

//User
Route::get('/complaint', [ComplaintController::class, 'index'])->middleware('role:Admin,User');
Route::get('/complaint/create', [ComplaintController::class, 'create'])->middleware('role:User');
Route::get('/complaint/{id}', [ComplaintController::class, 'edit'])->middleware('role:User');
Route::post('/complaint', [ComplaintController::class, 'store'])->middleware('role:User');
Route::put('/complaint/{id}', [ComplaintController::class, 'update'])->middleware('role:User');
Route::delete('/complaint/{id}', [ComplaintController::class, 'destroy'])->middleware('role:User');
Route::post('/complaint/update-status/{id}', [ComplaintController::class, 'update_status'])->middleware('role:Admin');
