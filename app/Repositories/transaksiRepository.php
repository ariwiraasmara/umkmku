<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Repositories;

use App\Interfaces\transaksiRepositoryInterface;
use App\Models\aw4001_transaksi;
use App\Libraries\crud;

class transaksiRepository implements transaksiRepositoryInterface {

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
    public function getAll(array $where = null, String $by = 'id_transaksi', String $orderBy = 'asc') {
        $res = $this->model->where($where);
        if($res->first()) return $res->orderBy($by, $orderBy)->getAll();
        else return null;
    }

    public function get(array $where = null) {
        $res = $this->model->where($where);
        if($res->first()) return $res->get();
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

            //* | id_detailtransaksi | input_by | tgl | nama_pelanggan | produk | merk | harga | produk_diskon | jumlah_dibeli | satuan_unit | diskon | harga_produk_akhir |
            //? hasilnya jika id_transaksi = transaksi1, sebagai contoh :
            // detailtransaksi1 | fulan | 2024-09-28 | fulani | Bakso Kikil | Warung Fulan | 10000 | 0 | 1 | porsi | 0 | 1000 | 9000 |
            // detailtransaksi2 | fulan | 2024-09-28 | fulani | Bakso Daging | Warung Fulan | 12000 | 2000 | 1 | porsi | 0 | 10000 |
            // detailtransaksi3 | fulan | 2024-09-28 | fulano | Bakso Ikan | Warung Fulan | 15000 | 2000 | 3 | porsi | 1000 | 39000 |
            $res->select(
                'aw4002_detailtransaksi.id_detailtransaksi', 'aw4001_transaksi.id_user', 
                'aw1002_userprofil.nama as input_by', 'aw4001_transaksi.tgl', 'aw4001_transaksi.nama_pelanggan',
                'aw3001_produkku.nama as produk', 'aw3001_produkku.merk', 
                'aw3001_produkku.harga', 'aw3001_produkku.diskon as produk_diskon', 
                'aw4002_detailtransaksi.jumlah as jumlah_dibeli', 'aw3001_produkku.satuan_unit', 
                'aw3001_produkku.stok', 'aw4001_transaksi.diskon',
                '((aw3001_produkku.harga - aw3001_produkku.diskon) * aw4002_detailtransaksi.jumlah) - aw4001_transaksi.diskon as harga_produk_akhir',
            )
            ->join('aw4001_transaksi', 'aw4001_transaksi.id_transaksi', '=', 'aw4002_detailtransaksi.id_transaksi')
            ->join('aw4001_transaksi', 'aw4001_transaksi.id_user', '=', 'users.id')
            ->join('aw4002_detailtransaksi', 'aw4002_detailtransaksi.id_produk', '=', 'aw3001_produkku.id_produk')
            ->orderBy('id_detailtransaksi', 'asc');
            return $res->getAll();
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