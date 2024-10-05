<?php

namespace App\Livewire\Logout;

use Livewire\Component;
use App\Libraries\myfunction as fun;

class DaftarPenggunaBaru extends Component {

    public String $title = 'Daftar Pengguna Baru';
    public function mount() {
        if( fun::getRawCookie('islogin') != null ) return redirect('dashboard');
    }

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
