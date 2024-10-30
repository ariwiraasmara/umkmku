<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\userService;
use App\Libraries\myfunction as fun;

class ProcessUserController extends Controller {
    //

    protected $service;
    public function __construct(userService $service) {
        $this->service = $service;
    }

    public function login(Request $request) {
        $data = $this->service->login($request->user, $request->password);
        // return $data;
        if($data['success'] == 1) {
            fun::setCookie([
                'islogin'      => 1,
                "mcr_x_aswq_1" => $data['data'][0]['id'],
                "mcr_x_aswq_2" => $data['data'][0]['username'],
                "mcr_x_aswq_3" => $data['data'][0]['email'],
                "mcr_x_aswq_4" => $data['data'][0]['roles'],
                // "mcr_x_aswq_5" => $data['success'][0]['remember_token'],
            ], true, 1, 24, 60, 60);

            return redirect('dashboard');
        }
    }

    public function logout(Request $request) {
        fun::setCookieOff('islogin');
        fun::setCookieOff('mcr_x_aswq_1');
        fun::setCookieOff('mcr_x_aswq_2');
        fun::setCookieOff('mcr_x_aswq_3');
        fun::setCookieOff('mcr_x_aswq_4');
        return redirect('login');
    }

    public function daftar_pengguna_baru(Request $request) {
        $res = $this->service->storeAccount(
            $request->username,
            $request->email,
            $request->password,
            2
        );
        if($res) return redirect('/login');
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
        $res = $this->service->new_staff([
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => $request->password,
            'roles'     => $request->roles,
            'nama'      => $request->nama,
            'id_umkm'   => $id,
        ]);
        // return $res;
        if($res) return redirect('/umkmku/detil/'.$id); 
        else return redirect('/umkmku'); 
    }

    public function update_staff(Request $request, int $id) {
        // int $id, String $field, String $field_value
        $res = $this->service->updateStaff([
            'id'      => $id,
            'id_umkm' => $request->id_umkm,
            'roles'   => $request->roles,
            'status'  => $request->status
        ]);
        // return $res;
        if($res) return redirect('/staff/detil/'.$id); 
        else return redirect('/umkmku'); 
    }

    public function update_userpassword(Request $request, int $id) {
        $res = $this->service->updateAccount($id, 'password', Hash::make($request->password));
        if($res) return redirect('/profil'); 
        else return redirect('/dashboard'); 
    }

    public function update_userfoto(Request $request, int $id) {
        $res = $this->service->updateFotoUser($id, $request->foto);
        if($res) return redirect('/profil'); 
        else return redirect('/dashboard'); 
    }

    public function delete_staff(int $id1, $id2) {
        $res = $this->service->deleteAccount($id1);
        if($res) return redirect('/umkmku/detil/'.$id2); 
        else return redirect('/umkmku'); 
    }

    public function lupa_password(Request $request) {

    }
}
