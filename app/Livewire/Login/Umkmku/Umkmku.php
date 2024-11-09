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

class Umkmku extends Component {
    
    protected String|null $title;
    protected umkmkuService|String|null $service;
    protected array|Collection|JsonResponse|String|int|null $data;

    public function mount() {
        // Cache::flush();
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        if( fun::getRawCookie('mcr_x_aswq_4') < 3 ) return redirect('dashboard');
        $this->title = 'UMKMKu';
        $this->service = new umkmkuService();
        
        if(Cache::has('pageumkmku_dataumkm')) $this->data = Cache::get('pageumkmku_dataumkm');
        else {
            Cache::put('pageumkmku_dataumkm', $this->service->getAll(['id' => fun::getCookie('mcr_x_aswq_1')], 'id_umkm', 'asc'), 1*24*60*60);
            $this->data = Cache::get('pageumkmku_dataumkm');
        }

        if(Session::has('pesan')) {
            Cache::put('pageumkmku_dataumkm', $this->service->getAll(['id' => fun::getCookie('mcr_x_aswq_1')], 'id_umkm', 'asc'), 1*24*60*60);
            $this->data = Cache::get('pageumkmku_dataumkm');
        }
    }

    public function render() {
        return view('livewire.pages.umkmku.list', [
            'title' => $this->title, 
            'data' => $this->data
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
