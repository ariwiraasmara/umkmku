<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;
interface produkkuRepositoryInterface {
    public function getID(int $id_user, string $email): String;
    public function getAll(array $where, String $by = 'id_umkm', String $orderBy = 'asc');
    public function get(array $where = null);
    
    public function store(array $val): int;
    public function update(array $val): int;
    public function delete(array $val): int;
}
?>