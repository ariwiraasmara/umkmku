<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Services\userService;
use App\Services\umkmkuService;
use App\Services\produkkuService;
use App\Services\transaksiService;
use App\Libraries\jsr;
use App\Libraries\myfunction as fun;
use Redirect;
use File;

class UmkmkuController extends Controller {
    //
    protected $service;

    public function __construct(umkmkuService $service) {
        $this->service = $service;
    }

    public function getAll(Request $request) {

    }

    public function get(Request $request) {

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
        return $this->service->update(
            $request->id_umkm,
            [
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

    public function delete(Request $request) {
        return $this->service->delete($request->id_umkm);
    }


    
}
