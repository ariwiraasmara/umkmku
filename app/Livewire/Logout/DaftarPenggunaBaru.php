<?php

namespace App\Livewire\Logout;

use Livewire\Component;

class DaftarPenggunaBaru extends Component {

    public String $title = 'Daftar Pengguna Baru';
    public function render() {
        return view(
            'livewire.pages.daftar-pengguna-baru', 
            ['title' => $this->title])
        ->layout(
            'layouts.unauthorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
