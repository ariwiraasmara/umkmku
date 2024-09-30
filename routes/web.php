<?php
//! Coyright @ Syahri Ramadhan Wiraasmara (ARI)
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

Route::get('/logout', );

Route::get('/hello', function () {
    return 'hello';
});

require __DIR__.'/auth.php';
