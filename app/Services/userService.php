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
    public function __construct() {
        $this->repo = new userRepository();
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
        return $this->repo->getProfil(['users.id' => $id]);
    }

    public function getAllStaff(String $id) {
        return $this->repo->getAllStaff($id, 'nama', 'asc');
    }

    public function getStaff(int $id) {
        return $this->repo->getStaff($id);
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
            $res = $this->repo->storeAccount([
                    'username'  => $username,
                    'email'     => $email, 
                    'password'  => $password,
                    'roles'     => $roles
            ]);
    
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
            'field_values' => $field_value
        ]);

        return match($res) {
            1 => jsr::print(['pesan' => 'update akun user berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update akun user gagal', 'hasil'=>$res], null)
        };
    }

    public function new_staff(array $val) {
        $jabatan = $val['roles'] == 3 ? 'Staff Senior' : 'Staff Junior';
        $res = $this->repo->storeNewStaff(
            [
                'username'  => $val['username'],
                'email'     => $val['email'],
                'password'  => $val['password'],
                'roles'     => $val['roles']
            ],
            [
                'nama'      => $val['nama'],
                'id_umkm'   => $val['id_umkm'],
                'status'    => 'Aktif',
                'jabatan'   => $jabatan
            ]
        );

        return match($res) {
            1 => jsr::print(['pesan' => 'tambah pegawai berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'tambah pegawai gagal', 'hasil'=>$res], null)
        };
    }

    public function updateStaff(array $val) {
        // return $val;
        $jabatan = $val['roles'] == 3 ? 'Staff Senior' : 'Staff Junior';
        $res = $this->repo->updateStaff([
            'id'            => $val['id'],
            'field'         => 'roles',
            'field_values'  => $val['roles']
        ],[
            'id'      => $val['id'],
            'id_umkm' => $val['id_umkm'],
            'status'  => $val['status'],
            'jabatan' => $jabatan
        ]);
        return match($res) {
            1 => jsr::print(['pesan' => 'update pegawai berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update pegawai gagal', 'hasil'=>$res], null)
        };
    }

    public function updateProfil(array $val) {
        $res = $this->repo->updateProfilUser([
            'id'            => $val['id'],
            'nama'          => $val['nama'],
            'jk'            => $val['jk'],
            'alamat'        => $val['alamat'],
            'foto'          => $val['foto'],
            'tempat_lahir'  => $val['tempat_lahir'],
            'tgl_lahir'     => $val['tgl_lahir'],
            'id_umkm'       => $val['id_umkm'],
            'status'        => $val['status'],
            'jabatan'       => $val['jabatan']
        ]);

        return match($res) {
            1 => jsr::print(['pesan' => 'update profil user berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update profil user gagal', 'hasil'=>$res], null)
        };
    }

    public function updateFotoUser(int $id, String $values) {
        return $this->repo->updateFieldProfilUser([
            'id'            => $id, 
            'field'         => 'foto', 
            'field_values'  => $values
        ]);

        return match($res) {
            1 => jsr::print(['pesan' => 'update foto user berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update foto user gagal', 'hasil'=>$res], null)
        };
    }

    public function deleteAccount(int $id) {
        $where = array('id' => $id);
        if(($this->repo->deleteAccount($where))) jsr::print(['pesan' => 'delete user berhasil', 'success' => 1], 'ok');
        else jsr::print(['pesan' => 'delete user gagal', 'error' => 1], null);
    }
}
?>