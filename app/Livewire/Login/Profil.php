<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Login;

use Livewire\Component;
use App\Services\userService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Exception;

class Profil extends Component {

    protected String|null $title;
    protected userService|String|null $service;
    protected array|Collection|JsonResponse|String|int|null $data;
    protected String|null $path_foto;

    public function mount() {
        // Cache::flush();
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->service  = new userService();
        $this->title    = 'Profil';

        $this->path_foto = public_path($this->service->getFotoProfilUser(fun::getCookie('mcr_x_aswq_2')));
        // $this->service->readDir(fun::getCookie('mcr_x_aswq_2')).'/foto_profil.png';
        // Storage::get($this->service->readDir(fun::getCookie('mcr_x_aswq_2')).'/foto_profil.png');
        //'/users/'.fun::getCookie('mcr_x_aswq_2').'/photos/foto_profil.png'; #Storage::get('/app/private/users/'.fun::getCookie('mcr_x_aswq_2').'/photos/foto_profil.png'); //Cache::get('pageprofil_pathfoto');

        if(Cache::has('pageprofil_dataprofil-'.fun::getCookie('mcr_x_aswq_1'))) $this->data = Cache::get('pageprofil_dataprofil-'.fun::getCookie('mcr_x_aswq_1'));
        else {
            Cache::put('pageprofil_dataprofil-'.fun::getCookie('mcr_x_aswq_1'), $this->service->getProfil(fun::getCookie('mcr_x_aswq_1')), 1*24*60*60);
            $this->data = Cache::get('pageprofil_dataprofil-'.fun::getCookie('mcr_x_aswq_1'));
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
        ->layout('layouts.authorized', [
            'pagetitle'     => $this->title.' | UMKMKU',
            'description'   => 'UMKMKU adalah sebuah aplikasi berbasis website untuk pelaku usaha UMKM dan digunakan oleh mereka (sebagai user). Aplikasi ini bisa digunakan untuk berbagai jenis umkm dan dapat diakses di berbagai device dan platform.',
            'keywords'      => 'UMKMKU, Aplikasi UMKM, Website UMKM, Aplikasi untuk pengusaha kecil dan menengah kebawah, Website untuk pengusaha kecil dan menengah kebawah, Platform UMKM kecil dan menengah ke bawah.',
            'copyright'     => 'Copyright '.date('Y').' @ Syahri Ramadhan Wiraasmara (ARI)'
        ]);
    }
}
