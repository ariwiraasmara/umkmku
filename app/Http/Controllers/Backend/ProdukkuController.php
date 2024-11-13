<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\umkmkuService;
use Illuminate\Http\JsonResponse;
use App\Libraries\jsr;
// use App\Libraries\myfunction as fun;
// use File;

class ProdukkuController extends Controller {
    //

    protected umkmkuService $service;
    public function __construct(umkmkuService $service) {
        $this->service = $service;
    }

    public function getAll(Request $request): JsonResponse {
        return $this->service->getAll([
            'id_umkm' => $request->id_umkm,
            $request->by,
            $request->orderBy
        ]);
    }

    public function get(String $id): JsonResponse {
        return jsr::print([
            'pesan'   => 'Halaman Detil Produk', 
            'success' => 1,
            'data'    => $this->service->getProduk(['id_produk' => $id]),
        ]);
    }

    public function store(Request $request): JsonResponse {
        return $this->service->storeProduk([
            'id_umkm'       => $request['id_umkm'],
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

    public function update(Request $request): JsonResponse {
        return $this->service->updateProduk([
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

    public function delete(String $id): JsonResponse {
        return $this->service->deleteProduk($id);
    }

}
