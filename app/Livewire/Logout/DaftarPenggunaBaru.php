<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Logout;

use Livewire\Component;
use App\Libraries\myfunction as fun;

class DaftarPenggunaBaru extends Component {

    public String|null $title;
    public function mount() {
        if( fun::getRawCookie('islogin') != null ) return redirect('dashboard');
        $this->title = 'Daftar Pengguna Baru';
    }

    public function render() {
        return view('livewire.pages.daftar-pengguna-baru', [
            'title' => $this->title
        ])
        ->layout('layouts.unauthorized', [
            'pagetitle'     => $this->title.' | UMKMKU',
            'uniquekey'     => fun::random('combwisp', 60),
            'description'   => 'UMKMKU adalah sebuah aplikasi berbasis website untuk pelaku usaha UMKM dan digunakan oleh mereka (sebagai user). Aplikasi ini bisa digunakan untuk berbagai jenis umkm dan dapat diakses di berbagai device dan platform.',
            'keywords'      => 'UMKMKU, Aplikasi UMKM, Website UMKM, Aplikasi untuk pengusaha kecil dan menengah kebawah, Website untuk pengusaha kecil dan menengah kebawah, Platform UMKM kecil dan menengah ke bawah.',
            'copyright'     => 'Copyright '.date('Y').' @ Syahri Ramadhan Wiraasmara (ARI)'
        ]);
    }
}
