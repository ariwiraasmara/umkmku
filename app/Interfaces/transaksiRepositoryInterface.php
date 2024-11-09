<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;
use Illuminate\Support\Collection;
interface transaksiRepositoryInterface {
    public function getID(int $id_user, string $email): String;
    public function generateNomorNota(int $id_user): String;
    public function getIDDetail(String $id_transaksi = null, int $x): String;

    public function getAll(array $where = null, String $by = 'id_transaksi', String $orderBy = 'asc'): array|Collection|String|int|null;
    public function get(array $where = null): array|Collection|String|int|null;
    public function getDetail(String $id_transaksi): array|Collection|String|int|null;
    
    public function store(array $val): String|int|null;
    public function storeDetail(array $val): String|int|null;

    // di transaksi ini tidak update namun ada delete
    public function delete(array $val): String|int|null;
}
?>