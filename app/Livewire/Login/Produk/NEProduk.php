<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Login\Produk;

use Livewire\Component;
use App\Services\umkmkuService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Exception;

class NEProduk extends Component {

    protected String|null $title;
    protected String|null $isedit;
    protected String|null $url;

    protected umkmkuService|String|null $service;
    protected array|Collection|JsonResponse|String|int|null $data;

    protected String|null $id_produk;
    protected String|null $id_umkm;
    protected String|null $nama;
    protected String|null $merk;
    protected String|null $jenis;
    protected String|null $deskripsi;
    protected String|int|null $harga;
    protected String|int|null $stok;
    protected String|null $satuan_unit;
    protected String|int|null $diskon;

    public function mount(String $id = null, String $id2 = null, String $title = null) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        /*
        $this->title       = $title == null ? 'Produk Baru' : 'Edit Produk';
        $this->isedit      = $title == null ? 'new' : 'edit';
        $this->url         = $title == null ? '/process/produk/baru/'.$id : '/process/produk/update/'.$id;
        $this->id_umkm     = $title == null ? fun::denval($id) : $id2;
        $this->service     = $title == null ? null : new umkmkuService();
        $this->data        = $title == null ? null : $this->service->getProduk(['id_produk' => fun::denval($id)]);
        $this->id_produk   = $title == null ? null : $this->data[0]['id_produk'];
        $this->nama        = $title == null ? null : ($this->data[0]['nama']         == null ? '' : $this->data[0]['nama']);
        $this->merk        = $title == null ? null : ($this->data[0]['merk']         == null ? '' : $this->data[0]['merk']);
        $this->jenis       = $title == null ? null : ($this->data[0]['jenis']        == null ? '' : $this->data[0]['jenis']);
        $this->deskripsi   = $title == null ? null : ($this->data[0]['deskripsi']    == null ? '' : $this->data[0]['deskripsi']);
        $this->harga       = $title == null ? null:  ($this->data[0]['harga']        == null ? 0 : $this->data[0]['harga']);
        $this->stok        = $title == null ? null:  ($this->data[0]['stok']         == null ? 0 : $this->data[0]['stok']);
        $this->satuan_unit = $title == null ? null : ($this->data[0]['satuan_unit']  == null ? '' : $this->data[0]['satuan_unit']);
        $this->diskon      = $title == null ? null:  ($this->data[0]['diskon']       == null ? 0 : $this->data[0]['diskon']);
        */
        if($title == null) {
            $this->title       = 'Produk Baru';
            $this->isedit      = 'new';
            $this->url         = '/process/produk/baru/'.$id;
            $this->id_umkm     = fun::denval($id);
            $this->service     = null;
            $this->data        = null;
            $this->id_produk   = null;
            $this->nama        = null;
            $this->merk        = null;
            $this->jenis       = null;
            $this->deskripsi   = null;
            $this->harga       = null;
            $this->stok        = null;
            $this->satuan_unit = null;
            $this->diskon      = null;
        }
        else {
            $this->title       = 'Edit Produk';
            $this->isedit      = 'edit';
            $this->url         = '/process/produk/update/'.$id;
            $this->id_umkm     = $id2;
            $this->service     = new umkmkuService();
            $this->data        = $this->service->getProduk(['id_produk' => fun::denval($id)]);
            try {
                $this->id_produk   = $this->data[0]['id_produk'];
                $this->nama        = $this->data[0]['nama'];    
                $this->merk        = $this->data[0]['merk'];    
                $this->jenis       = $this->data[0]['jenis'];   
                $this->deskripsi   = $this->data[0]['deskripsi'];
                $this->harga       = $this->data[0]['harga'];
                $this->stok        = $this->data[0]['stok'];
                $this->satuan_unit = $this->data[0]['satuan_unit'];
                $this->diskon      = $this->data[0]['diskon'];
            }
            catch(Exception $e) {
                $this->id_produk   = null;
                $this->nama        = null;
                $this->merk        = null;
                $this->jenis       = null;
                $this->deskripsi   = null;
                $this->harga       = null;
                $this->stok        = null;
                $this->satuan_unit = null;
                $this->diskon      = null;
            }
        }
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
