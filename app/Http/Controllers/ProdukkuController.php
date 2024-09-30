<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\produkkuService;
// use Illuminate\Http\JsonResponse;
// use App\Libraries\jsr;
// use App\Libraries\myfunction as fun;
// use File;

class ProdukkuController extends Controller {
    //

    protected $service;
    public function __construct(produkkuService $service) {
        $this->service = $service;
    }

    public function getAll(Request $request) {
        return $this->service->getAll([
            'id_umkm' => $request->id_umkm,
            $request->by,
            $request->orderBy
        ]);
    }

    public function get(Request $request) {
        return $this->service->get(['id_umkm' => $request->id_umkm]);
    }

    public function store(Request $request) {
        return $this->service->store([
            'nama'          => $request['nama'],
            'merk'          => $request['merk'],
            'jenis'         => $request['jenis'],
            'deskripsi'     => $request['deskripsi'],
            'harga'         => $request['harga'],
            'stok'          => $request['stok'],
            'satuan_unit'   => $request['satuan_unit'],
            'diskon'        => $request['diskon'],
        ]);
    }

    public function update(Request $request) {
        return $this->service->store([
            'id_produk'     => $request['id_produk'],
            'nama'          => $request['nama'],
            'merk'          => $request['merk'],
            'jenis'         => $request['jenis'],
            'deskripsi'     => $request['deskripsi'],
            'harga'         => $request['harga'],
            'stok'          => $request['stok'],
            'satuan_unit'   => $request['satuan_unit'],
            'diskon'        => $request['diskon'],
        ]);
    }

    public function delete(Request $request) {
        return $this->service->delete($request['id_produk']);
    }

}
