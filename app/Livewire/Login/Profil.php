<?php

namespace App\Livewire\Login;

use Livewire\Component;
use App\Services\userService;
use App\Libraries\myfunction as fun;

class Profil extends Component {

    protected String $title = 'Profil';
    protected $service;
    protected $data;

    public function mount() {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->service = new userService();
        $this->data = $this->service->getProfil(fun::getCookie('mcr_x_aswq_1'));
    }

    public function render() {
        return view('livewire.pages.profile.profil', [
            'title' => $this->title,
            'data' => $this->data
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
