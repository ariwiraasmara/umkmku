<?php

namespace App\Livewire\Login\Produk;

use Livewire\Component;
use App\Services\umkmkuService;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use App\Libraries\myfunction as fun;

class DetailProduk extends Component {

    protected String|null $title;
    protected umkmkuService|null $service;
    protected array|Collection|JsonResponse|null $data;
    protected String|null $id_umkm;

    public function mount(String $id1, String $id2) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        if( fun::getRawCookie('mcr_x_aswq_4') < 3 ) return redirect('dashboard');
        $this->id_umkm = fun::denval($id2);

        if(Cache::has('pagedetailproduk_data')) $this->data = Cache::get('pagedetailproduk_data');
        else {
            $this->service = new umkmkuService();
            Cache::put('pagedetailproduk_data', $this->service->getProduk(['id_produk' => fun::denval($id1)]), 1*24*60*60);
            $this->data = Cache::get('pagedetailproduk_data');
        }

        $this->title = 'Detil Produk : '.$this->data[0]['nama'];
    }

    public function render() {
        return view('livewire.pages.produk.detail', [
            'title'     => $this->title, 
            'id_umkm'   => $this->id_umkm,
            'data'      => $this->data
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
