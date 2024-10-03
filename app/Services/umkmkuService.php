<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Services;

use App\Repositories\userRepository;
use App\Repositories\umkmkuRepository;
use App\Repositories\produkkuRepository;
use App\Repositories\transaksiRepository;
use App\Libraries\jsr;
// use App\Libraries\myfunction as fun;

class umkmkuService {

    protected $repo;
    protected $repo_user;
    protected $repo_produk;
    protected $repo_transaksi;
    
    /*
    public function __construct(
        umkmkuRepository $repo1,
        produkkuRepository $repo2,
        transaksiRepository $repo3,
        userRepository $repo4,
    ) {
        $this->repo = $repo1;
        $this->repo_produk = $repo2;
        $this->repo_transaksi = $repo3;
        $this->repo_user = $repo4;
    }
    */

    public function __construct() {
        $this->repo = new umkmkuRepository();
    }

    public function getAll(array $where = null, String $by = 'id_umkm', String $orderBy = 'asc') {
        return jsr::print([
            'pesan' => 'Data Daftar Semua UMKM!',
            'success' => 1,
            'data' => $this->repo->getAll($where, $by, $orderBy)
        ], 'ok');
    }

    public function get(array $where = null) {
        return jsr::print([
            'pesan' => 'Data Detail UMKM!',
            'success' => 1,
            'data' => $this->repo->get($where)
        ], 'ok');
    }

    public function getAllDetail(array $where = null) {
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
        $data_pegawai = $this->repo_user->getAll(
            'nama', 
            'asc',
            $where
        );

        return jsr::print(
            [
                'success' => 1,
                'pesan' => 'Data Profil Detail UMKM!',
                'data_umkm' => $data_umkm,
                'data_produk' => $data_produk,
                'data_transaksi' => $data_transaksi,
                'data_pegawai' => $data_pegawai,
            ], 
            'ok'
        );
    }

    public function store(array $val) {
        return match($this->repo->store([
            'id_umkm'       => $this->repo->getID($val['id_user'], $val['email']),
            'id_user'       => $val['id_user'],
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

    public function update(array $val) {
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

    public function delete(String $id_umkm) {
        return match($this->repo->delete(['id_umkm' => $id_umkm])) {
            1 => jsr::print(['pesan' => 'hapus umkm berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'hapus umkm gagal', 'error' => 1], null)
        };
    }
    
}
?>