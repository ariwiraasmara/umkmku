<?php

namespace App\Livewire\Login\Transaksi;

use Livewire\Component;
use App\Services\userService;
use App\Services\umkmkuService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;

class NewTransaksi extends Component {

    protected String|null $title;
    protected String|null $linkback;
    
    protected userService|String|null $userService;
    protected umkmkuService|String|null $umkmService;
    protected array|Collection|JsonResponse|String|null $data_umkm;
    protected array|Collection|JsonResponse|String|null $data_produk;

    protected int|null $id_user;
    protected String|null $id_umkm;
    protected String|null $nama_user;

    public function mount(String $id) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->id_user = fun::getCookie('mcr_x_aswq_1');
        $this->id_umkm = fun::denval($id);

        $this->userService = new userService();
        $this->umkmService = new umkmkuService();
        $this->title       = 'Transaksi Baru';

        $this->nama_user   = $this->userService->getProfil($this->id_user);
        $this->data_umkm   = $this->umkmService->get(['id_umkm' => $this->id_umkm]);
        $this->data_produk = $this->umkmService->getProduk(['id_umkm' => $this->id_umkm]);

        if(fun::getCookie('mcr_x_aswq_4') < 3) $this->linkback = '/umkmku/detil/'.$this->id_umkm;
        else if(fun::getCookie('mcr_x_aswq_4') > 2) $this->linkback = '/transaksi';
    }

    public function render() {
        return view('livewire.pages.transaksi.new', [
            'title'         => $this->title,
            'id_umkm'       => $this->id_umkm,
            'nama_user'     => $this->nama_user[0]['nama'],
            'linkback'      => $this->linkback,
            'nama_umkm'     => $this->data_umkm[0]['nama_umkm'],
            'data_produk'   => $this->data_produk
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
