<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;
use Illuminate\Support\Collection;
interface umkmkuRepositoryInterface {
    public function getID(int $id_user = null, string $email = null): String;
    public function getAll(array $where = null, String $by = 'id_umkm', String $orderBy = 'asc'): array|Collection|String|int|null;
    public function get(array $where = null): array|Collection|String|int|null;
    
    public function store(array $val = null): String|int|null;
    public function update(array $val = null): String|int|null;
    public function delete(array $val = null): String|int|null;
}
?>