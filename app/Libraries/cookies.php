<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Libraries;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Facades\Hash;
class cookies {

    protected String|int|bool $islogin;
    protected String|int|bool $key1;
    protected String|int|bool $key2;
    protected String|int|bool $key3;
    protected String|int|bool $key4;

    public function islogin() {
        return fun::toMD5(fun::enval('islogin'));
    }
}
?>