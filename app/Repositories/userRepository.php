<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Repositories;

use App\Interfaces\userRepositoryInterface;
use App\Models\User;
use App\Libraries\crud;

class userRepository implements userRepositoryInterface {

    protected $model;
    public function __construct(User $model) {
        $this->model = $model;
    }

    //? get all user list
    //! dipakai untuk admin, direktur/manager
    // saat direktur/manager login, parameter where adalah penempatan_umkm = id_umkm
    public function getAll(String $by = 'id', String $orderBy = 'asc', array $where = null) {
        if($this->model->orderBy($by, $orderBy)->first()) {
            $res = $this->model->orderBy($by, $orderBy);
            $res->select(
                'users.id, users.username', 'users.email', 
                'aw1002_userprofil.nama', 'aw1002_userprofil.foto',
                'aw1002_userprofil.status', 'aw1002_userprofil.jabatan',
            )
            ->join('aw1002_userprofil', 'aw1002_userprofil.id', '=', 'users.id');

            if(is_null($where)) return $res->getAll();
            else return $res->where($where)->getAll();
        }
        return null;
    }

    //? get one user
    public function get(array $where = null) {
        $res = $this->model->where($where);
        if($res->first()) return $this->model->where($where)->get();
        else return null;
    }

    //? get one user detail
    public function getProfil(array $where = null) {
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
            // return $res;
        }
        return null;
    }

    public function storeAccount(array $val) {
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

    public function updateProfilUser(array $val): int {
        if(crud::procuserprofil(2, [$val])) return 1;
        else return 0;
        
    }

    public function deleteProfilUser(array $val): int {
        if(crud::procuserprofil(4, $val)) return 1;
        else return 0;
    }
}
?>