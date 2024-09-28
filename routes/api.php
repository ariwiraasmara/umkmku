<?php
//! Coyright @ Syahri Ramadhan Wiraasmara (ARI)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Libraries\myroute;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Suggested code may be subject to a license. Learn more: ~LicenseLog:4215889592.
Route::post('login', myroute::API('UserController','login'));
Route::post('daftar-pengguna-baru', myroute::API('UserController', 'register_dm'));

Route::put('update/password', myroute::API('UserController','update_password'));
Route::put('update/telpon', myroute::API('UserController','update_telpon'));
Route::put('update/profil', myroute::API('UserController','update_profil'));
Route::post('logout', myroute::API('UserController', 'logout'));



//? Di bawah ini cuma percobaan
Route::get('/hello', function () {
    return 'hello get';
});

Route::post('/hello', function (Request $request) {
    return 'hello post \n' . $request . '\n';
});

Route::put('/hello', function (Request $request) {
    return 'hello put \n' . $request . '\n';
});

Route::delete('/hello', function (Request $request) {
    return 'hello delete \n' . $request . '\n';
});

Route::get('/hello1', myroute::API('HelloController', 'hello2'));