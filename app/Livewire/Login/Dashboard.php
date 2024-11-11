<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Login;

use Livewire\Component;
use App\Services\userService;
use App\Services\umkmkuService;
use App\Services\transaksiService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Exception;

class Dashboard extends Component {

    protected String|null $title;
    protected userService|String|null $serviceUser;
    protected umkmkuService|String|null $serviceUMKM;
    protected transaksiService|null $serviceTransaksi;
    protected array|Collection|JsonResponse|String|int|null $data_user;
    protected array|Collection|JsonResponse|String|int|null $data_umkm;
    protected array|Collection|JsonResponse|String|int|null $data_transaksi;
    protected String|null $username;
    protected int|null $roles;

    protected String|null $nama;
    protected String|null $jk;
    protected String|null $id_umkm;

    public function mount() {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->title            = 'Dashboard';
        $this->serviceUser      = new userService();
        $this->serviceUMKM      = new umkmkuService();
        $this->serviceTransaksi = new transaksiService();
        
        
        if(fun::getCookie("mcr_x_aswq_4") < 3) {
            $this->data_transaksi = Cache::get('page_dashboard_datatransaksi-'.fun::getCookie('mcr_x_aswq_1'));
            $this->data_umkm = Cache::get('page_dashboard_dataumkm-'.fun::getCookie('mcr_x_aswq_1')); 
        }
        else if(fun::getCookie("mcr_x_aswq_4") > 2) {
            $this->data_transaksi = Cache::get('page_dashboard_datatransaksi-'.fun::getCookie('mcr_x_aswq_1')); 
            $this->data_umkm = null;
        }
        
        if(Cache::has('page_dashboard_datauser-'.fun::getCookie('mcr_x_aswq_1'))) $this->data_user = Cache::get('page_dashboard_datauser-'.fun::getCookie('mcr_x_aswq_1'));
        else {
            Cache::put('page_dashboard_datauser-'.fun::getCookie('mcr_x_aswq_1'), $this->serviceUser->getProfil(fun::getCookie("mcr_x_aswq_1")), 1*24*60*60);
            $this->data_user = Cache::get('page_dashboard_datauser-'.fun::getCookie('mcr_x_aswq_1'));
        }

        if(Cache::has('page_dashboard_datatransaksi-'.fun::getCookie('mcr_x_aswq_1'))) $this->data_transaksi = Cache::get('page_dashboard_datatransaksi-'.fun::getCookie('mcr_x_aswq_1'));
        else {
            Cache::put('page_dashboard_datatransaksi-'.fun::getCookie('mcr_x_aswq_1'), $this->serviceTransaksi->getDashboard(['aw4001_transaksi.id_user' => fun::getCookie("mcr_x_aswq_1")], 'tgl', 'desc'), 1*24*60*60);
            $this->data_transaksi = Cache::get('page_dashboard_datatransaksi-'.fun::getCookie('mcr_x_aswq_1'));
        }

        if(Cache::has('page_dashboard_dataumkm-'.fun::getCookie('mcr_x_aswq_1'))) $this->data_umkm = Cache::get('page_dashboard_dataumkm-'.fun::getCookie('mcr_x_aswq_1'));
        else {
            Cache::put('page_dashboard_dataumkm-'.fun::getCookie('mcr_x_aswq_1'), $this->serviceUMKM->getAll(['id' => fun::getCookie('mcr_x_aswq_1')], 'nama_umkm', 'asc'), 1*24*60*60);
            $this->data_umkm = Cache::get('page_dashboard_dataumkm-'.fun::getCookie('mcr_x_aswq_1'));
        }

        if(Cache::has('page_dashboard_datatransaksi-'.fun::getCookie('mcr_x_aswq_1')));
        else {
            Cache::put('page_dashboard_datatransaksi-'.fun::getCookie('mcr_x_aswq_1'), $this->serviceTransaksi->getDashboard(['aw4001_transaksi.id_umkm' => $this->data_user[0]['id_umkm']], 'tgl', 'desc'), 1*24*60*60);
            $this->data_transaksi = Cache::get('page_dashboard_datatransaksi-'.fun::getCookie('mcr_x_aswq_1'));
        }

        $this->username = fun::getCookie('mcr_x_aswq_2');
        $this->roles    = fun::getCookie('mcr_x_aswq_4');

        try {
            $this->nama     = $this->data_user[0]['nama'];
            $this->jk       = $this->data_user[0]['jk'];
            $this->id_umkm  = $this->data_user[0]['id_umkm'];
        }
        catch(Exception $e) {
            $this->nama     = null;
            $this->jk       = null;
            $this->id_umkm  = null;
        }
    }

    public function render() {
        return view('livewire.pages.dashboard', [
            'title'         => $this->title,
            'nama'          => $this->nama,
            'username'      => $this->username,
            'roles'         => $this->roles,
            'jk'            => $this->jk,
            'id_umkm'       => $this->id_umkm,
            'data_transaksi'=> $this->data_transaksi,
            'data_umkm'     => $this->data_umkm,
        ])
        ->layout('layouts.authorized', [
            'pagetitle'     => $this->title.' | UMKMKU',
            'uniquekey'     => fun::random('combwisp', 60),
            'description'   => 'UMKMKU adalah sebuah aplikasi berbasis website untuk pelaku usaha UMKM dan digunakan oleh mereka (sebagai user). Aplikasi ini bisa digunakan untuk berbagai jenis umkm dan dapat diakses di berbagai device dan platform.',
            'keywords'      => 'UMKMKU, Aplikasi UMKM, Website UMKM, Aplikasi untuk pengusaha kecil dan menengah kebawah, Website untuk pengusaha kecil dan menengah kebawah, Platform UMKM kecil dan menengah ke bawah.',
            'copyright'     => 'Copyright '.date('Y').' @ Syahri Ramadhan Wiraasmara (ARI)'
        ]);
    }
}
