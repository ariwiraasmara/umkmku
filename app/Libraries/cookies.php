<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Libraries;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Facades\Hash;
class cookies {

    protected String|float|int|bool $islogin;
    protected String|float|int|bool $key;

    public function islogin(): String {
        return fun::toMD5(fun::enval('islogin'));
    }

    public function key(String $key): String {
        return fun::toMD5(fun::enval($key));
    }
}
?>