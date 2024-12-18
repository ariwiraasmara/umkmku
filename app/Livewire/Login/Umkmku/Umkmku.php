<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Login\Umkmku;

use Livewire\Component;
use App\Services\umkmkuService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Exception;

class Umkmku extends Component {
    
    protected String|null $title;
    protected umkmkuService|String|null $service;
    protected array|Collection|JsonResponse|String|int|null $data;

    public function mount() {
        // Cache::flush();
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        if( fun::getRawCookie('mcr_x_aswq_4') < 3 ) return redirect('dashboard');
        $this->title = 'UMKMKu';
        
        if(Session::has('pesan')) {
            Cache::put('page_umkmku_dataumkm-'.fun::getCookie('mcr_x_aswq_1'), $this->service->getAll(['id' => fun::getCookie('mcr_x_aswq_1')], 'id_umkm', 'asc'), 1*24*60*60);
            $this->data = Cache::get('page_umkmku_dataumkm-'.fun::getCookie('mcr_x_aswq_1'));
        }

        if(Cache::has('page_umkmku_dataumkm-'.fun::getCookie('mcr_x_aswq_1'))) $this->data = Cache::get('page_umkmku_dataumkm-'.fun::getCookie('mcr_x_aswq_1'));
        else {
            $this->service = new umkmkuService();
            Cache::put('page_umkmku_dataumkm-'.fun::getCookie('mcr_x_aswq_1'), $this->service->getAll(['id' => fun::getCookie('mcr_x_aswq_1')], 'id_umkm', 'asc'), 1*24*60*60);
            $this->data = Cache::get('page_umkmku_dataumkm-'.fun::getCookie('mcr_x_aswq_1'));
        }
    }

    public function render() {
        return view('livewire.pages.umkmku.list', [
            'title'   => $this->title, 
            'data'    => $this->data
        ])
        ->layout('layouts.authorized', [
            'pagetitle'   => $this->title.' | UMKMKU',
            'uniquekey'   => fun::random('combwisp', 60),
            'description' => 'UMKMKU adalah sebuah aplikasi berbasis website untuk pelaku usaha UMKM dan digunakan oleh mereka (sebagai user). Aplikasi ini bisa digunakan untuk berbagai jenis umkm dan dapat diakses di berbagai device dan platform.',
            'keywords'    => 'UMKMKU, Aplikasi UMKM, Website UMKM, Aplikasi untuk pengusaha kecil dan menengah kebawah, Website untuk pengusaha kecil dan menengah kebawah, Platform UMKM kecil dan menengah ke bawah.',
            'copyright'   => 'Copyright '.date('Y').' @ Syahri Ramadhan Wiraasmara (ARI)'
        ]);
    }
}
