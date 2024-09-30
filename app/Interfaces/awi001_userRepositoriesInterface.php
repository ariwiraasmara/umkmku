<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;
interface userRepositoriesInterface {
    public function getAll(String $by = 'id', String $orderBy = 'asc', array $where = null);
    public function get(array $where = null);
    public function getProfil(array $where = null);
    
    public function storeAccount(array $val);
    public function updateAccount(array $val): int;
    public function deleteAccount(array $val): int;

    public function updateProfilUser(array $val): int;
    public function deleteProfilUser(array $val): int;
}
?>