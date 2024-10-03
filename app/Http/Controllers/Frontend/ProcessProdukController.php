<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\produkkuService;
use App\Libraries\myfunction as fun;

class ProcessProdukController extends Controller {
    //

    protected $service;
    public function __construct(produkkuService $service) {
        $this->service = $service;
    }

    public function store(Request $request) {
        $res = $this->service->store([
            'id_umkm'       => $request->id_umkm,
            'email'         => fun::getCookie('mcr_x_aswq_3'),
            'nama'          => $request->nama,
            'merk'          => $request->merk,
            'jenis'         => $request->jenis,
            'deskripsi'     => $request->deskripsi,
            'harga'         => $request->harga,
            'stok'          => $request->stok,
            'satuan_unit'   => $request->satuan_unit,
            'diskon'        => $request->diskon,
        ]);
        if(empty($res) || is_null($res)) return redirect('/produk/baru/'.$request->id_umkm); 
        else return redirect('/umkmku/detil/'.$request->id_umkm);
    }

    public function update(Request $request) {
        $res = $this->service->store([
            'id_produk'     => $request->id_produk,
            'nama'          => $request->nama,
            'merk'          => $request->merk,
            'jenis'         => $request->jenis,
            'deskripsi'     => $request->deskripsi,
            'harga'         => $request->harga,
            'stok'          => $request->stok,
            'satuan_unit'   => $request->satuan_unit,
            'diskon'        => $request->diskon,
        ]);
        if(empty($res) || is_null($res)) return redirect('/umkmku/edit/'.$request->id_produk); 
        else return redirect('/umkmku');
    }

    public function delete(Request $request) {
        $res = $this->service->delete($request['id_produk']);
        return redirect('/umkmku');
    }
}
