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
        $data = $this->service->get($id);
        return jsr::print([
            'pesan'             => 'Halaman Detil Transaksi : '.$data['data'][0]['no_nota'], 
            'success'           => 1,
            'data'              => $data['data'],
            'detail_transaksi'  => $data['detail_transaksi'],
            'sub_total_produk'  => $data['sub_total_produk'],
            'totalakhir'        => $data['totalakhir'],
            'uangkembalian'     => $data['uangkembalian']
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
