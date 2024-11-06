<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Services;

use App\Repositories\produkkuRepository;
use App\Libraries\jsr;
// use App\Libraries\myfunction as fun;
use Exception;

class produkkuService {

    protected $repo;
    public function __contruct() {
        $this->repo = new produkkuRepository();
    }

    public function repo() {
        return $this->repo;
    }

    public function hello() {
        return 'hello produkkuService';
    }
    
    public function getAll(array $where, String $by = 'id_umkm', String $orderBy = 'asc') {
        // return 1;
        return $this->repo->getAll($where, $by, $orderBy);
    }

    public function get(array $where = null) {
        // return jsr::print([
        //     'pesan' => 'Data Detail Produk!', 
        //     'success' => 1,
        //     'data' => $this->repo->get($where)
        // ],
        // 'ok');
        return $this->repo->get($where);
    }

    
    public function store(array $val) {
        // return 'produkkuService';
        // return $val;
        // return 10;
        // return $this->repo->hello;
        // return $val['id_umkm'];
        $this->repo->store([
            'id_produk'     => $this->repo->getID($val['id_umkm']),
            'id_umkm'       => $val['id_umkm'],
            'nama'          => $val['nama'],
            'merk'          => $val['merk'],
            'jenis'         => $val['jenis'],
            'deskripsi'     => $val['deskripsi'],
            'harga'         => $val['harga'],
            'stok'          => $val['stok'],
            'satuan_unit'   => $val['satuan_unit'],
            'diskon'        => $val['diskon'],
        ]);

        return match($this->repo->store([
            'id_produk'     => $this->repo->getID($val['id_umkm']),
            'id_umkm'       => $val['id_umkm'],
            'nama'          => $val['nama'],
            'merk'          => $val['merk'],
            'jenis'         => $val['jenis'],
            'deskripsi'     => $val['deskripsi'],
            'harga'         => $val['harga'],
            'stok'          => $val['stok'],
            'satuan_unit'   => $val['satuan_unit'],
            'diskon'        => $val['diskon'],
        ])) {
            1 => jsr::print(['pesan' => 'tambah produk baru berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'tambah produk baru gagal', 'error' => 1], null)
        };
    }

    public function update(array $val) {
        return match($this->repo->update([
            'id_produk'   => $val['id_produk'],
            'nama'        => $val['nama'],
            'merk'        => $val['merk'],
            'jenis'       => $val['jenis'],
            'deskripsi'   => $val['deskripsi'],
            'harga'       => $val['harga'],
            'stok'        => $val['stok'],
            'satuan_unit' => $val['satuan_unit'],
            'diskon'      => $val['diskon'],
        ])) {
            1 => jsr::print(['pesan' => 'update produk berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'update produk gagal', 'error' => 1], null)
        };
    }

    public function delete(String $id_produk) {
        return match($this->repo->delete(['id_produk' => $id_produk])) {
            1 => jsr::print(['pesan' => 'hapus produk berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'hapus produk gagal', 'error' => 1], null)
        };
    }

}
?>