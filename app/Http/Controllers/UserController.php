<?php
// ! Copyright Syahri Ramadhan Wiraasmara (ARI)
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Services\UserServices;
use App\Libraries\jsr;
use Redirect;
use File;


class UserController extends Controller {
    //
    protected $service;

    public function __construct(UserServices $userService) {
        $this->service = $userService;
    }

    public function login() {

    }

    public function logout() {

    }

    public function register_dm(Request $request) {
        // return $request->username;
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
        return $this->service->updateProfil(
            $request->id_user,
            [
                'nama'              => $request->nama,
                'jk'                => $request->jk,
                'alamat'            => $request->alamat,
                'foto'              => $request->foto,
                'tempat_lahir'      => $request->tempat_lahir,
                'tgl_lahir'         => $request->tgl_lahir,
                'penempatan_umkm'   => $request->penempatan_umkm,
                'status'            => $request->status,
                'jabatan'           => $request->jabatan
            ]
        );
    }

    public function deleteUser(Request $request) {
        return $this->service->deleteAccount($request->id_user);
    }
}
