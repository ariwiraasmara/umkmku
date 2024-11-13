<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Libraries;

use App\Models\User;
use App\Models\aw1002_userprofil;
use App\Models\aw2001_umkmku;
use App\Models\aw3001_produkku;
use App\Models\aw4001_transaksi;
use App\Models\aw4002_detailtransaksi;
use App\MyLibs\myfunction;
use Exception;

class crud {

    public function __construct() {

    }

    //* users procedure
    public static function procuser(
        int $type = 0, 
        array $val = null
    ) {
        //? insert
        if($type == 1) {
            $date = date('Y-m-d H:i:s');
            $res = User::create([
                'username'          => $val['username'],
                'email'             => $val['email'],
                'password'          => $val['password'],
                'remember_token'    => null,
                'roles'             => $val['roles'],
                'email_verified_at' => $date,
                'created_at'        => $date
            ]);
            return $res->id;
        }

        //? update
        else if($type == 2) { 
            return User::where('id', '=', $val['id'])->update([
                $val['field']   => $val['field_values'],
                'updated_at'     => date('Y-m-d H:i:s')
            ]);
        }

        //? hard delete
        else if($type == 3) {
            $res1 = User::where($val)->delete();
            $res2 = aw1002_userprofil::where($val)->delete();
            return collect([
                'res1' => $res1,
                'res2' => $res2
            ]);
        }

        //! yeah, ketika variable $type bernilai 0
        else {
            return 'error user';
        }
    }

    //* aw1002_userprofil Procedure
    public static function procuserprofil(
        int $type = 0, 
        array $val = null
    ) {
        //? insert
        if($type == 1) { 
            return aw1002_userprofil::create([
                'id' => $val['id']
            ]);
        }

        //? update
        else if($type == 2) { 
            return aw1002_userprofil::where('id', '=', $val['id'])->update([
                'nama'         => $val['nama'],
                'jk'           => $val['jk'],
                'alamat'       => $val['alamat'],
                'tempat_lahir' => $val['tempat_lahir'],
                'tgl_lahir'    => $val['tgl_lahir'],
                'id_umkm'      => $val['id_umkm'],
                'status'       => $val['status'],
                'jabatan'      => $val['jabatan']
            ]);
        }

        //? new staff
        else if($type == 3) { 
            return aw1002_userprofil::create([
                'id'        => $val['id'],
                'nama'      => $val['nama'],
                'id_umkm'   => $val['id_umkm'],
                'status'    => $val['status'],
                'jabatan'   => $val['jabatan']
            ]);
        }

        //? edit staff
        else if($type == 4) { 
            return aw1002_userprofil::where('id', '=', $val['id'])->update([
                'id_umkm'      => $val['id_umkm'],
                'status'       => $val['status'],
                'jabatan'      => $val['jabatan']
            ]);
        }

        //? edit specific one field
        else if($type == 5) {
            return aw1002_userprofil::where('id', '=', $val['id'])->update([
                $val['field'] => $val['field_values'],
            ]);
        }

        //? hard delete
        else if($type == 6) { 
            return aw1002_userprofil::where($val)->delete();
        }

        //! yeah, ketika variable $type bernilai 0
        else {
            return 'error user profil';
        }
    }

    //* as2001_umkmku Procedure
    public static function procumkmku(
        int $type = 0, 
        array $val = null
    ) {
        // ? insert
        if($type == 1) { 
            return aw2001_umkmku::create([
                'id_umkm'       => $val['id_umkm'],
                'id'            => $val['id_user'],
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
            ]);
        }

        // ? update
        else if($type == 2) { 
            return aw2001_umkmku::where(['id_umkm' => $val['id_umkm']])->update([
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
            ]);
        }

        //? delete
        else if($type == 3) {
            //! menghapus 1 umkm, berarti menghapus semua data yang terkait dan bersangkutan
            // try {
                $res1 = aw2001_umkmku::where(['id_umkm' => $val['id_umkm']])->delete();
                $res2 = aw1002_userprofil::where(['id' => $val['id_user']])->update(['id_umkm' => '']);
                $res3 = aw3001_produkku::where(['id_umkm' => $val['id_umkm']])->delete();
                $res4 = aw4001_transaksi::where(['id_umkm' => $val['id_umkm']])
                            ->join('aw4002_detailtransaksi', 'aw4001_transaksi.id_transaksi', '=', 'aw4002_detailtransaksi.id_transaksi')
                            ->delete();
                return collect([
                    'res1' => $res1,
                    'res2' => $res2,
                    'res3' => $res3,
                    'res4' => $res4
                ]);
            // }
            // catch(Exception $e) {
            //     return aw2001_umkmku::where($val)->delete();
            // }
            // return aw2001_umkmku::where($val)->delete();
        }

        else {
            return 'error crud produkku';
        }
    }

    //* aw3001_produkku Procedure
    public static function procprodukku(
        int $type = 0, 
        array $val = null
    ) {
        // ? insert
        if($type == 1) { 
            return aw3001_produkku::create([
                'id_produk'     => $val['id_produk'],
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
        }

        // ? update
        else if($type == 2) { 
            return aw3001_produkku::where('id_produk', '=', $val['id_produk'])->update([
                'nama'          => $val['nama'],
                'merk'          => $val['merk'],
                'jenis'         => $val['jenis'],
                'deskripsi'     => $val['deskripsi'],
                'harga'         => $val['harga'],
                'stok'          => $val['stok'],
                'satuan_unit'   => $val['satuan_unit'],
                'diskon'        => $val['diskon'],
            ]);
        }

        //? delete
        else if($type == 3) {
            return aw3001_produkku::where($val)->delete();
        }

        else {
            return 'error crud produkku';
        }
    }

    //* aw4001_transaksi Procedure
    public static function proctransaksi(
        int $type = 0, 
        array $val = null
    ) {
        //? insert
        if($type == 1) {
            return aw4001_transaksi::create([
                'id_transaksi'  => $val['id_transaksi'],
                'id_umkm'       => $val['id_umkm'],
                'no_nota'       => $val['no_nota'],
                'tgl'           => date('Y-m-d H:i:s'),
                'id_user'       => $val['id_user'],
                'diskon'        => $val['diskon'],
                'nama_pelanggan'=> $val['nama_pelanggan'],
                'uang_diterima' => $val['uang_diterima'],
            ]);
        }

        //? delete
        //! karena 1 transaksi beserta detailnya kehapus semua dari database
        else if($type == 2) {
            $res1 = aw4001_transaksi::where($val)->delete();
            $res2 = aw4002_detailtransaksi::where($val)->delete();
            return collect([
                'res1' => $res1,
                'res2' => $res2
            ]);
        }

        //! yeah, ketika variable $type bernilai 0
        else {
            return 'error transaksi';
        }
    }

    //* aw4002_detailtransaksi Procedure
    public static function procdetailtransaksi(
        int $type = 0, 
        array $val = null
    ) {
        //? insert
        if($type == 1) {
            return aw4002_detailtransaksi::create([
                'id_detailtransaksi' => $val['id_detailtransaksi'],
                'id_transaksi'       => $val['id_transaksi'],
                'id_produk'          => $val['id_produk'],
                'jumlah'             => $val['jumlah'],
            ]);
        }

        //! yeah, ketika variable $type bernilai 0
        else {
            return 'error detail transaksi';
        }
    }

    // Todo : Ketika user update fotonya, atau update foto dan logo UMKM nya
    // ? untuk sekarang belakangan dulu
    public static function movefile(string $field = null, array $val) {
    //     asmcp_1006_userfiles::where('id_1006', '=', $val['id1006'])->update([
    //         $field => $val['fv'],
    //     ]);
    }
}
?>
