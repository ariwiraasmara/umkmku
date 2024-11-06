<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Services;

use App\Repositories\userRepository;
use App\Libraries\jsr;
use Illuminate\Support\Facades\Hash;
use App\Libraries\myfunction as fun;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class userService {

    protected userRepository|null $repo;
    public function __construct() {
        $this->repo = new userRepository();
    }

    public function login(string $user, $pass): array|Collection {
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

    public function getProfil(int $id): array|Collection|null {
        return $this->repo->getProfil(['users.id' => $id]);
    }

    public function getAllStaff(String $id): array|Collection|null {
        return $this->repo->getAllStaff($id, 'nama', 'asc');
    }

    public function getStaff(int $id): array|Collection|null {
        return $this->repo->getStaff($id);
    }

    public function storeAccount(string $username, string $email, string $password, $roles): JsonResponse {
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
            return match($this->repo->storeAccount([
                'username'  => $username,
                'email'     => $email, 
                'password'  => $password,
                'roles'     => $roles
            ])) {
                1 => jsr::print(['pesan' => 'insert user baru berhasil', 'success' => 1], 'created'),
                default => jsr::print(['pesan' => 'insert user baru gagal', 'error' => 3], null)
            };
        }
    }

    public function updateAccount(int $id, String $field, String $field_value): JsonResponse {
        return match($this->repo->updateAccount([
            'id' => $id,
            'field' => $field, 
            'field_values' => $field_value
        ])) {
            1 => jsr::print(['pesan' => 'update akun user berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update akun user gagal'], null)
        };
    }

    public function new_staff(array $val): JsonResponse {
        $jabatan = $val['roles'] == 3 ? 'Staff Senior' : 'Staff Junior';
        return match($this->repo->storeNewStaff(
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
        )) {
            1 => jsr::print(['pesan' => 'tambah pegawai berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'tambah pegawai gagal'], null)
        };
    }

    public function updateStaff(array $val): JsonResponse {
        // return $val;
        $jabatan = $val['roles'] == 3 ? 'Staff Senior' : 'Staff Junior';
        return match($this->repo->updateStaff([
            'id'            => $val['id'],
            'field'         => 'roles',
            'field_values'  => $val['roles']
        ],[
            'id'      => $val['id'],
            'id_umkm' => $val['id_umkm'],
            'status'  => $val['status'],
            'jabatan' => $jabatan
        ])) {
            1 => jsr::print(['pesan' => 'update pegawai berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update pegawai gagal'], null)
        };
    }

    public function updateProfil(array $val): JsonResponse {
        return match($this->repo->updateProfilUser([
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
        ])) {
            1 => jsr::print(['pesan' => 'update profil user berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update profil user gagal'], null)
        };
    }

    public function updateFotoUser(int $id, String $values): JsonResponse {
        return match($this->repo->updateFieldProfilUser([
            'id'            => $id, 
            'field'         => 'foto', 
            'field_values'  => $values
        ])) {
            1 => jsr::print(['pesan' => 'update foto user berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update foto user gagal'], null)
        };
    }

    public function deleteAccount(int $id): JsonResponse {
        if(($this->repo->deleteAccount(['id' => $id]))) return jsr::print(['pesan' => 'delete user berhasil', 'success' => 1], 'ok');
        else return jsr::print(['pesan' => 'delete user gagal', 'error' => 1], null);
    }

    public function createDir(String $username = '') {
        return $this->repo->createDir($username);
    }

    public function readDir(String $username = ''): String {
        return $this->repo->readDir($username);
    }

    public function deleteDir(String $username = '') {
        return $this->repo->deleteDir($username);
    }

    public function readFile(String $username = null, String $file = null): String {
        return $this->repo->readFile($username, $file);
    }

    public function getFile(int $id, String $username): String {
        return $this->repo->getFile($id, $username);
    }

    public function uploadFile($username, $file) {
        return $this->repo->uploadFile($username, $file);
    }

    public function getExtension(String $str = null): String {
        return $this->repo->getExtension($str);
    }
}
?>