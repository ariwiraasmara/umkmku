<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Services;

use App\Repositories\userRepository;
use App\Libraries\jsr;
use Illuminate\Support\Facades\Hash;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;

class userService {

    protected $repo;
    public function __construct(userRepository $repo) {
        $this->repo = $repo;
    }

    public function login(string $user, $pass) {
        $where = array([
            ['username' => $user],
            'or',
            ['email' => $user]
        ]);
        $cekUser = $this->repo->get($where);
            
        if( is_null($cekUser) ) return jsr::print(['error' => 1]); //'Wrong Username / Email';
        if (!Hash::check($pass, $cekUser[0]['password'])) return jsr::print(['error' => 2]); //'Wrong Password!';
        // if( !($pass == fun::decrypt($cekUser[0]['password'])) ) return jsr::print(['error' => 2]); //'Wrong Password!';
        // return 'ok';
        return collect([
            'pesan' => 'Berhasil Login!', 
            'success' => 1,
            'data' => $this->repo->getProfil($where)
        ], 'ok');
    }

    public function getProfil(int $id) {
        return jsr::print([
            'pesan' => 'Profil User!', 
            'success' => 1,
            'data' => $this->repo->getProfil(['id' => $id])
        ], 'ok');
    }

    public function storeAccount(string $username, string $email, string $password, $roles) {
        // return 'in service username : '. $username;
        if($this->repo->get(['username' => $username])) {
            if($this->repo->get(['email' => $email])) {
                
                return jsr::print([
                    'pesan' => 'Email Sudah Terdaftar!', 
                    'error' => 2
                ]);
            }
            return jsr::print([
                'pesan' => 'Username Sudah Terdaftar!', 
                'error' => 1
            ]);        
        }
        else {
            $res = $this->repo->storeAccount(
                [
                    'username'  => $username,
                    'email'     => $email, 
                    'password'  => $password,
                    'roles'     => $roles
                ]
            );
    
            return match($res) {
                1 => jsr::print(['pesan' => 'insert user baru berhasil', 'success' => 1], 'created'),
                default => jsr::print(['pesan' => 'insert user baru gagal', 'error' => 3], null)
            };
        }
    }

    public function updateAccount(int $id, String $field, String $field_value) {
        $res = $this->repo->updateAccount([
            'id' => $id,
            'field' => $field, 
            'field_value' => $field_value
        ]);

        return match($res) {
            1 => jsr::print(['pesan' => 'update akun user berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update akun user gagal', 'hasil'=>$res], null)
        };
    }

    public function updateProfil(array $val) {
        $res = $this->repo->updateProfilUser([
            'id'              => $val['id'],
            'nama'            => $val['nama'],
            'jk'              => $val['jk'],
            'alamat'          => $val['alamat'],
            'foto'            => $val['foto'],
            'tempat_lahir'    => $val['tempat_lahir'],
            'tgl_lahir'       => $val['tgl_lahir'],
            'penempatan_umkm' => $val['penempatan_umkm'],
            'status'          => $val['status'],
            'jabatan'         => $val['jabatan']
        ]);

        return match($res) {
            1 => jsr::print(['pesan' => 'update profil user berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update profil user gagal', 'hasil'=>$res], null)
        };
    }

    public function deleteAccount(int $id) {
        $where = array('id' => $id);
        if(($this->repo->deleteAccount($where) == 1) && ($this->repo->deleteProfilUser($where) == 1)) jsr::print(['pesan' => 'delete user berhasil', 'success' => 1], 'ok');
        else jsr::print(['pesan' => 'delete user gagal', 'error' => 1], null);
    }
}
?>