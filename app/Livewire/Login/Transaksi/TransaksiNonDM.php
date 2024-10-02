<?php

namespace App\Livewire\Login\Transaksi;

use Livewire\Component;

class TransaksiNonDM extends Component {
    public String $title = 'Transaksi';
    public function render() {
        return view(
            'livewire.pages.transaksi.transaksi-nondm', 
            ['title' => $this->title])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
