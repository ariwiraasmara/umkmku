<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;
use Illuminate\Support\Collection;
interface produkkuRepositoryInterface {
    public function getID(String $id_umkm = null): String;
    public function getAll(array $where = null, String $by = 'id_umkm', String $orderBy = 'asc'): array|Collection|String|int|null;
    public function get(array $where = null): array|Collection|String|int|null;
    
    public static function store(array $val = null): String|int;
    public function update(array $val = null): String|int;
    public function delete(array $val = null): String|int;
}
?>