<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Repositories;

use App\Interfaces\userRepositoriesInterface;
use App\Models\User;
use App\Libraries\crud;

class userRepository implements userRepositoriesInterface {

    protected $model;
    public function __construct(User $model) {
        $this->model = $model;
    }

    //? get all user list
    //! dipakai untuk admin, direktur/manager
    // saat direktur/manager login, parameter where adalah penempatan_umkm = id_umkm
    public function getAll(String $by = 'id', String $orderBy = 'asc', array $where = null) {
        $res = $this->model->orderBy($by, $orderBy);
        if($res->first()) {
            $res->select(
                'users.username', 'users.email', 
                'userprofil.nama', 'userprofil.foto',
                'userprofil.status', 'userprofil.jabatan',
            )
            ->join('userprofil', 'userprofil.id', '=', 'users.id');

            if(is_null($where)) return $res->getAll();
            return $res->where($where)->getAll();
        }
        return null;
    }

    //? get one user
    public function get(array $where = null) {
        $res = $this->model->where($where)->orWhere($where);
        if($res->first()) return $res->get();
        else return null;
    }

    //? get one user detail
    public function getProfil(array $where = null) {
        $res = $this->model->where($where);
        if($res->first()) {
            $res->select(
                'users.username', 'users.email', 'users.tlp', 'users.password', 'users.roles',
                'userprofil.nama', 'userprofil.jk', 'userprofil.alamat', 'userprofil.foto',
                'userprofil.tempat_lahir', 'userprofil.tgl_lahir', 'userprofil.penempatan_umkm',
                'userprofil.status', 'userprofil.jabatan',
            )
            ->join('userprofil', 'userprofil.id', '=', 'users.id')
            ->get();
            return $res;
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

    public function updateAccount(int $id, array $val): int {
        if(crud::procuser(2, $val)) return 1;
        else return 0;
    }

    public function deleteAccount(array $val): int {
        if(crud::procuser(3, $val)) return 1;
        else return 0;
    }

    public function updateProfilUser(int $id, array $val): int {
        if(crud::procuserprofil(2, ['id' => $id, $val])) return 1;
        else return 0;
        
    }

    public function deleteProfilUser(array $val): int {
        if(crud::procuserprofil(4, $val)) return 1;
        else return 0;
    }
}
?>