<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\transaksiService;
// use Illuminate\Http\JsonResponse;
// use App\Libraries\jsr;
use App\Libraries\myfunction as fun;
// use File;

class TransaksiController extends Controller {
    //
    protected $service;
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

    public function get(Request $request) {
        return $this->service->get($request->id_transaksi);
    }

    public function store(Request $request) {
        return $this->service->store(
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
        ]);
    }

    public function delete(Request $request) {
        return $this->service->delete($request->id_transaksi);
    }

}
