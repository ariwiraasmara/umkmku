<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Login\Transaksi;

use Livewire\Component;
use App\Libraries\myfunction as fun;
use App\Services\userService;
use App\Services\umkmkuService;
use App\Services\transaksiService;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class TransaksiNonDM extends Component {

    protected String|null $title;
    protected userService|String|null $userService;
    protected umkmkuService|String|null $umkmService;
    protected transaksiService|String|null $transaksiService;
    protected array|Collection|JsonResponse|String|int|null $data_user;
    protected array|Collection|JsonResponse|String|int|null $data_umkm;
    protected array|Collection|JsonResponse|String|int|null $data_transaksi;

    public function mount() {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');

        if(Cache::has('pagetransaksi_datauser')) $this->data_user = Cache::get('pagetransaksi_datauser');
        else {
            $this->userService = new userService();
            Cache::put('pagetransaksi_datauser', $this->userService->getProfil(fun::getCookie("mcr_x_aswq_1")), 1*24*60*60);
            $this->data_user = Cache::get('pagetransaksi_datauser');
        }

        if(Cache::has('pagetransaksi_dataumkm')) $this->data_umkm = Cache::get('pagetransaksi_dataumkm');
        else {
            $this->umkmService = new umkmkuService();
            Cache::put('pagetransaksi_dataumkm', $this->umkmService->get(['id_umkm' => $this->data_user[0]['id_umkm']]), 1*24*60*60);
            $this->data_umkm = Cache::get('pagetransaksi_dataumkm');
        }

        if(Cache::has('pagetransaksi_datatransaksi')) $this->data_transaksi = Cache::get('pagetransaksi_datatransaksi');
        else {
            $this->transaksiService = new transaksiService();
            Cache::put('pagetransaksi_datatransaksi', $this->transaksiService->getAll($this->data_user[0]['id_umkm'], 'tgl', 'desc'), 1*24*60*60);
            $this->data_transaksi = Cache::get('pagetransaksi_datatransaksi');
        }

        $this->title            = 'Transaksi '.$this->data_umkm[0]['nama_umkm'];
    }

    public function render() {
        return view('livewire.pages.transaksi.transaksi-nondm', [
            'title'          => $this->title,
            'data_transaksi' => $this->data_transaksi,
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
