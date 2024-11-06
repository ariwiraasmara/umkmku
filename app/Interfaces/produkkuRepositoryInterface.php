<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;
use Illuminate\Support\Collection;
interface produkkuRepositoryInterface {
    public function getID(String $id_umkm):String;
    public function getAll(array $where, String $by = 'id_umkm', String $orderBy = 'asc'): array|Collection|null;
    public function get(array $where = null): array|Collection|null;
    
    public static function store(array $val): int;
    public function update(array $val): int;
    public function delete(array $val): int;
}
?>