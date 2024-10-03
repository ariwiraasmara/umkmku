<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Repositories;

use App\Interfaces\produkkuRepositoryInterface;
use App\Models\aw3001_produkku;
use App\Libraries\crud;

class produkkuRepository implements produkkuRepositoryInterface {

    protected $model;
    public function __construct() {
        $this->model = new aw3001_produkku();
    }

    public function getID(int $id_umkm, string $email): String {
        //* Format id_produk sebagai contoh : Produk@UMKM_fulan@felan.com-001
        $query = $this->model->where(['id_umkm' => $id_umkm])->orderBy('id_umkm', 'desc')->first();
        if($query) {
            $id_umkm_new = $query->id_umkm;
            $strpos = (int)strpos($id_umkm_new, "-") + 1; //? => 001
            $counter = (int)substr($id_umkm_new, $strpos)+1;
            return 'Produk@UMKM_'.$email.'-'.str_pad($counter, 3, "0", STR_PAD_LEFT);

        }
        else return 'Produk@UMKM_'.$email.'-001';
    }

    //? get all produk list berdasarkan id_umkm
    public function getAll(array $where, String $by = 'id_umkm', String $orderBy = 'asc') {
        if($this->model->where($where)->first()) return $this->model->where($where)->orderBy($by, $orderBy)->get();
        else return 0;
    }

    //? get one produk detail
    public function get(array $where = null) {
        if($this->model->where($where)->first()) return $this->model->where($where)->get();
        else return 0;
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