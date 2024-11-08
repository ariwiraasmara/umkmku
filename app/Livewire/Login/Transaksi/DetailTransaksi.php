<?php

namespace App\Livewire\Login\Transaksi;

use Livewire\Component;
use App\Services\transaksiService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Barryvdh\DomPDF\Facade\Pdf;

class DetailTransaksi extends Component {

    protected String|null $title = 'Detail Transaksi';
    protected transaksiService|null $service;
    protected array|Collection|JsonResponse|null $data;
    protected int|String|null $id;

    protected $pdf;
    protected $pdf_download;
    protected $path_logo;

    public function mount(String $id) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        if($id == null || $id == '' || is_null($id)) return redirect('umkmku');
        $this->id = fun::denval($id);
        $this->title = 'Detail Transaksi '.$id;

        if(Cache::has('pagedetailtransaksi_data-'.$this->id)) $this->data = Cache::get('pagedetailtransaksi_data-'.$this->id);
        else {
            $this->service = new transaksiService();
            Cache::put('pagedetailtransaksi_data-'.$this->id, $this->service->get($this->id), 1*24*60*60);
            $this->data = Cache::get('pagedetailtransaksi_data-'.$this->id);
        }

        if(Cache::has('pagedetailtransaksi_path_logo-'.$this->id)) $this->path_logo = Cache::get('pagedetailtransaksi_path_logo-'.$this->id);
        else {
            Cache::put('pagedetailtransaksi_path_logo-'.$this->id, '/users/'.fun::getCookie('islogin').'/photos/'.$this->data['data'][0]['logo_umkm'], 1*24*60*60);
            $this->path_logo = Cache::get('pagedetailtransaksi_path_logo-'.$this->id);
        }

        // $this->pdf = Pdf::loadView('pdf.invoice', $data);
    }

    public function export() {
        // Ambil data yang ingin ditampilkan di PDF.
        // Misalnya, data dari database atau property component.
        $data = [
            'title' => $this->title
        ];

        // Render view menjadi HTML.
        $html = view('pdf.template', $data)->render();

        // Buat instance PDF dan load HTML.
        $pdf = PDF::loadHTML($html);

        // Download PDF.
        return $pdf->download($this->title.'.pdf');
    }

    public function render() {
        return view('livewire.pages.transaksi.detail', [
            'title'             => $this->title,
            'data'              => $this->data,
            'incx'              => 1,
            'sub'               => 0,
            'subtotal'          => 0,
            'uang_kembalian'    => 0,
            'path_logo'         => $this->path_logo
        ])
        ->layout(
            'layouts.unauthorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
