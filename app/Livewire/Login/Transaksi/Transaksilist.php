<?php

namespace App\Livewire\Login\Transaksi;

use Livewire\Component;

class Transaksilist extends Component {

    protected string $id_umkm;
    protected string $nama_umkmku;
    protected string $waktu;
    protected string $kasir;

    public function mount(
        string $id_umkm, 
        string $nama_umkmku,
        string $waktu,
        string $kasir
    ) {
        $this->id_umkm = $id_umkm;
        $this->nama_umkmku = $nama_umkmku;
        $this->waktu = $waktu;
        $this->kasir = $kasir;
    }

    public function delete() {
        
    }

    public function render() {
        return view('livewire.pages.transaksi.list',[
            'id_umkm' => $this->id_umkm,
            'nama_umkmku' => $this->nama_umkmku,
            'waktu' => $this->waktu,
            'kasir' => $this->kasir
        ]);
    }
}
