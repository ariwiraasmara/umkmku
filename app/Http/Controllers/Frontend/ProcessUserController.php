<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Services\userService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProcessUserController extends Controller {
    //

    protected userService|null $service;
    public function __construct(userService $service) {
        $this->service = $service;
    }

    public function login(Request $request) {
        $data = $this->service->login($request->user, $request->password);
        // return $data;
        if($data['success'] == 1) {
            $time = 1;
            if($request->remember) $time = 3560;

            fun::setCookie([
                'islogin'      => 1,
                "mcr_x_aswq_1" => $data['data'][0]['id'],
                "mcr_x_aswq_2" => $data['data'][0]['username'],
                "mcr_x_aswq_3" => $data['data'][0]['email'],
                "mcr_x_aswq_4" => $data['data'][0]['roles'],
                // "mcr_x_aswq_5" => $data['success'][0]['remember_token'],
            ], true, $time, 24, 60, 60);

            return redirect('dashboard');
        }
    }

    public function logout(Request $request) {
        Cache::flush();
        fun::setCookieOff('islogin');
        fun::setCookieOff('mcr_x_aswq_1');
        fun::setCookieOff('mcr_x_aswq_2');
        fun::setCookieOff('mcr_x_aswq_3');
        fun::setCookieOff('mcr_x_aswq_4');
        return redirect('login');
    }

    public function daftar_pengguna_baru(Request $request) {
        if($this->service->storeAccount(
            $request->username,
            $request->email,
            $request->password,
            2
        )) {
            $this->service->createDir($request->username);
            return redirect('/login');
        }
        else return redirect('/daftar-pengguna-baru'); 
    }

    public function update_userprofil(Request $request) {
        $res1 = $this->service->updateAccount(fun::getCookie('mcr_x_aswq_1'), 'tlp', $request->tlp);

        $res2 = $this->service->updateProfil([
            'id'            => fun::getCookie('mcr_x_aswq_1'),
            'nama'          => $request->nama,           
            'jk'            => $request->jk,             
            'alamat'        => $request->alamat,         
            'foto'          => $request->foto,           
            'tempat_lahir'  => $request->tempat_lahir,   
            'tgl_lahir'     => $request->tgl_lahir,      
            'id_umkm'       => $request->id_umkm,
            'status'        => $request->status,         
            'jabatan'       => $request->jabatan,        
        ]);

        if($res1 && $res2) return redirect('/profil'); 
        else return redirect('/dashboard'); 
    }

    public function store_staff(Request $request, String $id) {
        // return $id;
        if($this->service->new_staff([
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => $request->password,
            'roles'     => $request->roles,
            'nama'      => $request->nama,
            'id_umkm'   => fun::denval($id),
        ])) return redirect('/umkmku/detil/'.fun::denval($id)); 
        else return redirect('/umkmku'); 
    }

    public function update_staff(Request $request, String $id) {
        // int $id, String $field, String $field_value
        if($this->service->updateStaff([
            'id'      => fun::denval($id),
            'id_umkm' => $request->id_umkm,
            'roles'   => $request->roles,
            'status'  => $request->status
        ])) return redirect('/staff/detil/'.fun::denval($id)); 
        else return redirect('/umkmku'); 
    }

    public function update_userpassword(Request $request, String $id) {
        if($this->service->updateAccount(fun::denval($id), 'password', Hash::make($request->password))) return redirect('/profil'); 
        else return redirect('/dashboard'); 
    }

    public function update_userfoto(Request $request, String $id) {
        $id = fun::denval($id);
        $file = $request->file('foto');
        if($file->getClientOriginalName() != '' || $file->getClientOriginalName() != null || !is_null($file->getClientOriginalName())) {
            $file->move($this->service->readDir(fun::getCookie('mcr_x_aswq_2')), $file->getClientOriginalName());
            // $file = @$_FILES['foto']['name'];
            // $fileName = time() . '_' . $file->getClientOriginalName(); 
            // $file->storeAs('public/user/photos/', $fileName); 
            // $path = $request->foto->storeAs($this->service->readDir(fun::getCookie('mcr_x_aswq_2')), 'foto_profil.png');
            // return $path;
            // $file->move($path);
            // Storage::putFile($this->service->readDir(fun::getCookie('mcr_x_aswq_2')), $file->getClientOriginalName());
            // $path = Storage::putFile('/users/'.fun::getCookie('mcr_x_aswq_2').'/photos/', $file->getClientOriginalName());
            $path = Storage::putFileAs('/users/'.fun::getCookie('mcr_x_aswq_2').'/photos', new File('/users/'.fun::getCookie('mcr_x_aswq_2').'/photos/'.$file->getClientOriginalName()), 'foto_profil.jpg');

            $res = $this->service->updateFotoUser($id, $file->getClientOriginalName());
            // return $res;
            if($res) return redirect('/profil');
        }
        else return redirect('/dashboard'); 
    }

    public function delete_staff(String $id1, String $id2) {
        if($this->service->deleteAccount(fun::denval($id1))) return redirect('/umkmku/detil/'.$id2); 
        else return redirect('/umkmku'); 
    }

    public function lupa_password(Request $request) {

    }
}
