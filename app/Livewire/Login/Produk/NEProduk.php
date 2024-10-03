<?php

namespace App\Livewire\Login\Produk;

use Livewire\Component;
use App\Libraries\myfunction as fun;

class NEProduk extends Component {

    protected String $title;
    protected String $isedit;
    protected String $url;
    protected String $method_request;
    protected String $id_produk;
    protected String $id_umkm;
    protected String $nama;
    protected String $merk;
    protected String $jenis;
    protected String $deskripsi;
    protected int $harga;
    protected int $stok;
    protected String $satuan_unit;
    protected int $diskon;

    public function mount(String $id = null, String $title = null, array $data = null) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->title            = $title == null ? 'Produk Baru' : 'Edit Produk';
        $this->isedit           = $data == null ? 'new' : $data['isedit'];
        $this->url              = $data == null ? '/process/produk/baru' : 'process/produk/edit/'.$data['id_produk'];
        $this->method_request   = $data == null ? 'POST' : $data['method_request'];
        $this->id_umkm          = $id;
        $this->id_produk        = $data == null ? '' : $data['id_produk'];
        $this->nama             = $data == null ? '' : $data['nama'];
        $this->merk             = $data == null ? '' : $data['merk'];
        $this->jenis            = $data == null ? '' : $data['jenis'];
        $this->deskripsi        = $data == null ? '' : $data['deskripsi'];
        $this->harga            = $data == null ? 0 : $data['harga'];
        $this->stok             = $data == null ? 0 : $data['stok'];
        $this->satuan_unit      = $data == null ? '' : $data['satuan_unit'];
        $this->diskon           = $data == null ? 0 : $data['diskon'];
    }

    public function render() {
        return view('livewire.pages.produk.new_edit', [
            'title'          => $this->title,
            'isedit'         => $this->isedit,
            'url'            => $this->url,
            'method_request' => $this->method_request,
            'id_produk'      => $this->id_produk,
            'id_umkm'        => $this->id_umkm,
            'nama'           => $this->nama,
            'merk'           => $this->merk,
            'jenis'          => $this->jenis,
            'deskripsi'      => $this->deskripsi,
            'harga'          => $this->harga,
            'stok'           => $this->stok,
            'satuan_unit'    => $this->satuan_unit,
            'diskon'         => $this->diskon
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
