<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Repositories;

use App\Interfaces\umkmkuRepositoryInterface;
use App\Models\aw2001_umkmku;
use App\Libraries\crud;
use Illuminate\Support\Collection;

class umkmkuRepository implements umkmkuRepositoryInterface {

    protected aw2001_umkmku|null $model;
    public function __construct() {
        $this->model = new aw2001_umkmku();
    }

    public function getID(int $id_user = null, string $email = null): String {
        //* Format id_umkm sebagai contoh : UMKM_fulan@felan.com-001
        $query = $this->model->where(['id' => $id_user])->orderBy('id_umkm', 'desc')->first();
        if($query) {
            $id_umkm = $query->id_umkm;
            $strpos = (int)strpos($id_umkm, "-") + 1; //? => 001
            $counter = (int)substr($id_umkm, $strpos)+1;
            return 'UMKM_'.$email.'-'.str_pad($counter, 3, "0", STR_PAD_LEFT);

        }
        else return 'UMKM_'.$email.'-001';
    }

    //? get all umkmku list berdasarkan id_user
    public function getAll(array $where = null, String $by = 'id_umkm', String $orderBy = 'asc'): array|Collection|String|int|null {
        if($this->model->where($where)->first()) return $this->model->where($where)->orderBy($by, $orderBy)->get();
        else return 0;
    }

    //? get one umkm detail
    public function get(array $where = null): array|Collection|String|int|null {
        if($this->model->where($where)->first()) return $this->model->where($where)->get();
        else return 0;
    }

    public function store(array $val = null): String|int {
        if(!empty(crud::procumkmku(1, $val))) return 1;
        else return 0;
    }

    public function update(array $val = null): String|int {
        if(crud::procumkmku(2, $val)) return 1;
        else return 0;
    }

    public function delete(array $val = null): String|int {
        if(crud::procumkmku(3, $val) ) return 1;
        else return 0;
    }
}
?>