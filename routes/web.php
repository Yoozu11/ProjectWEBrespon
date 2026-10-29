<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;

Route :: get('/', function () {
    return redirect(auth()->check()
    ? '/mahasiswa' : '/login');
});

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::post('/mahasiswa', [MahasiswaController::class, 'store']);

Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit']);
Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update']);

Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy']);

Route :: middleware('guest')->group(function () {
Route :: get('/register', [AuthController :: class, 'showRegister'])
->name('register');
Route :: post('/register', [AuthController :: class, 'register']);
Route :: get('/login', [AuthController :: class, 'showLogin'])
->name('login');
Route :: post('/login', [AuthController :: class, 'login']);
});

Route :: middleware('auth')->group(function () {
Route :: resource('mahasiswa', MahasiswaController :: class);

Route :: post('/logout', [AuthController :: class, 'logout'])
->name('logout');
});