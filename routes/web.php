<?php

use Illuminate\Support\Facades\Route;
use App\Libraries\mcr;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return 'login';
});

Route::get('/hello', function () {
    return 'hello';
});

require __DIR__.'/auth.php';
