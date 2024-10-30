<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;
interface transaksiRepositoryInterface {
    public function getAll(array $where = null, String $by = 'id_produk', String $orderBy = 'asc');
    public function get(array $where = null);
    public function getDetail(String $id_transaksi);
    
    public function store(array $val);
    public function storeDetail(array $val): int;

    // di transaksi ini tidak update namun ada delete
    public function delete(array $val): int;
}
?>