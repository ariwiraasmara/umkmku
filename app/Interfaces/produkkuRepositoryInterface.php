<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;
interface produkkuRepositoryInterface {
    public function getID(String $id_umkm);
    public function getAll(array $where, String $by = 'id_umkm', String $orderBy = 'asc');
    public function get(array $where = null);
    
    public static function store(array $val);
    public function update(array $val): int;
    public function delete(array $val): int;
}
?>