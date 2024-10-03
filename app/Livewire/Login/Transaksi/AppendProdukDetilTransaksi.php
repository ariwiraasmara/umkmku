<?php

namespace App\Livewire\Login\Transaksi;

use Livewire\Component;
use App\Services\produkkuService;
use App\Libraries\myfunction as fun;

class AppendProdukDetilTransaksi extends Component {

    protected $produkkuService;
    protected $data_produk;

    public function mount() {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->produkkuService  = new produkkuService();
        // $this->data_produk = $this->produkkuService->getAll(['id_umkm' => $id], 'nama', 'asc');
    }

    public function render() {
        return view('livewire.pages.transaksi.append-produk-detil-transaksi', [
            'data' => $this->data
        ]);
    }
}
