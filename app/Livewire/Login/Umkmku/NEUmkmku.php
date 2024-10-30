<?php

namespace App\Livewire\Login\Umkmku;

use Livewire\Component;
use App\Libraries\myfunction as fun;
use App\Services\umkmkuService;

class NEUmkmku extends Component {

    protected String $title;
    protected String $isedit;
    protected String $url;
    protected $service;
    protected $data;

    protected String $id_umkm;
    protected String $nama_umkm;
    protected String $tgl_berdiri;
    protected String $jenis_usaha;
    protected String $deskripsi;
    protected String $no_tlp;
    protected String $logo_umkm;
    protected String $foto_umkm;
    protected String $alamat;
    protected String $longitude;
    protected String $latitude;

    public function mount(String $id = null, String $title = null, array $data = null) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->title            = $title == null ? 'UMKM Baru' : 'Edit UMKM';
        $this->isedit           = $title == null ? 'new' : 'isedit';
        $this->url              = $title == null ? '/process/umkm/baru' : '/process/umkm/update/'.$id;

        $this->service          = $title == null ? '' : new umkmkuService();
        $this->data             = $title == null ? '' : $this->service->get(['id_umkm' => $id]);

        $this->id_umkm          = $title == null ? '' : $this->data[0]['id_umkm'];
        $this->nama_umkm        = $title == null ? '' : $this->data[0]['nama_umkm'];
        $this->tgl_berdiri      = $title == null ? '' : $this->data[0]['tgl_berdiri'];
        $this->jenis_usaha      = $title == null ? '' : $this->data[0]['jenis_usaha'];
        $this->deskripsi        = $title == null ? '' : $this->data[0]['deskripsi'];
        $this->no_tlp           = $title == null ? '' : $this->data[0]['no_tlp'];
        $this->logo_umkm        = $title == null ? '' : ($this->data[0]['logo_umkm'] == null ? '' : $this->data[0]['logo_umkm']);
        $this->foto_umkm        = $title == null ? '' : ($this->data[0]['foto_umkm'] == null ? '' : $this->data[0]['foto_umkm']);
        $this->alamat           = $title == null ? '' : $this->data[0]['alamat'];
        $this->longitude        = $title == null ? '' : ($this->data[0]['longitude'] == null ? '' : $this->data[0]['longitude']);
        $this->latitude         = $title == null ? '' : ($this->data[0]['latitude'] == null ? '' : $this->data[0]['latitude']);
    }

    public function render() {
        return view('livewire.pages.umkmku.new_edit', [
            'title'          => $this->title,
            'isedit'         => $this->isedit,
            'url'            => $this->url,
            'id_umkm'        => $this->id_umkm,
            'id_user'        => fun::getCookie('mcr_x_aswq_1'),
            'nama_umkm'      => $this->nama_umkm,
            'tgl_berdiri'    => $this->tgl_berdiri,
            'jenis_usaha'    => $this->jenis_usaha,
            'deskripsi'      => $this->deskripsi,
            'no_tlp'         => $this->no_tlp,
            'logo_umkm'      => $this->logo_umkm,
            'foto_umkm'      => $this->foto_umkm,
            'alamat'         => $this->alamat,
            'longitude'      => $this->longitude,
            'latitude'       => $this->latitude,
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
