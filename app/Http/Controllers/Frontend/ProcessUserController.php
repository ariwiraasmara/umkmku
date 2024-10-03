<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\userService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Facades\Http;

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
        return redirect('login');
    }

    public function daftar_pengguna_baru(Request $request) {
        $res = $this->service->storeAccount(
            $request->username,
            $request->email,
            $request->password,
            2
        );
        if(empty($res) || is_null($res)) return redirect('/daftar-pengguna-baru'); 
        else return redirect('/login');
    }

    public function lupa_password(Request $request) {

    }
}
