<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\userService;
use App\Services\umkmkuService;
use App\Libraries\myfunction as fun;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProcessUmkmkuController extends Controller {
    //

    protected userService|null $userService;
    protected umkmkuService|null $umkmService;
    public function __construct(userService $userService, umkmkuService $umkmService) {
        $this->userService = $userService;
        $this->umkmService = $umkmService;
    }

    public function store(Request $request) {
        if($this->umkmService->store([
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
        ])) return redirect('/umkmku')->with('pesan', 'Berhasil tambah UMKM Baru');
        else return redirect('/dashboard'); 
    }

    public function update(Request $request, String $id) {
        $file_umkm = $request->file('foto_umkm');
        $file_logo = $request->file('logo_umkm');
        // return $file_logo->getClientOriginalName().' = '.$file_umkm->getSize().' ; '.$file_logo->getClientOriginalName().' = '.$file_umkm->getSize();
        if($request->hasFile('foto_umkm')) {
            if($file_umkm->getSize() > 2097152) return redirect('/umkmku');
        }
        if($request->hasFile('logo_umkm')) {
           if($file_logo->getSize() > 2097152) return redirect('/umkmku'); 
        }

        if($this->umkmService->update([
            'id_umkm'     => fun::denval($id),
            'nama_umkm'   => $request->nama_umkm,
            'tgl_berdiri' => $request->tgl_berdiri,
            'jenis_usaha' => $request->jenis_usaha,
            'deskripsi'   => $request->deskripsi,
            'no_tlp'      => $request->no_tlp,
            'logo_umkm'   => $file_logo->getClientOriginalName(),
            'foto_umkm'   => $file_umkm->getClientOriginalName(),
            'alamat'      => $request->alamat,
            'longitude'   => $request->longitude,
            'latitude'    => $request->latitude,
        ])) {
            if($request->hasFile('foto_umkm')) {
                $file_umkm->move($this->userService->readDir(fun::getCookie('mcr_x_aswq_2')), $file_umkm->getClientOriginalName());
                Storage::putFileAs('/users/'.fun::getCookie('mcr_x_aswq_2').'/photos', new File('/users/'.fun::getCookie('mcr_x_aswq_2').'/photos/'.$file_umkm->getClientOriginalName()), 'foto_umkm.png');
            }

            if($request->hasFile('logo_umkm')) {
                $file_logo->move($this->userService->readDir(fun::getCookie('mcr_x_aswq_2')), $file_logo->getClientOriginalName());
                Storage::putFileAs('/users/'.fun::getCookie('mcr_x_aswq_2').'/photos', new File('/users/'.fun::getCookie('mcr_x_aswq_2').'/photos/'.$file_logo->getClientOriginalName()), 'logo_umkm.png');
            }

            return redirect('/umkmku/detil/'.$id); 
        }
        else return redirect('/dashboard');
    }

    public function delete(String $id_umkm) {
        if($this->umkmService->delete(fun::denval($id_umkm))) return redirect('/umkmku'); 
        else return redirect('/dashboard');
    }

}
