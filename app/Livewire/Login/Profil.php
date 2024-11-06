<?php

namespace App\Livewire\Login;

use Livewire\Component;
use App\Services\userService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class Profil extends Component {

    protected String|null $title;
    protected userService|null $service;
    protected array|Collection|JsonResponse|null $data;
    protected String|null $path_foto;

    public function mount() {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->service  = new userService();
        $this->title    = 'Profil';

        $this->data = Cache::get('pageprofil_dataprofil');
        $this->path_foto = Storage::get('/app/private/users/'.fun::getCookie('mcr_x_aswq_2').'/photos/foto_profil.png'); //Cache::get('pageprofil_pathfoto');

        if(!Cache::has('pageprofil_dataprofil')) {
            Cache::put('data_profil', $this->service->getProfil(fun::getCookie('mcr_x_aswq_1')), 1*24*60*60);
            $this->data = Cache::get('data_profil');
        }

        // if(!Cache::has('pageprofil_pathfoto')) {
        //     if(!is_null($this->data[0]['foto']) || $this->data[0]['foto'] != '') {
        //         Cache::put('path_foto', $this->service->readFile(fun::getCookie('mcr_x_aswq_2'), $this->data[0]['foto']), 1*24*60*60);
        //         $this->path_foto = Cache::get('path_foto');
        //     }
        // }
    }

    public function render() {
        return view('livewire.pages.profile.profil', [
            'title'     => $this->title,
            'data'      => $this->data,
            'path_foto' => $this->path_foto,
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
