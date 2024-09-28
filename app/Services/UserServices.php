<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Services;

use App\Repositories\UserRepositories;
use App\Libraries\jsr;
use App\Libraries\myfunction as fun;

class userServices {

    protected $repo;
    public function __construct(UserRepositories $repo) {
        $this->repo = $repo;
    }

    public function login(string $user, $pass) {
        $where = array('username' => $user, 'email' => $user);
        $cekUser = $this->repo->get($where);
            
        if( is_null($cekUser) ) return collect(['error'=>1]); //'Wrong Username / Email';
        if( !($pass == fun::decrypt($cekUser[0]['password'])) ) return collect(['error'=>2]); //'Wrong Password!';

        return collect(['success' => $this->repo->get($where)]);
    }

    public function getProfil(int $id) {
        return $this->repo->getProfil(['id' => $id]);
    }

    public function getStaffUMKM(int $id_umkm, string $by = null, string $orderBy = null) {
        return $this->repo->get(
            ['penempatan_umkm' => $id_umkm], 
            $by, 
            $orderBy
        );
    }

    public function storeAccount(string $username, string $email, string $password, $roles) {
        // return 'in service username : '. $username;
        if($this->repo->get(['username' => $username])) {
            if($this->repo->get(['email' => $email])) {
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
            return jsr::print(['pesan' => 'Email Sudah Terdaftar!', 'error' => 2]);
        }
        return jsr::print(['pesan' => 'Username Sudah Terdaftar!', 'error' => 1]);        
    }

    public function updateAccount(int $id, String $field, String $field_value) {
        $res = $this->repo->updateAccount($id, ['field' => $field, 'field_value' => $field_value]);

        return match($res) {
            1 => jsr::print(['pesan' => 'update akun user berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update akun user gagal', 'hasil'=>$res], null)
        };
    }

    public function updateProfil(int $id, array $val) {
        $res = $this->repo->updateProfilUser(
            $id, 
            [
                'nama'              => $val['nama'],
                'jk'                => $val['jk'],
                'alamat'            => $val['alamat'],
                'foto'              => $val['foto'],
                'tempat_lahir'      => $val['tempat_lahir'],
                'tgl_lahir'         => $val['tgl_lahir'],
                'penempatan_umkm'   => $val['penempatan_umkm'],
                'status'            => $val['status'],
                'jabatan'           => $val['jabatan']
            ]
        );

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