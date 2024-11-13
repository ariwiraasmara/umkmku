<?php
// ! Copyright Syahri Ramadhan Wiraasmara (ARI)
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Services\userService;
use App\Services\umkmkuService;
use App\Services\transaksiService;
use App\Libraries\jsr;
use App\Libraries\myfunction as fun;
// use File;
class UserController extends Controller {
    //

    protected userService $service;
    protected umkmkuService $serviceUMKM;
    protected transaksiService $serviceTransaksi;
    public function __construct(userService $service,
                                umkmkuService $serviceUMKM,
                                transaksiService $serviceTransaksi
    ) {
        $this->service = $service;
        $this->serviceUMKM = $serviceUMKM;
        $this->serviceTransaksi = $serviceTransaksi;
    }

    public function hello() {
        return 'hello from UserController';
    }

    public function login(Request $request): JsonResponse {
        $data = $this->service->login($request->user, $request->password);
        // return $data;
        if($data['success']) {
            fun::setCookie([
                'islogin'      => 1,
                "mcr_x_aswq_1" => $data['data'][0]['id'],
                "mcr_x_aswq_2" => $data['data'][0]['username'],
                "mcr_x_aswq_3" => $data['data'][0]['email'],
                "mcr_x_aswq_4" => $data['data'][0]['roles'],
            ], true, 1, 24, 60, 60, '9002-idx-umkmku-1726831788791.cluster-a3grjzek65cxex762e4mwrzl46.cloudworkstations.dev');

            return jsr::print([
                'pesan' => 'Yehaa! Berhasil Login!', 
                'success' => 1
            ]);
        }

        return match($data->get('error')){
            1 => new JsonResponse(
                ['pesan' => 'Username / Email Salah!', 'error'=> 1],
                JsonResponse::HTTP_BAD_REQUEST,
            ),
            2 => new JsonResponse(
                ['pesan' => 'Password Salah!', 'error'=> 2],
                JsonResponse::HTTP_BAD_REQUEST,
            ),
            default => new JsonResponse(
                ['pesan' => 'Terjadi Kesalahan!', 'error'=> -1],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
            )
        };
    }

    public function logout(): JsonResponse {
        $domain = '9002-idx-umkmku-1726831788791.cluster-a3grjzek65cxex762e4mwrzl46.cloudworkstations.dev';
        Auth::logout();
        fun::setCookieOff('islogin', true, $domain);
        fun::setCookieOff('mcr_x_aswq_1', true, $domain);
        fun::setCookieOff('mcr_x_aswq_2', true, $domain);
        fun::setCookieOff('mcr_x_aswq_3', true, $domain);
        fun::setCookieOff('mcr_x_aswq_4', true, $domain);
        return new JsonResponse(
            ['msg' => 'Akhirnya Logout! ', 'success' => 1],
            status: JsonResponse::HTTP_OK,
        );
    }

    public function dashboard(): JsonResponse {
        // $data_user = $this->service->getProfil(fun::getCookie("mcr_x_aswq_1"));
        // $data_transaksi = $this->serviceTransaksi->getDashboard(['aw4001_transaksi.id_umkm' => $data_user[0]['id_umkm']], 'tgl', 'desc');
        $data_user = null; 
        $data_transaksi = null;

        if(Cache::has('page_dashboard_datauser-'.fun::getCookie('mcr_x_aswq_1'))) $data_user = Cache::get('page_dashboard_datauser-'.fun::getCookie('mcr_x_aswq_1'));
        else {
            Cache::put('page_dashboard_datauser-'.fun::getCookie('mcr_x_aswq_1'), $this->service->getProfil(fun::getCookie("mcr_x_aswq_1")), 1*24*60*60);
            $data_user = Cache::get('page_dashboard_datauser-'.fun::getCookie('mcr_x_aswq_1'));
        }

        if(Cache::has('page_dashboard_datatransaksi-'.fun::getCookie('mcr_x_aswq_1'))) $data_transaksi = Cache::get('page_dashboard_datatransaksi-'.fun::getCookie('mcr_x_aswq_1'));
        else {
            Cache::put('page_dashboard_datatransaksi-'.fun::getCookie('mcr_x_aswq_1'), $this->serviceTransaksi->getDashboard(['aw4001_transaksi.id_user' => fun::getCookie("mcr_x_aswq_1")], 'tgl', 'desc'), 1*24*60*60);
            $data_transaksi = Cache::get('page_dashboard_datatransaksi-'.fun::getCookie('mcr_x_aswq_1'));
        }
        
        return jsr::print([
            'pesan'          => 'Halaman Dashboard', 
            'success'        => 1,
            'data_transaksi' => $data_transaksi,
        ]);
    }

    public function profil(): JsonResponse {
        $data = $this->service->getProfil(fun::getCookie('mcr_x_aswq_1'));
        return jsr::print([
            'pesan'     => 'Halaman Profil', 
            'success'   => 1,
            'data'      => $data,
        ]);
    }

    public function getStaff(int $id): JsonResponse {
        $data = $this->service->getProfil($id);
        return jsr::print([
            'pesan'     => 'Halaman Profil Pegawai : '.$data[0]['nama'], 
            'success'   => 1,
            'data'      => $data,
        ]);
    }


    public function register_dm(Request $request): JsonResponse {
        return $this->service->storeAccount(
            $request->username,
            $request->email,
            $request->password,
            2
        );
    }

    public function store_staff(Request $request): JsonResponse {
        $roles = $request->roles;
        if($roles < 3) $roles = 4;
        return $this->service->new_staff([
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => $request->password,
            'roles'     => $roles,
            'nama'      => $request->nama,
            'id_umkm'   => $request->id_umkm
        ]);
    }

    public function update_staff(Request $request): JsonResponse {
        return $this->service->updateStaff([
            'id'      => $request->id,
            'id_umkm' => $request->id_umkm,
            'roles'   => $request->roles,
            'status'  => $request->status
        ]);
    }

    public function updatePassword(Request $request) {
        return $this->service->updateAccount(
            fun::getCookie("mcr_x_aswq_1"),
            'password',
            Hash::make($request->password)
        );
    }

    public function updateTelpon(Request $request): JsonResponse {
        return $this->service->updateAccount(
            fun::getCookie("mcr_x_aswq_1"),
            'tlp',
            $request->tlp
        );
    }

    public function updateProfil(Request $request): JsonResponse {
        return $this->service->updateProfil([
            'id'            => fun::getCookie('mcr_x_aswq_1'),
            'nama'          => $request->nama,
            'jk'            => $request->jk,
            'alamat'        => $request->alamat,
            'tempat_lahir'  => $request->tempat_lahir,
            'tgl_lahir'     => $request->tgl_lahir,
            'id_umkm'       => $request->id_umkm,
            'status'        => $request->status,
            'jabatan'       => $request->jabatan
        ]);
    }

    public function deleteUser($id): JsonResponse {
        return $this->service->deleteAccount($id);
    }
}
