<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Repositories;

use App\Interfaces\transaksiRepositoryInterface;
use App\Models\aw4001_transaksi;
use App\Models\aw4002_detailtransaksi;
use App\Libraries\crud;
use Illuminate\Support\Collection;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Facades\DB;

class transaksiRepository implements transaksiRepositoryInterface {

    protected aw4001_transaksi|null $model;
    protected aw4002_detailtransaksi|null $model_detail;
    public function __construct() {
        $this->model = new aw4001_transaksi();
        $this->model_detail = new aw4002_detailtransaksi();
    }

    public function getID(int $id_user, string $email): String {
        //* Format id_transaksi sebagai contoh : Transaksi@UMKM_fulan@felan.com-001
        // 
        $query = $this->model->where(['id_user' => $id_user])->orderBy('id_umkm', 'desc')->first();
        if($query) {
            $id_umkm = $query->id_umkm;
            $strpos = (int)strpos($id_umkm, "-") + 1; //? => 001
            $counter = (int)substr($id_umkm, $strpos)+1;
            return 'Transaksi@UMKM_'.$email.'-'.str_pad($counter, 3, "0", STR_PAD_LEFT);
        }
        else return 'Transaksi@UMKM_'.$email.'-001';
    }

    public function generateNomorNota(int $id_user): String {
        return fun::random('numb', 3).$id_user.date('YmdHis');
    }

    public function getIDDetail(String $id_transaksi = null, int $x): String {
        //* Format id_transaksidetail sebagai contoh : Transaksi@UMKM_fulan@felan.com-001:001
        $query = $this->model_detail->where(['id_transaksi' => $id_transaksi])->orderBy('id_detailtransaksi', 'desc')->first();
        if($query) {
            $id_detailtransaksi = $query->id_detailtransaksi;
            $strpos = (int)strpos($id_detailtransaksi, ":") + 1; //? => 001
            $counter = (int)substr($id_detailtransaksi, $strpos)+$x;
            return $id_transaksi.':'.str_pad($counter, 3, "0", STR_PAD_LEFT);
        }
        else return $id_transaksi.':'.str_pad($x, 3, "0", STR_PAD_LEFT);
    }

    //? get all transaksi list berdasarkan id_umkm
    public function getAll(array $where = null, String $by = 'id_transaksi', String $orderBy = 'asc'): array|Collection|null {
        if($this->model->where($where)->first()) {
            return $this->model->where($where)
                        ->select('id_transaksi', 'id_umkm', 'no_nota', 'tgl')
                        ->orderBy($by, $orderBy)
                        ->get();
        }
        else return null;
    }

    public function getDashboard(array $where = null, String $by = 'tgl', String $orderBy = 'desc'): array|Collection|null {
        if($this->model->where($where)->first()) {
            return $this->model->where($where)
                        ->select('aw4001_transaksi.id_transaksi', 'aw2001_umkmku.nama_umkm', 
                                 'aw4001_transaksi.no_nota', 'aw4001_transaksi.tgl', 
                                 'aw4001_transaksi.id_user', 'aw4001_transaksi.nama_pelanggan')
                        ->orderBy($by, $orderBy)
                        ->join('aw2001_umkmku', 'aw4001_transaksi.id_umkm', '=', 'aw2001_umkmku.id_umkm')
                        ->limit(10)
                        ->get();
        }
        else return null;
    }

    public function get(array $where = null): array|Collection|String|int|null {
        if($this->model->where($where)->first()) {
            return $this->model
                    ->where($where)
                    ->join('aw2001_umkmku', 'aw4001_transaksi.id_umkm', '=', 'aw2001_umkmku.id_umkm')
                    ->join('aw1002_userprofil', 'aw4001_transaksi.id_user', '=', 'aw1002_userprofil.id')
                    ->get();
        }
        else return null;
    }

    //? get one transaksi dan detailnya
    public function getDetail(String $id_transaksi): array|Collection|String|int|null {
        if($this->model_detail->where(['aw4002_detailtransaksi.id_transaksi' => $id_transaksi])) {
            $res = $this->model_detail->where(['aw4002_detailtransaksi.id_transaksi' => $id_transaksi]);
            
            //* | id_detailtransaksi | input_by | tgl | nama_pelanggan | produk | merk | harga | produk_diskon | jumlah_dibeli | satuan_unit | diskon | harga_produk_akhir |
            //? hasilnya jika id_transaksi = transaksi1, sebagai contoh :
            // detailtransaksi1 | fulan | 2024-09-28 | fulani | Bakso Kikil | Warung Fulan | 10000 | 0 | 1 | porsi | 0 | 1000 | 9000 |
            // detailtransaksi2 | fulan | 2024-09-28 | fulani | Bakso Daging | Warung Fulan | 12000 | 2000 | 1 | porsi | 0 | 10000 |
            // detailtransaksi3 | fulan | 2024-09-28 | fulano | Bakso Ikan | Warung Fulan | 15000 | 2000 | 3 | porsi | 1000 | 39000 |
            $res->select(
                'aw4002_detailtransaksi.id_detailtransaksi', 'aw4001_transaksi.id_user', 
                'aw1002_userprofil.nama as nama_kasir', 'aw4001_transaksi.tgl', 'aw4001_transaksi.nama_pelanggan',
                'aw3001_produkku.nama as produk', 'aw3001_produkku.merk', 
                'aw3001_produkku.harga', 'aw3001_produkku.diskon as produk_diskon', 
                'aw4002_detailtransaksi.jumlah as jumlah_dibeli', 'aw3001_produkku.satuan_unit', 
                'aw3001_produkku.stok', 'aw4001_transaksi.diskon',
                // '((aw3001_produkku.harga - aw3001_produkku.diskon) * aw4002_detailtransaksi.jumlah) - aw4001_transaksi.diskon as harga_produk_akhir',
            )
            ->join('aw4001_transaksi', 'aw4002_detailtransaksi.id_transaksi', '=', 'aw4001_transaksi.id_transaksi')
            ->join('aw1002_userprofil', 'aw4001_transaksi.id_user', '=', 'aw1002_userprofil.id')
            ->join('aw3001_produkku', 'aw4002_detailtransaksi.id_produk', '=', 'aw3001_produkku.id_produk')
            ->orderBy('id_detailtransaksi', 'asc');

            return $res->get();
        }
        else return null;
    }

    public function getDetailHarian(String $id, String $tgl) {
        //whereBetween('reservation_from', [$from, $to])->get();
        $id_umkm = ['aw4001_transaksi.id_umkm' => $id];
        $from = $tgl.' 00:00:00';
        $to = $tgl.' 23:59.59';
        if($this->model->where($id_umkm)->whereBetween('aw4001_transaksi.tgl', [$from, $to])->first()) {
            // return 1;
            return DB::table('aw4002_detailtransaksi as dtr')
                        
                        ->select(
                            'tr.tgl', 
                            'tr.id_transaksi',
                            DB::table('aw4002_detailtransaksi as dtr')
                                ->sum('sum(pr.harga * dtr.jumlah) as total')
                                ->join('aw3001_produkku as pr', function ($join) {
                                    $join->on('dtr.id_produk', '=', 'pr.id_produk');
                                })
                                ->where(['tr.id_umkm' => $id])
                                ->whereBetween('tr.tgl', [$from, $to])
                        )
                        ->join('aw4001_transaksi as tr', function ($join) {
                            $join->on('dtr.id_transaksi', '=', 'tr.id_transaksi');
                        })
                        ->join('aw3001_produkku as pr', function ($join) {
                            $join->on('dtr.id_produk', '=', 'pr.id_produk');
                        })
                        // ->distinct()
                        ->orderBy('tr.tgl', 'asc')
                        // ->groupBy('tr.tgl', 'tr.id_transaksi')
                        ->get();

            // $res = $this->model_detail->where($id_umkm)->whereBetween('aw4001_transaksi.tgl', [$from, $to]);
            // $res->select(
            //     'aw4001_transaksi.tgl', 
            //     'aw4001_transaksi.id_transaksi',
            // )
            // ->sum(DB::raw('aw3001_produkku.harga * aw4002_detailtransaksi.jumlah'))
            // // ->distinct()
            // ->join('aw4001_transaksi', 'aw4002_detailtransaksi.id_transaksi', '=', 'aw4001_transaksi.id_transaksi')
            // ->join('aw3001_produkku', 'aw4002_detailtransaksi.id_produk', '=', 'aw3001_produkku.id_produk')
            // ->orderBy('aw4001_transaksi.tgl', 'asc');
            // return $res->get();
        }
        else return null;
    }

    public function store(array $val): String|int|null {
        if(crud::proctransaksi(1, $val)) return 1;
        else return 0;
    }

    public function storeDetail(array $val): String|int|null {
        if(crud::procdetailtransaksi(1, $val)) return 1;
        else return 0;
    }

    public function delete(array $val): String|int|null {
        if(crud::proctransaksi(2, $val)) return 1;
        else return 0;
    }

}
?>