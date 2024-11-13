<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Repositories;

use App\Interfaces\produkkuRepositoryInterface;
use App\Models\aw3001_produkku;
use App\Libraries\crud;
use Illuminate\Support\Collection;
use Exception;

class produkkuRepository implements produkkuRepositoryInterface {

    protected aw3001_produkku|null $model;
    public function __construct() {
        $this->model = new aw3001_produkku();
    }

    public function getID(String $id_umkm = null): String {
        //* Format id_produk sebagai contoh : Produk@UMKM_fulan@felan.com-001.
        $query = $this->model->where(['id_umkm' => $id_umkm])->orderBy('id_produk', 'desc')->first();
        if($query) {
            $strpos = (int)strpos($query->id_produk, ":") + 1; //? => 001
            $counter = (int)substr($query->id_produk, $strpos)+1;
            return 'Produk'.$id_umkm.':'.str_pad($counter, 3, "0", STR_PAD_LEFT);
        }
        else return 'Produk'.$id_umkm.':001';
    }

    //? get all produk list berdasarkan id_umkm
    public function getAll(array $where = null, String $by = 'id_umkm', String $orderBy = 'asc'): array|Collection|String|int|null {
        if($this->model->where($where)->first()) {
            return $this->model->where($where)
                        ->select('id_produk', 'id_umkm', 'nama')
                        ->orderBy($by, $orderBy)
                        ->get();
        }
        else return null;
    }

    //? get one produk detail
    public function get(array $where = null): array|Collection|String|int|null {
        if($this->model->where($where)->first()) return $this->model->where($where)->get();
        else return null;
    }

    public static function store(array $val = null): String|int|null {
        if(crud::procprodukku(1, $val)) return 1;
        else return 0;
    }

    public function update(array $val = null): String|int|null {
        if(crud::procprodukku(2, $val)) return 1;
        else return 0;
    }

    public function delete(array $val = null): String|int|null {
        if(crud::procprodukku(3, $val)) return 1;
        else return 0;
    }
}
?>