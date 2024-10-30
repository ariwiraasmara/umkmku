<?php

namespace App\Livewire\Login;

use Livewire\Component;
use App\Services\userService;
use App\Services\transaksiService;
use App\Libraries\myfunction as fun;

class Dashboard extends Component {

    protected $serviceUser;
    protected $serviceTransaksi;
    protected $data_user;
    protected $data_transaksi;
    protected String $username;
    protected int $roles;

    public function mount() {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->serviceUser      = new userService();
        $this->serviceTransaksi = new transaksiService();
        $this->data_user        = $this->serviceUser->getProfil(fun::getCookie("mcr_x_aswq_1"));

        if(fun::getCookie("mcr_x_aswq_4") < 3) $this->data_transaksi = $this->serviceTransaksi->getDashboard(['aw4001_transaksi.id_user' => fun::getCookie("mcr_x_aswq_1")], 'tgl', 'desc');
        else if(fun::getCookie("mcr_x_aswq_4") > 2) $this->data_transaksi = $this->serviceTransaksi->getDashboard(['aw4001_transaksi.id_umkm' => $this->data_user[0]['id_umkm']], 'tgl', 'desc');

        $this->username         = fun::getCookie('mcr_x_aswq_2');
        $this->roles            = fun::getCookie('mcr_x_aswq_4');
    }

    protected String $title = 'Dashboard';
    public function render() {
        return view('livewire.pages.dashboard', [
            'title'         => $this->title,
            'nama'          => $this->data_user[0]['nama'],
            'username'      => $this->username,
            'roles'         => $this->roles,
            'jk'            => $this->data_user[0]['jk'],
            'id_umkm'       => $this->data_user[0]['id_umkm'],
            'data_transaksi'=> $this->data_transaksi
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
