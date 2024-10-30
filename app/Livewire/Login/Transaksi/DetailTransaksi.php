<?php

namespace App\Livewire\Login\Transaksi;

use Livewire\Component;
use App\Services\transaksiService;
use App\Libraries\myfunction as fun;

class DetailTransaksi extends Component {

    protected String $title = 'Detail Transaksi';
    protected $service;
    protected $data;

    public function mount(String $id) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        if($id < 1 || $id == null) return redirect('umkmku');
        $this->service = new transaksiService();
        $this->data = $this->service->get($id);
    }

    public function render() {
        return view('livewire.pages.transaksi.detail', [
            'title' => $this->title,
            'data' => $this->data,
            'incx' => 1,
            'sub' => 0,
            'subtotal' => 0,
            'uang_kembalian' => 0
            // 'detail_transaksi' => $this->service['detail_transaksi'],
            // 'total_pembelian' => $this->service['total_pembelian'],
        ])
        ->layout(
            'layouts.unauthorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
