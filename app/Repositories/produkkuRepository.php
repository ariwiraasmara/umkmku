<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Repositories;

use App\Interfaces\produkkuRepositoryInterface;
use App\Models\aw3001_produkku;
use App\Libraries\crud;

class produkkuRepository implements produkkuRepositoryInterface {

    protected $model;
    public function __construct(aw3001_produkku $model) {
        $this->model = $model;        
    }

    public function getID(int $id_user, string $email): String {
        //* Format id_produk sebagai contoh : Produk@UMKM_fulan@felan.com-001
        $query = $this->model->where(['id_user' => $id_user])->orderBy('id_umkm', 'desc')->first();
        if($query) {
            $id_umkm = $query->id_umkm;
            $strpos = (int)strpos($id_umkm, "-") + 1; //? => 001
            $counter = (int)substr($id_umkm, $strpos)+1;
            return 'Produk@UMKM_'.$email.'-'.str_pad($counter, 3, "0", STR_PAD_LEFT);

        }
        else return 'Produk@UMKM_'.$email.'-001';
    }

    //? get all produk based on id_umkm
    public function getAll(array $where, String $by = 'id_produk', String $orderBy = 'asc') {
        if($this->model->where()->orderBy($by, $orderBy)->first()) return $this->model->orderBy($by, $orderBy)->getAll();
        return null;
    }

    //? get produk detail by id_produk
    public function get(array $where = null) {
        $res = $this->model->where($where);
        if($res->first()) return $res->get();
        return null;
    }

    public function store(array $val): int {
        // return implode($val);
        // return crud::procuser(1, $val);
        if(crud::procprodukku(1, $val) > 0) return 1;
        else return 0;
    }

    public function update(array $val): int {
        if(crud::procprodukku(2, $val)) return 1;
        else return 0;
    }

    public function delete(array $val): int {
        if(crud::procprodukku(3, $val)) return 1;
        else return 0;
    }
}
?>