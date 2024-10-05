<?php

namespace App\Livewire\Login\Transaksi;

use Livewire\Component;
use Livewire\Attributes\Reactive;

class ListInUMKM extends Component {

    #[Reactive] 
    public String $id_transaksi;

    #[Reactive] 
    public String $waktu;

    public function render() {
        return view('livewire.pages.transaksi.list_in_umkm', [
            'id_transaksi'  => $this->id_transaksi,
            'waktu'         => $this->waktu
        ]);
    }
}
