<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\transaksiService;
use Illuminate\Http\JsonResponse;
use App\Libraries\jsr;
use App\Libraries\myfunction as fun;
// use File;

class TransaksiController extends Controller {
    //
    protected transaksiService $service;
    public function __construct(transaksiService $service) {
        $this->service = $service;
    }

    public function getAll(Request $request) {
        return $this->service->getAll(
            $request->id_umkm,
            $request->by,
            $request->orderBy,
        );
    }

    public function get($id): JsonResponse {
        return jsr::print([
            'pesan' => 'tambah transaksi berhasil', 
            'success' => 1,
            'data' => $this->service->get($id)
        ], 'ok');
    }

    public function store(Request $request): JsonResponse {
        // return $request;
        return $this->service->store(
        [
            'id_umkm'        => $request->id_umkm,
            'diskon'         => $request->diskon,
            'nama_pelanggan' => $request->nama_pelanggan,
            'uang_diterima'  => $request->uang_diterima,
        ],
        [
            'id_produk' => $request->id_produk,
            'jumlah'    => $request->jumlah
        ]);
    }

    public function delete($id_transaksi): JsonResponse {
        return $this->service->delete($id_transaksi);
    }

}
