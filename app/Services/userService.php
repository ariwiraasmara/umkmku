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

    public function login(String $user = null, String $pass = null): array|Collection {
        $where = array('username' => $user);
        $cekUser = $this->repo->get($where);
            
        if( is_null($cekUser) ) return collect(['pesan' => 'Username / Email Salah!', 'error' => 1]); //'Wrong Username / Email';
        if (!Hash::check($pass, $cekUser[0]['password'])) return collect(['pesan' => 'Password Salah! Silahkan Coba Lagi!', 'error' => 2]); //'Wrong Password!';
        // if( !($pass == fun::decrypt($cekUser[0]['password'])) ) return jsr::print(['error' => 2]); //'Wrong Password!';
        // return 'ok';
        return collect([
            'pesan' => 'Berhasil Login!', 
            'success' => 1,
            'data' => $this->repo->getProfil($where)
        ], 'ok');
    }

    public function getProfil(int $id = null): array|Collection|String|int|null {
        return $this->repo->getProfil(['users.id' => $id]);
    }

    public function getAllStaff(String $id = null): array|Collection|String|int|null {
        return $this->repo->getAllStaff($id, 'nama', 'asc');
    }

    public function getStaff(int $id = null): array|Collection|String|int|null {
        return $this->repo->getStaff($id);
    }

    public function storeAccount(String $username = null, String $email = null, String $password = null, int $roles = null): Collection|JsonResponse|null {
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
                1 => jsr::print(['pesan' => 'daftar user baru berhasil', 'success' => 1], 'created'),
                default => jsr::print(['pesan' => 'daftar user baru gagal', 'error' => 3], null)
            };
        }
    }

    public function updateAccount(int $id = null, String $field = null, String $field_value = null): Collection|JsonResponse|null {
        return match($this->repo->updateAccount([
            'id' => $id,
            'field' => $field, 
            'field_values' => $field_value
        ])) {
            1 => jsr::print(['pesan' => 'update akun user berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update akun user gagal'], null)
        };
    }

    public function new_staff(array $val = null): array|Collection|JsonResponse|String|int|null {
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
            1 => jsr::print(['pesan' => 'tambah pegawai berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'tambah pegawai gagal', 'data' => $res])
        };
    }

    public function updateStaff(array $val = null): Collection|JsonResponse|null {
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

    public function updateProfil(array $val = null): Collection|JsonResponse|null {
        $res = $this->repo->updateProfilUser([
            'id'            => $val['id'],
            'nama'          => $val['nama'],
            'jk'            => $val['jk'],
            'alamat'        => $val['alamat'],
            'tempat_lahir'  => $val['tempat_lahir'],
            'tgl_lahir'     => $val['tgl_lahir'],
            'id_umkm'       => $val['id_umkm'],
            'status'        => $val['status'],
            'jabatan'       => $val['jabatan']
        ]);
        return match($res) {
            1 => jsr::print(['pesan' => 'update profil user berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update profil user gagal', 'data' => $res], null)
        };
    }

    public function updateFotoUser(int $id = null, String $values = null): Collection|JsonResponse|null {
        return match($this->repo->updateFieldProfilUser([
            'id'            => $id, 
            'field'         => 'foto', 
            'field_values'  => $values
        ])) {
            1 => jsr::print(['pesan' => 'update foto user berhasil', 'success' => 1], 'ok'),
            default => jsr::print(['pesan' => 'update foto user gagal'], null)
        };
    }

    public function getFotoProfilUser(String $username = null): String {
        return $this->repo->readDir($username).'/foto_profil.png';
    }

    public function deleteAccount(int $id = null) {
        $res = $this->repo->deleteAccount(['id' => $id]);
        if($res) return jsr::print(['pesan' => 'delete user berhasil', 'success' => 1], 'ok');
        else return jsr::print(['pesan' => 'delete user gagal', 'error' => 1], null);
    }

    public function createDir(String $username = null): bool {
        return $this->repo->createDir($username);
    }

    public function readDir(String $username = null): String {
        return $this->repo->readDir($username);
    }

    public function deleteDir(String $username = null): bool {
        return $this->repo->deleteDir($username);
    }

    public function readFile(String $username = null, String $file = null): String {
        return $this->repo->readFile($username, $file);
    }

    public function getFile(int $id = null, String $username = null): String {
        return $this->repo->getFile($id, $username);
    }

    public function uploadFile($username = null, $file = null) {
        return $this->repo->uploadFile($username, $file);
    }

    public function getExtension(String $str = null): String {
        return $this->repo->getExtension($str);
    }
}
?>