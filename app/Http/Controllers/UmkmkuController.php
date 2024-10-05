<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\umkmkuService;
// use Illuminate\Http\JsonResponse;
// use App\Libraries\jsr;
// use App\Libraries\myfunction as fun;
// use File;

class UmkmkuController extends Controller {
    //
    protected $service;

    public function __construct(umkmkuService $service) {
        $this->service = $service;
    }

    public function getAll(Request $request, $id) {
        return $this->service->getAll(
            $request->where,
            $request->by,
            $request->orderBy
        );
    }

    //
    public function get(Request $request) {
        return $this->service->getAllDetail(['id_umkm' => $request->id_umkm]);
    }

    public function store(Request $request) {
        return $this->service->store(
           [
                'id_user'       => $request->id_user,
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

    public function update(Request $request) {
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

    public function delete(Request $request) {
        return $this->service->delete($request->id_umkm);
    }

}
