<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Services;

use App\Repositories\transaksiRepository;
use App\Libraries\jsr;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use App\Libraries\myfunction as fun;
use Exception;

class transaksiService {

    protected transaksiRepository|null $repo;
    public function __construct() {
        $this->repo = new transaksiRepository();
    }

    public function getAll(String $id_umkm, String $by = 'id_transaksi', String $orderBy = 'asc'): array|Collection|null {
        return $this->repo->getAll(['id_umkm' => $id_umkm], $by, $orderBy);
    }

    //* untuk detail transaksi
    //* kompleks, karena harus menambahkan kalkulasi subtotal produk, total belanjaan, total - diskon, bla dan bla 
    public function get(String $id_transaksi): array|Collection|String|int|null {
        $data = $this->repo->get(['no_nota' => $id_transaksi]);
        $data_detail = $this->repo->getDetail($data[0]['id_transaksi']);
        $inc = 0;
        $subtotal = 0;
        $subtotalminusdiskon = 0;
        $sub = 0;
        foreach($data_detail as $dd) {
            $subtotal = $dd->harga * $dd->jumlah_dibeli;
            $subtotalminusdiskon = $subtotal - $dd->diskon;
            $sub = $sub + $subtotalminusdiskon;
            $dd->subtotal = $subtotalminusdiskon;
            $inc++;
        }
        $totalakhir = $sub - $data[0]['diskon'];
        $uangkembalian = $data[0]['uang_diterima'] - $totalakhir;
        // $jumlah = array_sum($data->harga_produk_akhir);
        return collect([
            'data'              => $data,
            'detail_transaksi'  => $data_detail,
            'sub_total_produk'  => $sub,
            'totalakhir'        => $totalakhir,
            'uangkembalian'     => $uangkembalian
        ]);
    }

    public function getDashboard(array $where = null, String $by = 'tgl', String $orderBy = 'desc'): array|Collection|null {
        return $this->repo->getDashboard($where, $by, $orderBy);
    }

    public function getDetailHarian(String $id, String $tgl) {
        return $this->repo->getDetailHarian($id, $tgl);
    }

    //* kompleks juga, harus insert ke kedua tabel
    public function store(array $val1, array $val2) {
        $no_nota = $this->repo->generateNomorNota(fun::getCookie('mcr_x_aswq_1'));
        $id_transaksi = $this->repo->getID(fun::getCookie('mcr_x_aswq_1'), fun::getCookie('mcr_x_aswq_3'));
        if($this->repo->store([
            'id_transaksi'   => $id_transaksi,
            'no_nota'        => $no_nota,
            'id_umkm'        => $val1['id_umkm'],
            'id_user'        => fun::getCookie('mcr_x_aswq_1'),
            'diskon'         => $val1['diskon'],
            'nama_pelanggan' => $val1['nama_pelanggan'],
            'uang_diterima'  => $val1['uang_diterima'],
        ])) {
            $res = 0;
            for($x = 0; $x < count($val2['id_produk']); $x++) {
                $this->repo->storeDetail([
                    'id_detailtransaksi' => $this->repo->getIDDetail($id_transaksi, (int)$x+1),
                    'id_transaksi'       => $id_transaksi,
                    'id_produk'          => $val2['id_produk'][$x],
                    'jumlah'             => $val2['jumlah'][$x],
                ]);
                $res++;
            }

            if($res > 0) return jsr::print(['pesan' => 'tambah transaksi berhasil', 'success' => 1], 'created');
            else return jsr::print(['pesan' => 'tambah transaksi gagal', 'error' => 1], null);
        }
        else return jsr::print(['pesan' => 'tambah transaksi gagal', 'error' => 2], null);
    }

    public function delete(String $id_transaksi) {
        return match($this->repo->delete(['id_transaksi' => $id_transaksi])) {
            1 => jsr::print(['pesan' => 'hapus transaksi berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'hapus transaksi gagal', 'error' => 1], null)
        };
    }
}
?>