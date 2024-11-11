<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Services;

use App\Repositories\userRepository;
use App\Repositories\umkmkuRepository;
use App\Repositories\produkkuRepository;
use App\Repositories\transaksiRepository;
use App\Libraries\jsr;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use App\Libraries\myfunction as fun;

class umkmkuService {

    protected umkmkuRepository|null $repo;
    protected userRepository|null $repo_user;
    protected produkkuRepository|null $repo_produk;
    protected transaksiRepository|null $repo_transaksi;
    
    public function __construct() {
        $this->repo = new umkmkuRepository();
        $this->repo_user = new userRepository();
        $this->repo_produk = new produkkuRepository();
        $this->repo_transaksi = new transaksiRepository();
    }

    public function getAll(array $where = null, String $by = 'id_umkm', String $orderBy = 'asc'): array|Collection|String|int|null {
        return $this->repo->getAll($where, $by, $orderBy);
    }

    public function get(array $where = null): array|Collection|String|int|null {
        return $this->repo->get($where);
    }


    public function getAllDetail(String $id = null): array|Collection|String|int|null {
        $where = ['id_umkm' => $id];
        $data_umkm = $this->repo->get($where);
        $data_produk = $this->repo_produk->getAll(
            $where, 
            'nama', 
            'asc'
        );
        $data_transaksi = $this->repo_transaksi->getAll(
            $where, 
            'tgl', 
            'desc'
        );
        $data_pegawai = $this->repo_user->getAllStaff(
            $id,
            'nama', 
            'asc'
        );

        return collect([
            'data_umkm'      => $data_umkm,
            'data_pegawai'   => $data_pegawai,
            'data_produk'    => $data_produk,
            'data_transaksi' => $data_transaksi
        ]);
    }

    public function getFotoUmkm(String $username = null): String {
        return $this->repo_user->readDir($username).'/foto_umkm.png';
    }

    public function getLogoUmkm(String $username = null): String {
        return $this->repo_user->readDir($username).'/logo_umkm.png';
    }

    public function store(array $val = null): JsonResponse {
        return match($this->repo->store([
            'id_umkm'       => $this->repo->getID(fun::getCookie('mcr_x_aswq_1'), fun::getCookie('mcr_x_aswq_2')),
            'id_user'       => fun::getCookie('mcr_x_aswq_1'),
            'nama_umkm'     => $val['nama_umkm'],
            'tgl_berdiri'   => $val['tgl_berdiri'],
            'jenis_usaha'   => $val['jenis_usaha'],
            'deskripsi'     => $val['deskripsi'],
            'no_tlp'        => $val['no_tlp'],
            'logo_umkm'     => $val['logo_umkm'],
            'foto_umkm'     => $val['foto_umkm'],
            'alamat'        => $val['alamat'],
            'longitude'     => $val['longitude'],
            'latitude'      => $val['latitude'],
        ])) {
            1 => jsr::print(['pesan' => 'tambah umkm baru berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'tambah umkm baru gagal', 'error' => 1], null)
        };
    }

    public function update(array $val = null): JsonResponse {
        return match($this->repo->update([
            'id_umkm'     => $val['id_umkm'],
            'nama_umkm'   => $val['nama_umkm'],
            'tgl_berdiri' => $val['tgl_berdiri'],
            'jenis_usaha' => $val['jenis_usaha'],
            'deskripsi'   => $val['deskripsi'],
            'no_tlp'      => $val['no_tlp'],
            'logo_umkm'   => $val['logo_umkm'],
            'foto_umkm'   => $val['foto_umkm'],
            'alamat'      => $val['alamat'],
            'longitude'   => $val['longitude'],
            'latitude'    => $val['latitude'],
        ])) {
            1 => jsr::print(['pesan' => 'update umkm berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'update umkm gagal', 'error' => 1], null)
        };
    }

    public function delete(String $id_umkm = null): JsonResponse {
        return match($this->repo->delete(['id_umkm' => $id_umkm])) {
            1 => jsr::print(['pesan' => 'hapus umkm berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'hapus umkm gagal', 'error' => 1], null)
        };
    }

    //? DATA PRODUK NUMPANG DULU DISINI
    public function getAllProduk(array $where = null, String $by = 'id_umkm', String $orderBy = 'asc'): array|Collection|String|int|null {
        return $this->repo_produk->getAll($where, $by, $orderBy);
    }

    public function getProduk(array $where = null): array|Collection|String|int|null {
        return $this->repo_produk->get($where);
    }

    public function storeProduk(array $val = null): JsonResponse {
        return match($this->repo_produk->store([
            'id_produk'     => $this->repo_produk->getID($val['id_umkm']),
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

    public function updateProduk(array $val = null): JsonResponse {
        return match($this->repo_produk->update([
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

    public function deleteProduk(String $id_produk = null): JsonResponse {
        return match($this->repo_produk->delete(['id_produk' => $id_produk])) {
            1 => jsr::print(['pesan' => 'hapus produk berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'hapus produk gagal', 'error' => 1], null)
        };
    }
    
}
?>