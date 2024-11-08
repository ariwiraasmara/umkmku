<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\transaksiService;
use App\Libraries\myfunction as fun;

class ProcessTransaksiController extends Controller {
    //

    protected transaksiService|null $service;
    public function __construct(transaksiService $service) {
        $this->service = $service;
    }

    public function store(Request $request) {
        // return $request;
        if($this->service->store(
        [
            'id_transaksi'   => $request->id_transaksi,
            'email'          => fun::getCookie('mcr_x_aswq_3'),
            'id_umkm'        => $request->id_umkm,
            'id_user'        => fun::getCookie('mcr_x_aswq_1'),
            'diskon'         => $request->diskon,
            'nama_pelanggan' => $request->nama_pelanggan,
            'uang_diterima'  => $request->uang_diterima,
        ],
        [
            'id_produk' => $request->id_produk,
            'jumlah'    => $request->jumlah
        ])) return redirect('/umkmku/detil/'.fun::enval($request->id_umkm)); 
        else return redirect('/dashboard');
    }

    public function delete(String $id1, String $id2) {
        if($this->service->delete(fun::denval($id1))) return redirect('/umkmku/detil/'.$id2);
        return redirect('/dashboard');
    }
}
