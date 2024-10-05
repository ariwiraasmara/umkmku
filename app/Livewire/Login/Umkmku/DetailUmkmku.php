<?php

namespace App\Livewire\Login\Umkmku;

use Livewire\Component;
use App\Models\aw3001_produkku;
use App\Repositories\produkkuRepository;
use App\Services\userService;
use App\Services\umkmkuService;
use App\Services\produkkuService;
use App\Services\transaksiService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Facades\Http;

class DetailUmkmku extends Component {

    protected String $id;
    protected String $title = 'Detil UMKM ';
    protected object $umkmService;
    protected object $userService;
    protected object $produkkuService;
    protected object $transaksiService;
    public $data_umkm;
    public $data_user;
    public $data_produk;
    protected $data_transaksi;

    public $data;

    public function mount(String $id) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        if($id < 1 || $id == null) return redirect('umkmku');
        $this->umkmService = new umkmkuService();
        $this->userService = new userService();
        $this->produkkuService = new produkkuService();
        $this->transaksiService = new transaksiService();
        $this->data_umkm = $this->umkmService->get(['id_umkm' => $id], 'id_umkm', 'asc');        
        $this->data_user = $this->userService->getAllStaff($id);
        // $this->data_produk = $this->produkkuService->getAll(['id_umkm' => $id], 'nama', 'asc');
        // $this->data_transaksi = json_decode($this->transaksiService->getAll($id, 'tgl', 'desc'), true);
        $this->data_transaksi = $this->transaksiService->getAll($id, 'nama', 'desc');
        // $res = $this->transaksiService->getAll($id, 'tgl', 'desc');
        // $data = json_decode($res, true);
        // if (isset($data['pesan'], $data['success'], $data['data'])) $this->data_transaksi = $data['data'];
        // else $this->data_transaksi = 0;
    }

    public function render() {
        return view('livewire.pages.umkmku.detail', [
            'title'          => $this->title.$this->data_umkm->getData()->data[0]->nama_umkm, 
            'id_user'        => fun::getCookie('mcr_x_aswq_1'),
            'id_umkm'        => $this->data_umkm->getData()->data[0]->id_umkm,
            'nama_umkm'      => $this->data_umkm->getData()->data[0]->nama_umkm,
            'tgl_berdiri'    => $this->data_umkm->getData()->data[0]->tgl_berdiri,
            'jenis_usaha'    => $this->data_umkm->getData()->data[0]->jenis_usaha,
            'deskripsi'      => $this->data_umkm->getData()->data[0]->deskripsi,
            'alamat'         => $this->data_umkm->getData()->data[0]->alamat,
            'longitude'      => $this->data_umkm->getData()->data[0]->longitude,
            'latitude'       => $this->data_umkm->getData()->data[0]->latitude,
            'no_tlp'         => $this->data_umkm->getData()->data[0]->no_tlp,
            'foto_umkm'      => $this->data_umkm->getData()->data[0]->foto_umkm,
            'logo_umkm'      => $this->data_umkm->getData()->data[0]->logo_umkm,
            'data_produk'    => $this->data_produk,
            'data_transaksi' => $this->data_transaksi,
            'data_user'      => $this->data_user,
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.$this->data_umkm->getData()->data[0]->nama_umkm.' | UMKMKU'
        ]);
    }
}
