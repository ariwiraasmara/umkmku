<?php

namespace App\Livewire\Login;

use Livewire\Component;
use App\Services\transaksiService;
use App\Libraries\myfunction as fun;

class Dashboard extends Component {

    protected $service;
    protected $data;
    public String $username;

    public function mount() {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->service = transaksiService::class;
        // $this->data = $this->service->getAll();
        $this->data = [
            ['id_umkm' => 1, 'nama_umkmku' => 'Baksoku', 'waktu' => '2024-10-01 12:00:00', 'kasir' => 'Ari'],
            ['id_umkm' => 2, 'nama_umkmku' => 'Baksoku', 'waktu' => '2024-10-01 12:05:00', 'kasir' => 'Ari'],
            ['id_umkm' => 3, 'nama_umkmku' => 'Baksoku', 'waktu' => '2024-10-01 12:07:00', 'kasir' => 'Ari'],
            ['id_umkm' => 4, 'nama_umkmku' => 'Siomayku', 'waktu' => '2024-10-01 12:07:00', 'kasir' => 'Fulan'],
            ['id_umkm' => 4, 'nama_umkmku' => 'Siomayku', 'waktu' => '2024-10-01 12:08:00', 'kasir' => 'Fulan'],
        ];
        $this->username = fun::getCookie("mcr_x_aswq_2");
    }

    protected String $title = 'Dashboard';
    public function render() {
        return view(
            'livewire.pages.dashboard', 
            [
                    'title'     => $this->title,
                    'username'  => $this->username,
                    'data'      => $this->data
                ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
