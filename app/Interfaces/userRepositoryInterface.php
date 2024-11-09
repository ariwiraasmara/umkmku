<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Interfaces;

use Illuminate\Support\Collection;
interface userRepositoryInterface {
    public function getAll(String $by = 'id', String $orderBy = 'asc', array $where = null): array|Collection|String|int|null;
    public function getAllStaff(String $id = null, String $by = 'nama', String $orderBy = 'asc'): array|Collection|String|int|null;
    public function get(array $where = null): array|Collection|String|int|null;
    public function getStaff(int $id = null): array|Collection|String|int|null;
    public function getProfil(array $where = null): array|Collection|String|int|null;
    
    public function storeAccount(array $val = null): String|int;
    public function updateAccount(array $val = null): String|int;
    public function deleteAccount(array $val = null): String|int;

    public function storeNewStaff(array $val1 = null, array $val2 = null): String|int;
    public function updateStaff(array $val1 = null, array $val2 = null): String|int;

    public function updateProfilUser(array $val = null): String|int;
    public function deleteProfilUser(array $val = null): String|int;

    public function createDir(String $username = null);
    public function readDir(String $username = null): String;
    public function deleteDir(String $username = null): String;
    public function readFile(String $username = null, String $file = null): String;
    public function getFile(int $id = null, String $username = null): String;
    public function uploadFile($username = null, $file = null);
    public function getExtension(String $str = null): String;
}
?>