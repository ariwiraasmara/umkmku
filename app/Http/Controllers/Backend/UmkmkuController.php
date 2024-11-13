<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\umkmkuService;
// use Illuminate\Http\JsonResponse;
use App\Libraries\jsr;
use App\Libraries\myfunction as fun;
use Illuminate\Http\JsonResponse;

// use File;

class UmkmkuController extends Controller {
    //
    protected umkmkuService $service;

    public function __construct(umkmkuService $service) {
        $this->service = $service;
    }

    public function getAll($by = null, $orderBy = null): JsonResponse {
        $where = ['id' => fun::getCookie("mcr_x_aswq_1")];
        $data = $this->service->getAll(
            $where,
            $by,
            $orderBy
        );
        return jsr::print([
            'pesan'          => 'Halaman UMKM', 
            'success'        => 1,
            'data_umkm'      => $data,
        ]);
    }

    //
    public function get(String $id_umkm): JsonResponse {
        $data = $this->service->getAllDetail($id_umkm);
        return jsr::print([
            'pesan'          => 'Halaman Detil UMKM : '.$data['data_umkm'][0]['nama_umkm'], 
            'success'        => 1,
            'data_umkm'      => $data['data_umkm'],
            'data_produk'    => $data['data_produk'],
            'data_transaksi' => $data['data_transaksi'],
            'data_pegawai'   => $data['data_pegawai'], 
        ]);
    }

    public function store(Request $request): JsonResponse {
        return $this->service->store(
           [
                'id_user'       => fun::getCookie("mcr_x_aswq_1"),
                'nama_umkm'     => $request->nama_umkm,
                'tgl_berdiri'   => $request->tgl_berdiri,
                'jenis_usaha'   => $request->jenis_usaha,
                'deskripsi'     => $request->deskripsi,
                'no_tlp'        => $request->no_tlp,
                'logo_umkm'     => $request->logo_umkm,
                'foto_umkm'     => $request->foto_umkm,
                'alamat'        => $request->alamat,
                'longitude'     => $request->longitude,
                'latitude'      => $request->latitude,
            ]
        );
    }

    public function update(Request $request): JsonResponse {
        return $this->service->update([
            'id_umkm'     => $request->id_umkm,
            'nama_umkm'   => $request->nama_umkm,
            'tgl_berdiri' => $request->tgl_berdiri,
            'jenis_usaha' => $request->jenis_usaha,
            'deskripsi'   => $request->deskripsi,
            'no_tlp'      => $request->no_tlp,
            'logo_umkm'   => $request->logo_umkm,
            'foto_umkm'   => $request->foto_umkm,
            'alamat'      => $request->alamat,
            'longitude'   => $request->longitude,
            'latitude'    => $request->latitude,
        ]);
    }

    public function delete($id): JsonResponse {
        return $this->service->delete($id);
    }

}
