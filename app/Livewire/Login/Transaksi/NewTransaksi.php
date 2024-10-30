<?php

namespace App\Livewire\Login\Transaksi;

use Livewire\Component;
use App\Services\userService;
use App\Libraries\myfunction as fun;

class NewTransaksi extends Component {

    
    protected String $title;
    protected String $linkback;
    protected $userService;
    protected int $id_user;
    protected String $id_umkm;
    protected $nama_user;

    public function mount(String $id) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->userService = new userService();
        $this->title       = 'Transaksi Baru';

        $this->id_user = fun::getCookie('mcr_x_aswq_1');
        $this->id_umkm = $id;
        $this->nama_user = $this->userService->getProfil($this->id_user);

        if(fun::getCookie('mcr_x_aswq_4') < 3) $this->linkback = '/umkmku/detil/'.$this->id_umkm;
        else if(fun::getCookie('mcr_x_aswq_4') > 2) $this->linkback = '/transaksi';
    }

    public function render() {
        return view('livewire.pages.transaksi.new', [
            'title'     => $this->title,
            'id_umkm'   => $this->id_umkm,
            'nama_user' => $this->nama_user[0]->nama,
            'linkback'  => $this->linkback
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
