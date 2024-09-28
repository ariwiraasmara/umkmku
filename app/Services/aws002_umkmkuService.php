<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Services;

use App\Repositories\umkmkuRepository;
use App\Libraries\jsr;
// use App\Libraries\myfunction as fun;

class umkmkuService {

    protected $repo;
    public function __construct(umkmkuRepository $repo) {
        $this->repo = $repo;
    }

    public function getAll(array $where, String $by = 'id_umkm', String $orderBy = 'asc') {
        return $this->repo->getAll($where, $by, $orderBy);
    }

    public function get(array $where = null, String $by = null, String $orderBy = null) {
        return $this->repo->get($where, $by, $orderBy);
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

    public function update(int $id_umkm, array $val) {
        return match($this->repo->update(
        $id_umkm, 
            [
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
            ]
        )) {
            1 => jsr::print(['pesan' => 'update umkm berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'update umkm gagal', 'error' => 1], null)
        };
    }

    public function delete(int $id_umkm) {
        return match($this->repo->delete(['id_umkm' => $id_umkm])) {
            1 => jsr::print(['pesan' => 'hapus umkm berhasil', 'success' => 1], 'created'),
            default => jsr::print(['pesan' => 'hapus umkm gagal', 'error' => 1], null)
        };
    }
    
}
?>