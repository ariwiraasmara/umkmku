<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;
interface transaksiRepositoriesInterface {
    public function getAll(int $id_umkm = 0, String $by = 'id_produk', String $orderBy = 'asc');
    public function getDetail(int $id_transaksi = 0);
    
    public function store(array $val): int;
    public function storeDetail(array $val): int;

    // di transaksi ini tidak update namun ada delete
    public function delete(array $val): int;
}
?>