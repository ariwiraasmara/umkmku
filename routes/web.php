<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
use Illuminate\Support\Facades\Route;
use App\Libraries\myroute;
use App\Libraries\myfunction as fun;
use App\Libraries\cookies;
use App\Repositories\produkkuRepository;
use App\Services\produkkuService;

Route::get('/', function () {
    return redirect('/login');
});

// lebih baik saya buat versi saya sendiri untuk login
// 😆🤣 karena lebih nyamannya begitu...

// Route::get('/login', function () {
//     return view('livewire.pages.auth.login');
// });

// Route::get('/lupa-password', \App\Livewire\LupaPassword::class);

// Route::get('/dashboard', function(){
//     return view('livewire.pages.dashboard', ['user'=> 'User 1']);
// });

Route::get('/login', \App\Livewire\Logout\LoginPage::class);
Route::get('/daftar-pengguna-baru', \App\Livewire\Logout\DaftarPenggunaBaru::class);
Route::post('/process/login', myroute::process('ProcessUserController', 'login'));
Route::post('/process/daftar-pengguna-baru', myroute::process('ProcessUserController', 'daftar_pengguna_baru'));
Route::post('/process/lupa-password', myroute::process('ProcessUserController', 'lupa_password'));
Route::get('/logout', myroute::process('ProcessUserController', 'logout'));

if( fun::getRawCookie('islogin') != null || 
    fun::getRawCookie('mcr_x_aswq_1') != null || 
    fun::getRawCookie('mcr_x_aswq_2') != null || 
    fun::getRawCookie('mcr_x_aswq_3') != null ||
    fun::getRawCookie('mcr_x_aswq_4') != null ) {

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', \App\Livewire\Login\Dashboard::class);
        Route::get('/umkmku', \App\Livewire\Login\Umkmku\Umkmku::class);
        Route::get('/profil', \App\Livewire\Login\Profil::class);
    });

    
    
    Route::get('/umkmku/baru', \App\Livewire\Login\Umkmku\NEUmkmku::class);
    Route::get('/umkmku/edit/{id}/{title}', \App\Livewire\Login\Umkmku\NEUmkmku::class);
    Route::get('/umkmku/detil/{id}', \App\Livewire\Login\Umkmku\DetailUmkmku::class);
    
    Route::get('/transaksi', \App\Livewire\Login\Transaksi\TransaksiNonDM::class);
    Route::get('/transaksi/detil/{id}', \App\Livewire\Login\Transaksi\DetailTransaksi::class);
    Route::get('/transaksi/detil/view/{tipe}/{id}/{from}/{to}', \App\Livewire\Login\Transaksi\DetilTabelTransaksi::class);
    Route::get('/transaksi/baru/{id}', \App\Livewire\Login\Transaksi\NewTransaksi::class);
    
    
    Route::get('/staff/baru/{id}', \App\Livewire\Login\Staff\NEStaff::class);
    Route::get('/staff/edit/{id}/{title}', \App\Livewire\Login\Staff\NEStaff::class);
    Route::get('/staff/detil/{id}', \App\Livewire\Login\Staff\DetailStaff::class);
    
    Route::get('/produk/detil/{id1}/{id2}', App\Livewire\Login\Produk\DetailProduk::class);
    Route::get('/produk/baru/{id}', App\Livewire\Login\Produk\NEProduk::class);
    Route::get('/produk/edit/{id}/{id2}/{title}', App\Livewire\Login\Produk\NEProduk::class);
    
    Route::post('/process/user/update', myroute::process('ProcessUserController', 'update_userprofil'));
    Route::post('/process/user/update/password/{id}', myroute::process('ProcessUserController', 'update_userpassword'));
    Route::post('/process/user/update/foto/{id}', myroute::process('ProcessUserController', 'update_userfoto'));
    
    Route::post('/process/staff/baru/{id}', myroute::process('ProcessUserController', 'store_staff'));
    Route::post('/process/staff/edit/{id}', myroute::process('ProcessUserController', 'update_staff'));
    Route::get('/process/staff/delete/{id1}/{id2}', myroute::process('ProcessUserController', 'deleteUser'));
    
    Route::post('/process/umkm/baru', myroute::process('ProcessUmkmkuController', 'store'));
    Route::post('/process/umkm/update/{id}', myroute::process('ProcessUmkmkuController', 'update'));
    Route::get('/process/umkm/delete/{id}', myroute::process('ProcessUmkmkuController', 'delete'));
    
    Route::post('/process/produk/baru/{id}', myroute::process('ProcessProdukController', 'store'));
    Route::post('/process/produk/update/{id}', myroute::process('ProcessProdukController', 'update'));
    Route::get('/process/produk/delete/{id1}/{id2}', myroute::process('ProcessProdukController', 'delete'));
    
    Route::post('/process/transaksi/baru', myroute::process('ProcessTransaksiController', 'store'));
    Route::post('/process/transaksi/delete/{id1}/{id2}', myroute::process('ProcessTransaksiController', 'delete'));
}

Route::get('/hello-livewire', \App\Livewire\HelloLivewire::class);

Route::get('/coba', function() {
    $cookies = new cookies();
    return $cookies->islogin();
});

Route::get('/coba_repo', function() {
    $repo = new produkkuRepository();
    // return $repo->getID('UMKM_coba@coba.com-003');
    // return $repo->store(['nilai'=>'coba']);
    // return $repo->hello;
    return $repo->getAll(['id_umkm' => 'UMKM_coba@coba.com-002'], 'id_umkm', 'asc');
});

Route::get('/coba_service', function() {
    $service = new produkkuService();
    $service->repo();
    // return $service->getID('UMKM_coba@coba.com-003');
    // return $service->store(['nilai'=>'coba']);
    // return $service->hello();
    return $service->getAll(['id_umkm' => 'UMKM_coba@coba.com-002'], 'id_umkm', 'desc');
    // return $service->ga(['id_umkm' => 'UMKM_coba@coba.com-002']);
});

require __DIR__.'/auth.php';
