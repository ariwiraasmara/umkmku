<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Login\Produk;

use Livewire\Component;
use App\Services\umkmkuService;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use App\Libraries\myfunction as fun;

class DetailProduk extends Component {

    protected String|null $title;
    protected umkmkuService|String|null $service;
    protected array|Collection|JsonResponse|String|int|null $data;
    protected String|null $id_umkm;

    public function mount(String $id1, String $id2) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        if( fun::getRawCookie('mcr_x_aswq_4') < 3 ) return redirect('dashboard');
        $this->id_umkm = fun::denval($id2);

        if(Cache::has('pagedetailproduk_data-'.$this->id1)) $this->data = Cache::get('pagedetailproduk_data-'.$this->id1);
        else {
            $this->service = new umkmkuService();
            Cache::put('pagedetailproduk_data-'.$this->id1, $this->service->getProduk(['id_produk' => fun::denval($id1)]), 1*24*60*60);
            $this->data = Cache::get('pagedetailproduk_data-'.$this->id1);
        }

        $this->title = 'Detil Produk';
    }

    public function render() {
        return view('livewire.pages.produk.detail', [
            'title'     => $this->title, 
            'id_umkm'   => $this->id_umkm,
            'data'      => $this->data
        ])
        ->layout('layouts.authorized', [
            'pagetitle'     => $this->title.' | UMKMKU',
            'description'   => 'UMKMKU adalah sebuah aplikasi berbasis website untuk pelaku usaha UMKM dan digunakan oleh mereka (sebagai user). Aplikasi ini bisa digunakan untuk berbagai jenis umkm dan dapat diakses di berbagai device dan platform.',
            'keywords'      => 'UMKMKU, Aplikasi UMKM, Website UMKM, Aplikasi untuk pengusaha kecil dan menengah kebawah, Website untuk pengusaha kecil dan menengah kebawah, Platform UMKM kecil dan menengah ke bawah.',
            'copyright'     => 'Copyright '.date('Y').' @ Syahri Ramadhan Wiraasmara (ARI)'
        ]);
    }
}
