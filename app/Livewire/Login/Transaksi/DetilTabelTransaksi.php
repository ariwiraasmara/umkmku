<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Login\Transaksi;

use Livewire\Component;
use App\Services\transaksiService;
use App\Libraries\myfunction as fun;

class DetilTabelTransaksi extends Component {
    
    protected String $title;
    protected String $tipe;
    protected String $id_umkm;
    protected $transaksiService;
    protected $data_transaksi;

    public function mount(String $tipe, String $id, String $from = null, String $to = null) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->title            = "Transaksi Tabel Detil ".$tipe;
        $this->tipe             = $tipe;
        $this->id_umkm          = $id;
        $this->transaksiService = new transaksiService();
        
        // $this->data_transaksi = null;
        $this->data_transaksi = $this->transaksiService->getDetailHarian($id, $from);
        // if($tipe == 'harian') {
        //     $this->data_transaksi = $this->transaksiService->getDetailHarian($id, $from);
        // }
        // else if($tipe == 'mingguan') {

        // }
        // else if($tipe == 'bulanan') {

        // }
        // else if($tipe == 'tahunan') {

        // }
        // else if($tipe == 'custom') {

        // }
    }

    public function render() {
        return view('livewire.pages.transaksi.detil-tabel-transaksi',[
            'title'             => $this->title,
            'tipe'              => $this->tipe,
            'tahun_sekarang'    => date('Y'),
            'id_umkm'           => $this->id_umkm,
            'total'             => 0,
            'data_transaksi'    => $this->data_transaksi,
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);;
    }
}
