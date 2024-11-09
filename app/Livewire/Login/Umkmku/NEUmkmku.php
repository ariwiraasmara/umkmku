<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Login\Umkmku;

use Livewire\Component;
use App\Services\umkmkuService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Exception;

class NEUmkmku extends Component {

    protected String|null $title;
    protected String|null $isedit;
    protected String|null $url;
    protected umkmkuService|String|null $service;
    protected array|Collection|JsonResponse|String|int|null $data;

    protected String|int|null $id_umkm;
    protected String|int|null $nama_umkm;
    protected String|int|null $tgl_berdiri;
    protected String|int|null $jenis_usaha;
    protected String|int|null $deskripsi;
    protected String|int|null $no_tlp;
    protected String|int|null $logo_umkm;
    protected String|int|null $foto_umkm;
    protected String|int|null $alamat;
    protected String|float|null $longitude;
    protected String|float|null $latitude;

    public function mount(String $id = null, String $title = null) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        /*
        $this->title        = $title == null ? 'UMKM Baru' : 'Edit UMKM';
        $this->isedit       = $title == null ? 'new' : 'isedit';
        $this->url          = $title == null ? '/process/umkm/baru' : '/process/umkm/update/'.$id;
        $this->service      = $title == null ? null : new umkmkuService();
        $this->data         = $title == null ? null : $this->service->get(['id_umkm' => fun::denval($id)]);
        $this->id_umkm      = $title == null ? null : $this->data[0]['id_umkm'];
        $this->nama_umkm    = $title == null ? null : $this->data[0]['nama_umkm'];
        $this->tgl_berdiri  = $title == null ? null : $this->data[0]['tgl_berdiri'];
        $this->jenis_usaha  = $title == null ? null : $this->data[0]['jenis_usaha'];
        $this->deskripsi    = $title == null ? null : $this->data[0]['deskripsi'];
        $this->no_tlp       = $title == null ? null : $this->data[0]['no_tlp'];
        $this->logo_umkm    = $title == null ? null : $this->data[0]['logo_umkm'];
        $this->foto_umkm    = $title == null ? null : $this->data[0]['foto_umkm'];
        $this->alamat       = $title == null ? null : $this->data[0]['alamat'];
        $this->longitude    = $title == null ? null : $this->data[0]['longitude'];
        $this->latitude     = $title == null ? null : $this->data[0]['latitude'];
        */
        if($title == null) {
            $this->title        = 'UMKM Baru';
            $this->isedit       = 'new';
            $this->url          = '/process/umkm/baru';
            $this->service      = null;
            $this->data         = null;
            $this->id_umkm      = null;
            $this->nama_umkm    = null;
            $this->tgl_berdiri  = null;
            $this->jenis_usaha  = null;
            $this->deskripsi    = null;
            $this->no_tlp       = null;
            $this->logo_umkm    = null;
            $this->foto_umkm    = null;
            $this->alamat       = null;
            $this->longitude    = null;
            $this->latitude     = null;
        }
        else {
            $this->title        = 'UMKM Baru';
            $this->isedit       = 'new';
            $this->url          = '/process/umkm/baru';
            $this->service      = new umkmkuService();
            $this->data         = $this->service->get(['id_umkm' => fun::denval($id)]);
            try {
                $this->id_umkm      = $this->data[0]['id_umkm'];
                $this->nama_umkm    = $this->data[0]['nama_umkm'];
                $this->tgl_berdiri  = $this->data[0]['tgl_berdiri'];
                $this->jenis_usaha  = $this->data[0]['jenis_usaha'];
                $this->deskripsi    = $this->data[0]['deskripsi'];
                $this->no_tlp       = $this->data[0]['no_tlp'];
                $this->logo_umkm    = $this->data[0]['logo_umkm'];
                $this->foto_umkm    = $this->data[0]['foto_umkm'];
                $this->alamat       = $this->data[0]['alamat'];
                $this->longitude    = $this->data[0]['longitude'];
                $this->latitude     = $this->data[0]['latitude'];
            }
            catch(Exception $e) {
                $this->id_umkm      = null;
                $this->nama_umkm    = null;
                $this->tgl_berdiri  = null;
                $this->jenis_usaha  = null;
                $this->deskripsi    = null;
                $this->no_tlp       = null;
                $this->logo_umkm    = null;
                $this->foto_umkm    = null;
                $this->alamat       = null;
                $this->longitude    = null;
                $this->latitude     = null;
            }
        }
    }

    public function render() {
        return view('livewire.pages.umkmku.new_edit', [
            'title'          => $this->title,
            'isedit'         => $this->isedit,
            'url'            => $this->url,
            'id_umkm'        => $this->id_umkm,
            'id_user'        => fun::getCookie('mcr_x_aswq_1'),
            'nama_umkm'      => $this->nama_umkm,
            'tgl_berdiri'    => $this->tgl_berdiri,
            'jenis_usaha'    => $this->jenis_usaha,
            'deskripsi'      => $this->deskripsi,
            'no_tlp'         => $this->no_tlp,
            'logo_umkm'      => $this->logo_umkm,
            'foto_umkm'      => $this->foto_umkm,
            'alamat'         => $this->alamat,
            'longitude'      => $this->longitude,
            'latitude'       => $this->latitude,
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
