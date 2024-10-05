<?php

namespace App\Livewire\Login\Transaksi;

use Livewire\Component;
use App\Services\userService;
use App\Libraries\myfunction as fun;

class NewTransaksi extends Component {

    protected $userService;
    protected String $title;
    protected int $id_user;
    protected String $id_umkm;
    protected $nama_user;

    public function mount(String $id) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->userService = new userService();
        $this->title       = 'Transaksi Baru';

        $this->id_user = fun::getCookie('mcr_x_aswq_1');
        $this->id_umkm = $id;
        $this->nama_user = $this->userService->getProfil($this->id_user)->getData()->data[0]->nama;
    }

    public function render() {
        return view('livewire.pages.transaksi.new', [
            'title'     => $this->title,
            'id_umkm'   => $this->id_umkm,
            'nama_user' => $this->nama_user
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
