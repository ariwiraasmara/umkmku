<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
use Illuminate\Support\Facades\Route;
use App\Libraries\mcr;

Route::get('/', function () {
    return redirect('/login');
});

// lebih baik saya buat versi saya sendiri untuk login
// 😆🤣 karena lebih nyamannya begitu...
Route::get('/login', function () {
    return view('livewire.pages.auth.login');
});

Route::get('/daftar-pengguna-baru', function () {
    return view('livewire.pages.auth.register');
});

Route::get('/lupa-password', function () {
    return view('livewire.pages.auth.reset-password');
});

// Route::get('/logout', );

Route::get('/dashboard', function(){
    return view('livewire.pages.dashboard', ['user'=> 'User 1']);
});

Route::get('/umkmku', function(){
    return view('livewire.pages.umkmku.list');
});

Route::get('/umkmku/detil/', function(){
    return view('livewire.pages.umkmku.detail');
});

Route::get('/produk', function(){
    return view('livewire.pages.produk.list');
});

Route::get('/produk/detil/', function(){
    return view('livewire.pages.produk.detail');
});

Route::get('/transaksi', function(){
    return view('livewire.pages.transaksi.list');
});

Route::get('/transaksi/detil/', function(){
    return view('livewire.pages.transaksi.detail');
});

Route::get('/profil', function(){
    return view('livewire.pages.profile.profile');
});

Route::get('/hello', function () {
    return 'hello';
});

require __DIR__.'/auth.php';
