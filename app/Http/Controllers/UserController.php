<?php
// ! Copyright Syahri Ramadhan Wiraasmara (ARI)
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Crypt;
use App\Services\userService;
use App\Libraries\jsr;
use App\Libraries\myfunction as fun;
// use File;
class UserController extends Controller {
    //
    protected $service;

    public function __construct(userService $service) {
        $this->service = $service;
    }

    public function login(Request $request) {
        $validated = $request->validate([
            'user'      => 'required|string',
            'passsword' => 'required|string',
        ]);

        if(!$validated) {
            // return new JsonResponse(
            //     ['msg' => 'Anda Tidak Tervalidasi!', 'error' => 1],
            //     JsonResponse::HTTP_BAD_REQUEST,
            // );
            return jsr::print([
                'pesan' => 'Anda Tidak Tervalidasi!', 
                'error' => 1
            ]);
        }

        $data = $this->service->login($request->user, $request->pass);
        if($data['success'] == 1) {
            fun::setCookie([
                'islogin'      => 1,
                "mcr_x_aswq_1" => $data['data'][0]['id'],
                "mcr_x_aswq_2" => $data['data'][0]['username'],
                "mcr_x_aswq_3" => $data['data'][0]['email'],
                // "mcr_x_aswq_5" => $data['success'][0]['remember_token'],
            ], true, 1, 24, 60, 60);

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

    public function logout() {
        fun::setCookieOff('islogin');
        fun::setCookieOff('mcr_x_aswq_1');
        fun::setCookieOff('mcr_x_aswq_2');
        fun::setCookieOff('mcr_x_aswq_3');
        return new JsonResponse(
            ['msg' => 'Akhirnya Logout! ', 'success' => 1],
            status: JsonResponse::HTTP_OK,
        );
    }


    public function register_dm(Request $request) {
        // return $request->username;
        // return 'hello register_dm';
        return $this->service->storeAccount(
            $request->username,
            $request->email,
            $request->password,
            2
        );
    }

    public function register_nondm(Request $request) {
        // return $request->username;
        return $this->service->storeAccount(
            $request->username,
            $request->email,
            $request->password,
            3
        );
    }

    public function updatePassword(Request $request) {
        return $this->service->updateAccount(
            $request->id_user,
            'password',
            $request->password
        );
    }

    public function updateTlp(Request $request) {
        return $this->service->updateAccount(
            $request->id_user,
            'tlp',
            $request->tlp
        );
    }

    public function updateProfil(Request $request) {
        return $this->service->updateProfil([
            'id'                => $request->id_user,
            'nama'              => $request->nama,
            'jk'                => $request->jk,
            'alamat'            => $request->alamat,
            'foto'              => $request->foto,
            'tempat_lahir'      => $request->tempat_lahir,
            'tgl_lahir'         => $request->tgl_lahir,
            'penempatan_umkm'   => $request->penempatan_umkm,
            'status'            => $request->status,
            'jabatan'           => $request->jabatan
        ]);
    }

    public function deleteUser(Request $request) {
        return $this->service->deleteAccount($request->id_user);
    }
}
