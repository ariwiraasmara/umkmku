<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Login\Umkmku;

use Livewire\Component;
use App\Services\userService;
use App\Services\umkmkuService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Exception;

class DetailUmkmku extends Component {

    protected String|null $title;
    protected umkmkuService|String|null $umkmService;
    protected array|Collection|JsonResponse|String|int|null $data;
    protected array|Collection|JsonResponse|String|int|null $data_produk;
    protected array|Collection|JsonResponse|String|int|null $data_transaksi;
    protected array|Collection|JsonResponse|String|int|null $data_pegawai;

    protected String|null $id_umkm;
    protected String|null $nama_umkm;
    protected String|null $tgl_berdiri;
    protected String|null $jenis_usaha;
    protected String|null $deskripsi;
    protected String|null $alamat;
    protected String|float|null $longitude;
    protected String|float|null $latitude;
    protected String|null $no_tlp;
    protected String|null $foto_umkm;
    protected String|null $logo_umkm;
    protected String|null $path_fotoumkm;
    protected String|null $path_logoumkm;

    public function mount(String $id) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        if( fun::getRawCookie('mcr_x_aswq_4') < 3 ) return redirect('dashboard');
        if($id < 1 || $id == null) return redirect('umkmku');
        $this->id_umkm = $id; //fun::denval($id);
        $this->title = 'Detil UMKM';
        $this->umkmService = new umkmkuService();

        if(Session::has('pesan')) {
            Cache::put('page_detailumkmku_datadetailumkm-'.$this->id_umkm, $this->umkmService->getAllDetail($this->id_umkm), 1*24*60*60);
            $this->data = Cache::get('page_detailumkmku_datadetailumkm-'.$this->id_umkm);
        }

        if(Cache::has('page_detailumkmku_datadetailumkm-'.$this->id_umkm)) $this->data = Cache::get('page_detailumkmku_datadetailumkm-'.$this->id_umkm);
        else {
            Cache::put('page_detailumkmku_datadetailumkm-'.$this->id_umkm, $this->umkmService->getAllDetail($this->id_umkm), 1*24*60*60);
            $this->data = Cache::get('page_detailumkmku_datadetailumkm-'.$this->id_umkm);
        }

        try {
            $this->nama_umkm      = $this->data['data_umkm'][0]['nama_umkm'];
            $this->tgl_berdiri    = $this->data['data_umkm'][0]['tgl_berdiri'];
            $this->jenis_usaha    = $this->data['data_umkm'][0]['jenis_usaha'];
            $this->deskripsi      = $this->data['data_umkm'][0]['deskripsi'];
            $this->alamat         = $this->data['data_umkm'][0]['alamat'];
            $this->longitude      = $this->data['data_umkm'][0]['longitude'];
            $this->latitude       = $this->data['data_umkm'][0]['latitude'];
            $this->no_tlp         = $this->data['data_umkm'][0]['no_tlp'];
            $this->foto_umkm      = $this->data['data_umkm'][0]['foto_umkm'];
            $this->logo_umkm      = $this->data['data_umkm'][0]['logo_umkm'];
            $this->data_produk    = $this->data['data_produk'];
            $this->data_transaksi = $this->data['data_transaksi'];
            $this->data_pegawai   = $this->data['data_pegawai'];
        }
        catch(Exception $e) {
            $this->nama_umkm      = null;
            $this->tgl_berdiri    = null;
            $this->jenis_usaha    = null;
            $this->deskripsi      = null;
            $this->alamat         = null;
            $this->longitude      = null;
            $this->latitude       = null;
            $this->no_tlp         = null;
            $this->foto_umkm      = null;
            $this->logo_umkm      = null;
            $this->data_produk    = null;
            $this->data_transaksi = null;
            $this->data_pegawai   = null;
            $this->path_fotoumkm  = null;
            $this->path_logoumkm  = null;
        }

        $this->path_fotoumkm = null;
        if($this->path_fotoumkm != null || $this->path_fotoumkm != '') {
            if(Cache::has('page_detailumkmku_pathfotoumkm-'.$this->id_umkm)) $this->data = Cache::get('page_detailumkmku_pathfotoumkm-'.$this->id_umkm);
            else {
                Cache::put('page_detailumkmku_pathfotoumkm-'.$this->id_umkm, $this->umkmService->getFotoUmkm(fun::getCookie('mcr_x_aswq_2')), 1*24*60*60);
                $this->path_fotoumkm = Cache::get('page_detailumkmku_pathfotoumkm-'.$this->id_umkm);
            }
        }
        
        $this->path_logoumkm = null;
        if($this->path_logoumkm != null || $this->path_logoumkm != '') {
            if(Cache::has('page_detailumkmku_pathlogoumkm-'.$this->id_umkm)) $this->data = Cache::get('page_detailumkmku_pathlogoumkm-'.$this->id_umkm);
            else {
                Cache::put('page_detailumkmku_pathlogoumkm-'.$this->id_umkm, $this->umkmService->getLogoUmkm(fun::getCookie('mcr_x_aswq_2')), 1*24*60*60);
                $this->path_logoumkm = Cache::get('page_detailumkmku_pathlogoumkm-'.$this->id_umkm);
            }
        }
    
        

        
    }

    public function render() {
    // return '<html>'.$this->data_umkm->get('id_umkm').'</html>';
        return view('livewire.pages.umkmku.detail', [
            'title'          => $this->title, 
            'id_user'        => fun::getCookie('mcr_x_aswq_1'),
            'id_umkm'        => $this->id_umkm,
            'nama_umkm'      => $this->nama_umkm,
            'tgl_berdiri'    => $this->tgl_berdiri,
            'jenis_usaha'    => $this->jenis_usaha,
            'deskripsi'      => $this->deskripsi,
            'alamat'         => $this->alamat,
            'longitude'      => $this->longitude,
            'latitude'       => $this->latitude,
            'no_tlp'         => $this->no_tlp,
            'foto_umkm'      => $this->foto_umkm,
            'logo_umkm'      => $this->logo_umkm,
            'data_produk'    => $this->data_produk,
            'data_transaksi' => $this->data_transaksi,
            'data_user'      => $this->data_pegawai,
            'path_fotoumkm'  => $this->path_fotoumkm,
            'path_logoumkm'  => $this->path_logoumkm
            // 'data'           => $this->data,
        ])
        ->layout('layouts.authorized', [
            'pagetitle'     => $this->title.' | UMKMKU',
            'uniquekey'     => fun::random('combwisp', 60),
            'description'   => 'UMKMKU adalah sebuah aplikasi berbasis website untuk pelaku usaha UMKM dan digunakan oleh mereka (sebagai user). Aplikasi ini bisa digunakan untuk berbagai jenis umkm dan dapat diakses di berbagai device dan platform.',
            'keywords'      => 'UMKMKU, Aplikasi UMKM, Website UMKM, Aplikasi untuk pengusaha kecil dan menengah kebawah, Website untuk pengusaha kecil dan menengah kebawah, Platform UMKM kecil dan menengah ke bawah.',
            'copyright'     => 'Copyright '.date('Y').' @ Syahri Ramadhan Wiraasmara (ARI)'
        ]);
    }
}
