<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Repositories;

use App\Interfaces\userRepositoryInterface;
use App\Models\User;
use App\Models\aw1002_userprofil;
use App\Libraries\crud;
use Illuminate\Support\Collection;

class userRepository implements userRepositoryInterface {

    protected $model;
    protected $model2;
    public function __construct() {
        $this->model = new User();
        $this->model2 = new aw1002_userprofil();
    }

    //? get all user list
    //! dipakai untuk admin, direktur/manager
    // saat direktur/manager login, parameter where adalah penempatan_umkm = id_umkm
    public function getAll(String $by = 'id', String $orderBy = 'asc', array $where = null): array|Collection|null {
        $res = $this->model->join('aw1002_userprofil', 'aw1002_userprofil.id', '=', 'users.id');
        if($res->orderBy($by, $orderBy)->first()) {
            $res->select(
                'users.id', 'users.username', 'aw1002_userprofil.id_umkm', 'users.email', 
                'aw1002_userprofil.nama', 'aw1002_userprofil.foto',
                'aw1002_userprofil.status', 'aw1002_userprofil.jabatan',
            )->orderBy($by, $orderBy);

            if(is_null($where) || empty($where)) return $res->get();
            else return $res->where($where)->get();
            // return $res->where($where)->get();
        }
        return null;
    }

    public function getAllStaff(String $id, String $by = 'nama', String $orderBy = 'asc'): array|Collection|null {
        if($this->model2->where(['id_umkm' => $id])->first()) return $this->model2->where(['id_umkm' => $id])->orderBy($by, $orderBy)->get();
        return null;
    }

    //? get user
    public function get(array $where): array|Collection|null {
        if($this->model->where($where)->first()) return $this->model->where($where)->get();
        return null;
    }

    //? get staff user
    public function getStaff(int $id = null): array|Collection|null {
        $where = ['users.id' => $id];
        if($this->model->where($where)->first()) {
            $res = $this->model->where($where);
            $res->select('users.id', 'users.username', 'users.email', 
                         'users.tlp', 'users.roles',
                         'aw1002_userprofil.nama', 'aw1002_userprofil.jk', 
                         'aw1002_userprofil.alamat', 'aw1002_userprofil.foto',
                         'aw1002_userprofil.tempat_lahir', 'aw1002_userprofil.tgl_lahir',
                         'aw1002_userprofil.id_umkm', 
                         'aw1002_userprofil.status', 'aw1002_userprofil.jabatan',
                         'aw2001_umkmku.nama_umkm',
                        )
                ->join('aw1002_userprofil', 'aw1002_userprofil.id', '=', 'users.id')
                ->join('aw2001_umkmku', 'aw2001_umkmku.id_umkm', '=', 'aw1002_userprofil.id_umkm');
            return $res->get();
        }
        else return null;
    }

    //? get user profil
    public function getProfil(array $where = null): array|Collection|null {
        // $res = $this->model->where($where);
        if($this->model->where($where)) {
            return $this->model->where($where)->select(
                'users.id', 'users.username', 'users.email', 'users.tlp', 'users.password', 'users.roles',
                'aw1002_userprofil.nama', 'aw1002_userprofil.jk', 'aw1002_userprofil.alamat', 'aw1002_userprofil.foto',
                'aw1002_userprofil.tempat_lahir', 'aw1002_userprofil.tgl_lahir', 'aw1002_userprofil.id_umkm',
                'aw1002_userprofil.status', 'aw1002_userprofil.jabatan',
            )
            ->join('aw1002_userprofil', 'aw1002_userprofil.id', '=', 'users.id')
            ->get();
            return $res;
        }
        return null;
    }

    public function storeAccount(array $val): String|int {
        // return implode($val);
        // return crud::procuser(1, $val);
        $res1 = crud::procuser(1, $val);
        if($res1 > 0) {
            if(crud::procuserprofil(1, ['id' => $res1])) return 1;
            else return 'er02';
        }
        else return 'er01';
    }

    public function updateAccount(array $val): int {
        if(crud::procuser(2, $val)) return 1;
        else return 0;
    }

    public function deleteAccount(array $val): int {
        if(crud::procuser(3, $val)) return 1;
        else return 0;
    }

    public function storeNewStaff(array $val1, array $val2): String|int {
        $res1 = crud::procuser(1, $val1);
        if($res1 > 0) {
            if(crud::procuserprofil(3, [
                'id' => $res1, 
                'nama' => $val2['nama'],
                'id_umkm' => $val2['id_umkm'],
                'status'  => $val2['status'],
                'jabatan' => $val2['jabatan']
            ])) return 1;
            else return 'er02';
        }
        else return 'er01';
    }

    public function updateStaff(array $val1, array $val2): int {
        if(crud::procuser(2, $val1) && crud::procuserprofil(4, $val2)) return 1;
        else return 0;
    }

    public function updateProfilUser(array $val): int {
        if(crud::procuserprofil(2, $val)) return 1;
        else return 0;
    }

    public function updateFieldProfilUser(array $val): int {
        if(crud::procuserprofil(5, $val)) return 1;
        else return 0;
    }

    public function deleteProfilUser(array $val): int {
        if(crud::procuserprofil(4, $val)) return 1;
        else return 0;
    }
}
?>