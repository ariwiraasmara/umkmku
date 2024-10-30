<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;

use Illuminate\Support\Collection;
interface userRepositoryInterface {
    public function getAll(String $by = 'id', String $orderBy = 'asc', array $where = null): array|Collection|null;
    public function getAllStaff(String $id, String $by = 'nama', String $orderBy = 'asc'): array|Collection|null;
    public function get(array $where): array|Collection|null;
    public function getStaff(int $id = null): array|Collection|null;
    public function getProfil(array $where = null): array|Collection|null;
    
    public function storeAccount(array $val): String|int;
    public function updateAccount(array $val): int;
    public function deleteAccount(array $val): int;

    public function storeNewStaff(array $val1, array $val2): String|int;
    public function updateStaff(array $val1, array $val2): int;

    public function updateProfilUser(array $val): int;
    public function deleteProfilUser(array $val): int;
}
?>