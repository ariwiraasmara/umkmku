<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Services;

use App\Repositories\aw3001_produkkuRepository;
use App\Libraries\jsr;
// use App\Libraries\myfunction as fun;

class produkkuService {

    protected $repo;
    public function __contruct(aw3001_produkkuRepository $repo) {
        $this->repo = $repo;
    }

    public function getAll(array $where, String $by = 'id_produk', String $orderBy = 'asc') {
        return $this->repo->getAll($where, $by, $orderBy);
    }

    public function get(array $where = null) {
        return $this->repo->get($where);
    }

    
    public function store(array $val) {
        return match($this->repo->store([
            'id_produk'     => $this->repo->getID($val['id_user'], $val['email']),
            'id_produk'       => $val['id_produk'],
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

    public function update(int $id_produk, array $val) {
        return match($this->repo->update(
            $id_produk, 
            [
                'nama'          => $val['nama'],
                'merk'          => $val['merk'],
                'jenis'         => $val['jenis'],
                'deskripsi'     => $val['deskripsi'],
                'harga'         => $val['harga'],
                'stok'          => $val['stok'],
                'satuan_unit'   => $val['satuan_unit'],
                'diskon'        => $val['diskon'],
            ]
        )) {
            1 => jsr::print(['pesan' => 'update produk berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'update produk gagal', 'error' => 1], null)
        };
    }

    public function delete(int $id_produk) {
        return match($this->repo->delete(['id_produk' => $id_produk])) {
            1 => jsr::print(['pesan' => 'hapus produk berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'hapus produk gagal', 'error' => 1], null)
        };
    }

}
?>