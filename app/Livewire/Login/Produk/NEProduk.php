<?php

namespace App\Livewire\Login\Produk;

use Livewire\Component;
use App\Services\umkmkuService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;

class NEProduk extends Component {

    protected String|null $title;
    protected String|null $isedit;
    protected String|null $url;

    protected umkmkuService|String|null $service;
    protected array|Collection|JsonResponse|String|null $data;

    protected String|null $id_produk;
    protected String|null $id_umkm;
    protected String|null $nama;
    protected String|null $merk;
    protected String|null $jenis;
    protected String|null $deskripsi;
    protected int|null $harga;
    protected int|null $stok;
    protected String|null $satuan_unit;
    protected int|null $diskon;

    public function mount(String $id = null, String $id2 = null, String $title = null) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->title            = $title == null ? 'Produk Baru' : 'Edit Produk';
        $this->isedit           = $title == null ? 'new' : 'edit';
        $this->url              = $title == null ? '/process/produk/baru/'.$id : '/process/produk/update/'.$id;
        $this->id_umkm          = $title == null ? $id : $id2;

        $this->service          = $title == null ? '' : new umkmkuService();
        $this->data             = $title == null ? '' : $this->service->getProduk(['id_produk' => fun::denval($id)]);

        $this->id_produk        = $title == null ? '' : $this->data[0]['id_produk'];
        $this->nama             = $title == null ? '' : ($this->data[0]['nama']         == null ? '' : $this->data[0]['nama']);
        $this->merk             = $title == null ? '' : ($this->data[0]['merk']         == null ? '' : $this->data[0]['merk']);
        $this->jenis            = $title == null ? '' : ($this->data[0]['jenis']        == null ? '' : $this->data[0]['jenis']);
        $this->deskripsi        = $title == null ? '' : ($this->data[0]['deskripsi']    == null ? '' : $this->data[0]['deskripsi']);
        $this->harga            = $title == null ? 0 :  ($this->data[0]['harga']        == null ? 0 : $this->data[0]['harga']);
        $this->stok             = $title == null ? 0 :  ($this->data[0]['stok']         == null ? 0 : $this->data[0]['stok']);
        $this->satuan_unit      = $title == null ? '' : ($this->data[0]['satuan_unit']  == null ? '' : $this->data[0]['satuan_unit']);
        $this->diskon           = $title == null ? 0 :  ($this->data[0]['diskon']       == null ? 0 : $this->data[0]['diskon']);
    }

    public function render() {
        return view('livewire.pages.produk.new_edit', [
            'title'          => $this->title,
            'isedit'         => $this->isedit,
            'url'            => $this->url,
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
