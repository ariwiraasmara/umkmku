<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Repositories;

use App\Interfaces\transaksiRepositoriesInterface;
use App\Models\aw4001_transaksi;
use App\Libraries\crud;

class transaksiRepository implements transaksiRepositoriesInterface {

    protected $model;
    public function __construct(aw4001_transaksi $model) {
        $this->model = $model;
    }

    public function getID(int $id_user, string $email): String {
        //* Format id_transaksi sebagai contoh : Transaksi@UMKM_fulan@felan.com-001
        $query = $this->model->where(['id_user' => $id_user])->orderBy('id_umkm', 'desc')->first();
        if($query) {
            $id_umkm = $query->id_umkm;
            $strpos = (int)strpos($id_umkm, "-") + 1; //? => 001
            $counter = (int)substr($id_umkm, $strpos)+1;
            return 'Transaksi@UMKM_'.$email.'-'.str_pad($counter, 3, "0", STR_PAD_LEFT);

        }
        else return 'Transaksi@UMKM_'.$email.'-001';
    }

    public function getIDDetail(String $id_transaksi = null): String {
        //* Format id_transaksidetail sebagai contoh : Transaksi@UMKM_fulan@felan.com-001.001
        if($id_transaksi != null) {
            $strpos = (int)strpos($id_transaksi, ".") + 1; //? => 001
            $counter = (int)substr($id_transaksi, $strpos)+1;
            return $id_transaksi.'-'.str_pad($counter, 3, "0", STR_PAD_LEFT);

        }
        else return $id_transaksi.'-001';
    }

    //? get all transaksi list berdasarkan id_umkm
    public function getAll(int $id_umkm = 0, String $by = 'id_transaksi', String $orderBy = 'asc') {
        $res = $this->model->where(['id_umkm' => $id_umkm]);
        if($res->first()) return $res->orderBy($by, $orderBy);
        else return null;
    }

    //? get one transaksi dan detailnya
    public function getDetail(int $id_transaksi = 0) {
        $res = $this->model->where(['id_transaksi' => $id_transaksi]);
        if($res->first()) {
            // aw1002_userprofil
            // nama

            // aw3001_produkku
            // id_produk
            // id_umkm
            // nama
            // merk
            // harga
            // stok
            // diskon
            // satuan_unit

            // aw4001_transaksi
            // id_transaksi
            // id_umkm
            // tgl
            // id_user
            // diskon
            // nama_pelanggan
            // uang_diterima

            // aw4002_detailtransaksi
            // id_detailtransaksi
            // id_produk
            // jumlah

            //* | id_umkm | id_transaksi | id_detailtransaksi | input_by | tgl | nama_pelanggan | produk | merk | harga | produk_diskon | satuan_unit | jumlah_dibeli | diskon |
            //? hasilnya jika id_transaksi = transaksi1, sebagai contoh :
            // | umkm1 | transaksi1 | detailtransaksi1 | fulan | 2024-09-28 | fulani | Bakso Kikil | Warung Fulan | 10000 | 0 | porsi | 1 | 0 |
            // | umkm1 | transaksi1 | detailtransaksi2 | fulan | 2024-09-28 | fulani | Bakso Daging | Warung Fulan | 12000 | 0 | porsi | 1 | 0 |
            // | umkm1 | transaksi1 | detailtransaksi3 | fulan | 2024-09-28 | fulano | Bakso Ikan | Warung Fulan | 12000 | 0 | porsi | 3 | 0 |
            $res->select(
                'aw4001_transaksi.id_umkm', 'aw4001_transaksi.id_transaksi', 
                'aw4001_transaksi.id_user', 'aw1002_userprofil.nama as input_by', 
                'aw4001_transaksi.tgl', 'aw4001_transaksi.nama_pelanggan',
                'aw3001_produkku.nama as produk', 'aw3001_produkku.merk', 'aw3001_produkku.harga', 'aw3001_produkku.diskon as produk_diskon',
                'aw3001_produkku.stok', 'aw3001_produkku.satuan_unit', 'aw4002_detailtransaksi.jumlah as jumlah_dibeli', 'aw4001_transaksi.diskon'
            )->orderBy('id_detailtransaksi', 'asc')->getAll();
            return $res;
        }
        else return null;
    }

    public function store(array $val): int {
        // return implode($val);
        // return crud::procuser(1, $val);
        if(crud::proctransaksi(1, $val) > 0) return 1;
        else return 0;
    }

    public function storeDetail(array $val): int {
        if(crud::procdetailtransaksi(1, $val) > 0) return 1;
        else return 0;
    }

    public function delete(array $val): int {
        if(crud::procprodukku(2, $val)) return 1;
        else return 0;
    }

}
?>