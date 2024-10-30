<?php

namespace App\Livewire\Login\Transaksi;

use Livewire\Component;
use App\Libraries\myfunction as fun;
use App\Services\userService;
use App\Services\transaksiService;

class TransaksiNonDM extends Component {

    protected String $title = 'Transaksi';
    protected $serviceUser;
    protected $serviceTransaksi;
    protected $data_user;
    protected $data_transaksi;


    public function mount() {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->serviceUser      = new userService();
        $this->serviceTransaksi = new transaksiService();
        $this->data_user        = $this->serviceUser->getProfil(fun::getCookie("mcr_x_aswq_1"));
        $this->data_transaksi   = $this->serviceTransaksi->getAll($this->data_user[0]['id_umkm'], 'tgl', 'desc');
    }

    public function render() {
        return view('livewire.pages.transaksi.transaksi-nondm', [
            'title'          => $this->title,
            'data_transaksi' => $this->data_transaksi
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
