<?php

namespace App\Livewire\Login\Umkmku;

use Livewire\Component;
use App\Services\umkmkuService;
use App\Libraries\myfunction as fun;

class Umkmku extends Component {
    
    protected String $title = 'UMKMKU';
    protected object $service;
    protected $data;

    public function mount() {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->service = new umkmkuService();
        $this->data = $this->service->getAll(['id' => fun::getCookie('mcr_x_aswq_1')], 'id_umkm', 'asc');
    }

    public function render() {
        return view(
            'livewire.pages.umkmku.list', 
            ['title' => $this->title, 'data' => $this->data])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
