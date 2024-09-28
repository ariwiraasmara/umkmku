<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;
interface userRepositoriesInterface {
    public function getAll(String $by = 'id', String $orderBy = 'asc');
    public function get(array $where = null, String $by = null, String $orderBy = null);
    public function getProfil(array $where = null);
    
    public function storeAccount(array $val);
    public function updateAccount(int $id, array $val): int;
    public function deleteAccount(array $val): int;

    public function updateProfilUser(int $id, array $val): int;
    public function deleteProfilUser(array $val): int;
}
?>