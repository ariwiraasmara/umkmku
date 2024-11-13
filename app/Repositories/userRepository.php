<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Repositories;

use App\Interfaces\userRepositoryInterface;
use App\Models\User;
use App\Models\aw1002_userprofil;
use App\Libraries\crud;
use Illuminate\Support\Collection;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class userRepository implements userRepositoryInterface {

    protected User|null $model;
    protected aw1002_userprofil|null $model2;
    public function __construct() {
        $this->model = new User();
        $this->model2 = new aw1002_userprofil();
    }

    //? get all user list
    //! dipakai untuk admin, direktur/manager
    // saat direktur/manager login, parameter where adalah penempatan_umkm = id_umkm
    public function getAll(String $by = 'id', String $orderBy = 'asc', array $where = null): array|Collection|String|int|null {
        $res = $this->model->join('aw1002_userprofil', 'aw1002_userprofil.id', '=', 'users.id');
        if($res->orderBy($by, $orderBy)->first()) {
            $this->model->join('aw1002_userprofil', 'aw1002_userprofil.id', '=', 'users.id')->select(
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

    public function getAllStaff(String $id = null, String $by = 'nama', String $orderBy = 'asc'): array|Collection|String|int|null {
        if($this->model2->where(['id_umkm' => $id])->first()) {
            return $this->model2->where(['id_umkm' => $id])
                        ->select('id', 'nama', 'id_umkm', 'status', 'jabatan')
                        ->orderBy($by, $orderBy)
                        ->get();
        }
        return null;
    }

    public function getLogin(String $val = null): array|Collection|String|int|null {
        $where1 = ['username' => $val];
        $where2 = ['email' => $val];
        if($this->model->where($where1)->orWhere($where2)->first()) return collect($this->model->where($where1)->orWhere($where2)->first());
        return null;
    }

    //? get user
    public function get(array $where = null): array|Collection|String|int|null {
        if($this->model->where($where)->first()) return $this->model->where($where)->get();
        return null;
    }

    //? get staff user
    public function getStaff(int $id = null): array|Collection|String|int|null {
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
    public function getProfil(array $where = null): array|Collection|String|int|null {
        if($this->model->where($where)) {
            return collect($this->model->where($where)->select(
                'users.id', 'aw1002_userprofil.nama', 'users.username', 'users.email', 'users.tlp', 'users.password', 'users.roles',
                'aw1002_userprofil.jk', 'aw1002_userprofil.alamat', 'aw1002_userprofil.foto',
                'aw1002_userprofil.tempat_lahir', 'aw1002_userprofil.tgl_lahir', 'aw1002_userprofil.id_umkm',
                'aw1002_userprofil.status', 'aw1002_userprofil.jabatan',
            )
            ->join('aw1002_userprofil', 'users.id', '=', 'aw1002_userprofil.id')
            ->get());
        }
        return null;
    }

    public function storeAccount(array $val = null): String|int|null {
        $res1 = crud::procuser(1, $val);
        if($res1 > 0) {
            if(crud::procuserprofil(1, ['id' => $res1])) return 1;
            else return 'er02';
        }
        else return 'er01';
    }

    public function updateAccount(array $val = null): String|int|null {
        if(crud::procuser(2, $val)) return 1;
        else return 0;
    }

    public function deleteAccount(array $val = null) {
        $res = crud::procuser(3, $val);
        if(($res['res1'] == 1) && ($res['res2'] == 1)) return 1;
        else return 0;
    }

    public function storeNewStaff(array $val1 = null, array $val2 = null): String|int|null {
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

    public function updateStaff(array $val1 = null, array $val2 = null): String|int|null {
        if(crud::procuser(2, $val1) && crud::procuserprofil(4, $val2)) return 1;
        else return 0;
    }

    public function updateProfilUser(array $val = null): String|int|null {
        if(crud::procuserprofil(2, $val)) return 1;
        else return 0;
    }

    public function updateFieldProfilUser(array $val = null): String|int|null {
        if(crud::procuserprofil(5, $val)) return 1;
        else return 0;
    }

    public function deleteProfilUser(array $val = null): String|int|null {
        if(crud::procuserprofil(4, $val)) return 1;
        else return 0;
    }

    public function createDir(String $username = null) {
        return Storage::put($this->readDir($username).'/ff.md', 'ff.md');
        // return new File::makeDirectory($this->readDir($username).'/first.md', 0777, true, true);
        // return $this->model->createDir($username);
    }

    public function readDir(String $username = null): String {
        // path : umkmku/public/users/[username]/photos/;
        return "/users/".$username."/photos";
    }

    public function deleteDir(String $username = null): String {
        return $this->model->deleteDir($username);
    }

    public function readFile(String $username = null, String $file = null): String {
        return $this->readDir($username).$file;
    }

    public function getFile(int $id = null, String $username = null): String {
        $res = $this->model2->get(['id'=>$id]);
        return $this->readFile($username, $res[0]['foto']);
    }

    public function uploadFile($username = null, $file = null) {
        if(!File::isDirectory($this->model->readFile($username, $file))) 
            return File::makeDirectory($this->model->readFile($username, $file), 0777, true, true);
    }

    public function getExtension(String $str = null): String {
        return match($str){
            'jfif'  => 'image', 
            'pjpeg' => 'image', 
            'jpeg'  => 'image', 
            'pjp'   => 'image', 
            'jpg'   => 'image', 
            'png'   => 'image', 
            default => null
        };
    }
}
?>