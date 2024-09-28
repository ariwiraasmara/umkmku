<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Services;

use App\Repositories\transaksiRepository;
use App\Libraries\jsr;
// use App\Libraries\myfunction as fun;

class transaksiService {

    protected $repo;
    public function __construct(transaksiRepository $repo) {
        $this->repo = $repo;
    }

    public function getAll(int $id_umkm = 0, String $by = 'id_transaksi', String $orderBy = 'asc') {
        return $this->repo->getAll($id_umkm, $by, $orderBy);
    }

    //* untuk detail transaksi
    //* kompleks, karena harus menambahkan kalkulasi subtotal produk, total belanjaan, total - diskon, bla dan bla 
    public function get() {

    }

    //* kompleks juga, harus insert ke kedua tabel
    public function store(array $val1, array $val2) {
        // $id_transaksi = $this->repo->getID($val1['id_user'], $val1['id_umkm']);
        if($this->repo->store([
            'id_transaksi'   => $val1['id_transaksi'],
            'id_umkm'        => $val1['id_umkm'],
            'tgl'            => $val1['tgl'],
            'id_user'        => $val1['id_user'],
            'diskon'         => $val1['diskon'],
            'nama_pelanggan' => $val1['nama_pelanggan'],
            'uang_diterima'  => $val1['uang_diterima'],
        ])) {
            return match($this->repo->storeDetail($val2)) {
                1 => jsr::print(['pesan' => 'tambah transaksi berhasil', 'success' => 1], 'created'),
                default => jsr::print(['pesan' => 'tambah transaksi gagal', 'error' => 1], null)
            };
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