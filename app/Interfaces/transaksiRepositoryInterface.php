<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;
use Illuminate\Support\Collection;
interface transaksiRepositoryInterface {
    public function getID(int $id_user, string $email): String;
    public function generateNomorNota(int $id_user): String;
    public function getIDDetail(String $id_transaksi = null, int $x): String;

    public function getAll(array $where = null, String $by = 'id_transaksi', String $orderBy = 'asc'): array|Collection|null;
    public function get(array $where = null): array|Collection|null;
    public function getDetail(String $id_transaksi): array|Collection|null;
    
    public function store(array $val);
    public function storeDetail(array $val): int;

    // di transaksi ini tidak update namun ada delete
    public function delete(array $val): int;
}
?>