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

Route::post('/pengguna/karyawan-baru', myroute::API('UserController', 'register_nondm'));
Route::put('/pengguna/update/password', myroute::API('UserController','update_password'));
Route::put('/pengguna/update/telpon', myroute::API('UserController','update_telpon'));
Route::put('/pengguna/update/profil', myroute::API('UserController','update_profil'));
Route::delete('/pengguna/hapus', myroute::API('UserController','delete'));
Route::post('/logout', myroute::API('UserController', 'logout'));

Route::get('/umkm/list', myroute::API('UmkmkuController', 'getAll'));
Route::get('/umkm/detail', myroute::API('UmkmkuController', 'get'));
Route::post('/umkm/baru', myroute::API('UmkmkuController', 'store'));
Route::put('/umkm/update', myroute::API('UmkmkuController', 'update'));
Route::delete('/umkm/delete', myroute::API('UmkmkuController', 'delete'));

Route::get('/produk', myroute::API('ProdukkuController', 'getAll'));
Route::get('/produk/detail', myroute::API('ProdukkuController', 'get'));
Route::post('/produk/baru', myroute::API('ProdukkuController', 'store'));
Route::put('/produk/update', myroute::API('ProdukkuController', 'update'));
Route::delete('/produk/hapus', myroute::API('ProdukkuController', 'delete'));

Route::get('/transaksi', myroute::API('TransaksiController', 'getAll'));
Route::get('/transaksi/detail', myroute::API('TransaksiController', 'get'));
Route::post('/transaksi/baru', myroute::API('TransaksiController', 'store'));
Route::delete('/transaksi/hapus', myroute::API('TransaksiController', 'delete'));

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
