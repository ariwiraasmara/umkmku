<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Logout;

use Livewire\Component;
use App\Libraries\myfunction as fun;

class LoginPage extends Component {

    public String $title = 'Login';

    public function mount() {
        if( fun::getRawCookie('islogin') != null ) return redirect('dashboard');
    }

    public function render() {
        return view('livewire.pages.login-page', [
            'title' => $this->title
        ])
        ->layout('layouts.unauthorized', [
            'pagetitle'     => $this->title.' | UMKMKU',
            'description'   => 'UMKMKU adalah sebuah aplikasi berbasis website untuk pelaku usaha UMKM dan digunakan oleh mereka (sebagai user). Aplikasi ini bisa digunakan untuk berbagai jenis umkm dan dapat diakses di berbagai device dan platform.',
            'keywords'      => 'UMKMKU, Aplikasi UMKM, Website UMKM, Aplikasi untuk pengusaha kecil dan menengah kebawah, Website untuk pengusaha kecil dan menengah kebawah, Platform UMKM kecil dan menengah ke bawah.',
            'copyright'     => 'Copyright '.date('Y').' @ Syahri Ramadhan Wiraasmara (ARI)'
        ]);
    }
}