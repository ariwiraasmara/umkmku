<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Login\Staff;

use Livewire\Component;
use App\Services\userService;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use App\Libraries\myfunction as fun;

class DetailStaff extends Component {

    protected String|null $title;
    protected userService|String|null $service;
    protected String|int|null $id;
    protected array|Collection|JsonResponse|String|int|null $data;
    protected String|null $path_foto;

    public function mount(String $id = null) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->id = fun::denval($id);
        
        if(Cache::has('pagedetailstaff_data-'.$this->id)) $this->data = Cache::get('pagedetailstaff_data-'.$this->id);
        else {
            $this->service = new userService();
            Cache::put('pagedetailstaff_data-'.$this->id, $this->service->getStaff($this->id), 1*24*60*60);
            $this->data = Cache::get('pagedetailstaff_data-'.$this->id);
        }
        
        $this->title     = 'Detail Staff';
        $this->path_foto = '/users/photos/'.$this->data[0]['foto'];
    }

    public function render() {
        return view('livewire.pages.staff.detailstaff', [
            'title' => $this->title,
            'data'  => $this->data    
        ])
        ->layout('layouts.authorized', [
            'pagetitle'     => $this->title.' | UMKMKU',
            'description'   => 'UMKMKU adalah sebuah aplikasi berbasis website untuk pelaku usaha UMKM dan digunakan oleh mereka (sebagai user). Aplikasi ini bisa digunakan untuk berbagai jenis umkm dan dapat diakses di berbagai device dan platform.',
            'keywords'      => 'UMKMKU, Aplikasi UMKM, Website UMKM, Aplikasi untuk pengusaha kecil dan menengah kebawah, Website untuk pengusaha kecil dan menengah kebawah, Platform UMKM kecil dan menengah ke bawah.',
            'copyright'     => 'Copyright '.date('Y').' @ Syahri Ramadhan Wiraasmara (ARI)'
        ]);
    }
}
