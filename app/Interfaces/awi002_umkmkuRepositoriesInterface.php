<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;

interface umkmkuRepositoryInterface {
    public function getID(int $id_user, string $email): String;
    public function getAll(array $where, String $by = 'id_umkm', String $orderBy = 'asc');
    public function get(array $where = null, String $by = null, String $orderBy = null);
    
    public function store(array $val): int;
    public function update(int $id, array $val): int;
    public function delete(array $val): int;
}
?>