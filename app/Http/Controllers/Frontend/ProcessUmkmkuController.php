<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\umkmkuService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Facades\Http;

class ProcessUmkmkuController extends Controller {
    //

    protected $service;
    public function __construct(umkmkuService $service) {
        $this->service = $service;
    }

    public function store(Request $request) {
        $res = $this->service->store(
           [
                'id_user'       => fun::getCookie('mcr_x_aswq_1'),
                'email'         => fun::getCookie('mcr_x_aswq_3'),
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
        if($res) return redirect('/umkmku');
        else return redirect('/umkmku/baru'); 
    }

    public function update(Request $request) {
        $res = $this->service->update([
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
        if($res) return redirect('/umkmku/detil/'.$request->id_umkm); 
        else return redirect('/umkmku');
    }

    public function delete(String $id_umkm) {
        $res = $this->service->delete($id_umkm);
        if($res) return redirect('/umkmku'); 
        else return redirect('/dashboard');
    }

}
