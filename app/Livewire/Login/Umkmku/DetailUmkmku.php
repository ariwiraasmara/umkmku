<?php

namespace App\Livewire\Login\Umkmku;

use Livewire\Component;
use App\Services\userService;
use App\Services\umkmkuService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class DetailUmkmku extends Component {

    protected String|null $id;
    protected String|null $title;
    protected umkmkuService|null $umkmService;
    protected array|Collection|JsonResponse|null $data;
    protected String|null $path_fotoumkm;
    protected String|null $path_logoumkm;

    public function mount(String $id) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        if( fun::getRawCookie('mcr_x_aswq_4') < 3 ) return redirect('dashboard');
        if($id < 1 || $id == null) return redirect('umkmku');
        $this->id = $id; //fun::denval($id);
        $this->title = 'Detil UMKM';
        $this->umkmService = new umkmkuService();
        // $data = json_decode($res, true);
        // if (isset($data['pesan'], $data['success'], $data['data'])) $this->data_transaksi = $data['data'];
        // else $this->data_transaksi = 0;

        // $this->data = $this->umkmService->getAllDetail($this->id);
        if(Cache::has('pageumkmku_datadetailumkm-'.$this->id)) $this->data = Cache::get('pageumkmku_datadetailumkm-'.$this->id);
        else {
            Cache::put('pageumkmku_datadetailumkm-'.$this->id, $this->umkmService->getAllDetail($this->id), 1*24*60*60);
            $this->data = Cache::get('pageumkmku_datadetailumkm-'.$this->id);
        }

        if(Cache::has('pageumkmku_pathfotoumkm-'.$this->id)) $this->path_fotoumkm = Cache::get('pageumkmku_pathfotoumkm-'.$this->id);
        else {
            Cache::put('pageumkmku_pathfotoumkm-'.$this->id, $this->umkmService->getFotoUmkm(fun::getCookie('mcr_x_aswq_2')), 1*24*60*60);
            $this->path_fotoumkm = Cache::get('pageumkmku_pathfotoumkm-'.$this->id);
        }

        if(Cache::has('pageumkmku_pathlogoumkm-'.$this->id)) $this->path_logoumkm = Cache::get('pageumkmku_pathlogoumkm-'.$this->id);
        else {
            Cache::put('pageumkmku_pathlogoumkm-'.$this->id, $this->umkmService->getLogoUmkm(fun::getCookie('mcr_x_aswq_2')), 1*24*60*60);
            $this->path_logoumkm = Cache::get('pageumkmku_pathlogoumkm-'.$this->id);
        }
    }

    public function render() {
    // return '<html>'.$this->data_umkm->get('id_umkm').'</html>';
        return view('livewire.pages.umkmku.detail', [
            'title'          => $this->title, 
            'id_user'        => fun::getCookie('mcr_x_aswq_1'),
            'id_umkm'        => $this->data['data_umkm'][0]['id_umkm'],
            'nama_umkm'      => $this->data['data_umkm'][0]['nama_umkm'],
            'tgl_berdiri'    => $this->data['data_umkm'][0]['tgl_berdiri'],
            'jenis_usaha'    => $this->data['data_umkm'][0]['jenis_usaha'],
            'deskripsi'      => $this->data['data_umkm'][0]['deskripsi'],
            'alamat'         => $this->data['data_umkm'][0]['alamat'],
            'longitude'      => $this->data['data_umkm'][0]['longitude'],
            'latitude'       => $this->data['data_umkm'][0]['latitude'],
            'no_tlp'         => $this->data['data_umkm'][0]['no_tlp'],
            'foto_umkm'      => $this->data['data_umkm'][0]['foto_umkm'],
            'logo_umkm'      => $this->data['data_umkm'][0]['logo_umkm'],
            'data_produk'    => $this->data['data_produk'],
            'data_transaksi' => $this->data['data_transaksi'],
            'data_user'      => $this->data['data_pegawai'],
            'path_fotoumkm'  => $this->path_fotoumkm,
            'path_logoumkm'  => $this->path_logoumkm
            // 'data'           => $this->data,
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.$this->data['data_umkm'][0]['nama_umkm'].' | UMKMKU'
        ]);
    }
}
