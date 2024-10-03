<?php

namespace App\Livewire\Login\Umkmku;

use Livewire\Component;
use App\Libraries\myfunction as fun;

class NEUmkmku extends Component {

    protected String $title;
    protected String $isedit;
    protected String $url;
    protected String $method_request;
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

    public function mount(String $title = null, array $data = null) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->title            = $title == null ? 'UMKM Baru' : 'Edit UMKM';
        $this->isedit           = $data == null ? 'new' : $data['isedit'];
        $this->url              = $data == null ? '/process/umkm/baru' : 'process/umkm/edit/'.$data['id_umkm'];
        $this->method_request   = $data == null ? 'POST' : $data['method_request'];
        $this->id_umkm          = $data == null ? '' : $data['id_umkm'];
        $this->nama_umkm        = $data == null ? '' : $data['nama_umkm'];
        $this->tgl_berdiri      = $data == null ? '' : $data['tgl_berdiri'];
        $this->jenis_usaha      = $data == null ? '' : $data['jenis_usaha'];
        $this->deskripsi        = $data == null ? '' : $data['deskripsi'];
        $this->no_tlp           = $data == null ? '' : $data['no_tlp'];
        $this->logo_umkm        = $data == null ? '' : $data['logo_umkm'];
        $this->foto_umkm        = $data == null ? '' : $data['foto_umkm'];
        $this->alamat           = $data == null ? '' : $data['alamat'];
        $this->longitude        = $data == null ? '' : $data['longitude'];
        $this->latitude         = $data == null ? '' : $data['latitude'];
    }

    public function render() {
        return view('livewire.pages.umkmku.new_edit', [
            'title'          => $this->title,
            'isedit'         => $this->isedit,
            'url'            => $this->url,
            'method_request' => $this->method_request,
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
