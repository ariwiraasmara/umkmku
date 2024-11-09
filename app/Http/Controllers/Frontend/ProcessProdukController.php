<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\umkmkuService;
use App\Libraries\myfunction as fun;


class ProcessProdukController extends Controller {
    //

    protected umkmkuService|null $service;
    public function __construct(umkmkuService $service) {
        $this->service = $service;
    }

    public function store(Request $request, String $id) {
        if($this->service->storeProduk([
            'id_umkm'       => fun::denval($id),
            'nama'          => $request->nama,
            'merk'          => $request->merk,
            'jenis'         => $request->jenis,
            'deskripsi'     => $request->deskripsi,
            'harga'         => $request->harga,
            'stok'          => $request->stok,
            'satuan_unit'   => $request->satuan_unit,
            'diskon'        => $request->diskon,
        ])) return redirect('/umkmku/detil/'.fun::enval($request->id_umkm)); 
        else return redirect('/dashboard');
    }

    public function update(Request $request, String $id) {
        if($this->service->updateProduk([
            'id_produk'     => fun::denval($id),
            'nama'          => $request->nama,
            'merk'          => $request->merk,
            'jenis'         => $request->jenis,
            'deskripsi'     => $request->deskripsi,
            'harga'         => $request->harga,
            'stok'          => $request->stok,
            'satuan_unit'   => $request->satuan_unit,
            'diskon'        => $request->diskon,
        ])) return redirect('/produk/detil/'.$id.'/'.fun::enval($request->id_umkm)); 
        else return redirect('/dashboard');
    }

    public function delete(String $id1, String $id2) {
        if($this->service->deleteProduk(fun::denval($id1))) return redirect('/umkmku/detil/'.$id2); 
        else return redirect('/dashboard');
    }
}
