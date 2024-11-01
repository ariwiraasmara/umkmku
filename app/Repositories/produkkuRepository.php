<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Repositories;

use App\Interfaces\produkkuRepositoryInterface;
use App\Models\aw3001_produkku;
use App\Libraries\crud;
use Exception;

class produkkuRepository implements produkkuRepositoryInterface {

    protected $model;
    public $hello = 'hello';
    public function __construct() {
        $this->model = new aw3001_produkku();
    }

    public function coba() {
        return 'hello';
    }

    public function getID(String $id_umkm) {
        //* Format id_produk sebagai contoh : Produk@UMKM_fulan@felan.com-001.
        $query = $this->model->where(['id_umkm' => $id_umkm])->orderBy('id_produk', 'desc')->first();
        if($query) {
            $strpos = (int)strpos($query->id_produk, "#") + 1; //? => 001
            $counter = (int)substr($query->id_produk, $strpos)+1;
            return 'Produk@'.$id_umkm.'#'.str_pad($counter, 3, "0", STR_PAD_LEFT);
        }
        // else return 'Produk@'.$id_umkm.'#001';
    }

    //? get all produk list berdasarkan id_umkm
    public function getAll(array $where, String $by = 'id_umkm', String $orderBy = 'asc') {
        return $this->model->where($where)->orderBy($by, $orderBy)->get();
        if($this->model->where($where)->first()) return $this->model->where($where)->orderBy($by, $orderBy)->get();
        else return 0;
    }

    //? get one produk detail
    public function get(array $where = null) {
        if($this->model->where($where)->first()) return $this->model->where($where)->get();
        else return 0;
    }

    public static function store(array $val) {
        // return implode($val);
        // return crud::procuser(1, $val);
        // return $val;
        if(crud::procprodukku(1, $val)) return 1;
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