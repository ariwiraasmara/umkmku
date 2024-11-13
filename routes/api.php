<?php
//! Coyright @ Syahri Ramadhan Wiraasmara (ARI)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Libraries\myroute;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Suggested code may be subject to a license. Learn more: ~LicenseLog:4215889592.
Route::post('/login', myroute::API('UserController','login'));
Route::post('/daftar-pengguna-baru', myroute::API('UserController', 'register_dm'));

Route::get('/dashboard', myroute::API('UserController', 'dashboard'));

Route::get('/profil', myroute::API('UserController', 'profil'));
Route::post('/profil/update', myroute::API('UserController','updateProfil'));
Route::put('/profil/update/telpon', myroute::API('UserController','updateTelpon'));
Route::put('/profil/update/password', myroute::API('UserController','update_password'));

Route::get('/pegawai/detil/{id}', myroute::API('UserController', 'getStaff'));
Route::post('/pegawai/baru', myroute::API('UserController', 'store_staff'));
Route::post('/pegawai/update', myroute::API('UserController', 'update_staff'));
Route::get('/pegawai/delete/{id}', myroute::API('UserController','deleteUser'));
Route::get('/logout', myroute::API('UserController', 'logout'));

Route::get('/umkm/{by}/{orderBy}', myroute::API('UmkmkuController', 'getAll'));
Route::get('/umkmdetil/{id}', myroute::API('UmkmkuController', 'get'));
Route::post('/umkm/baru', myroute::API('UmkmkuController', 'store'));
Route::post('/umkm/update', myroute::API('UmkmkuController', 'update'));
Route::get('/umkmdelete/{id}', myroute::API('UmkmkuController', 'delete'));

Route::get('/produk/{id}', myroute::API('ProdukkuController', 'getAll'));
Route::get('/produk/detil/{id}', myroute::API('ProdukkuController', 'get'));
Route::post('/produk/baru', myroute::API('ProdukkuController', 'store'));
Route::post('/produk/update', myroute::API('ProdukkuController', 'update'));
Route::get('/produk/delete/{id}', myroute::API('ProdukkuController', 'delete'));

Route::get('/transaksi/{id}', myroute::API('TransaksiController', 'getAll'));
Route::get('/transaksi/detil/{id}', myroute::API('TransaksiController', 'get'));
Route::post('/transaksi/baru', myroute::API('TransaksiController', 'store'));
Route::get('/transaksi/delete/{id}', myroute::API('TransaksiController', 'delete'));

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
