<?php
// ! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Libraries;
use Redirect;
use App\Libraries\myfunction;
use asmcp_1000_user;
use Cookie;
class auth {

    protected static $mcr_x1, $mcr_x2, $mcr_x3, $mcr_x4, $mcr_x5;
    public static function setModelForWeb($a, $b, $c, $d, $e) {
        self::$mcr_x1 = $a;
        self::$mcr_x2 = $b;
        self::$mcr_x3 = $c;
        self::$mcr_x4 = $d;
        self::$mcr_x5 = $e;
    }

    public static function mcr(int $x) {
        return match($x) {
            1 => self::$mcr_x1,
            2 => self::$mcr_x2,
            3 => self::$mcr_x3,
            4 => self::$mcr_x4,
            5 => self::$mcr_x5,
            default => 0
        };
    }

    public static function cookieSeries() {
        // id, id_1001, username, email, remember_token, pin
        return ['mcr-x-aswq-1', 'mcr-x-aswq-2', 'mcr-x-aswq-3',
                'mcr-x-aswq-4', 'mcr-x-aswq-5'];
    }

    public static function ifLogin_onRoute() {
        if( isset($_COOKIE['islogin']) ) return '\App\Http\Controllers\PlayerController@index';
        return '\App\Http\Controllers\UserUnauthController@login';
    }

    public static function token() {
        if( !isset($_COOKIE['islogin']) ) return 'You\'re Unauthorized! FORBIDDEN!'; //return '\App\Http\Controllers\UserUnauthController@login';
        return myfunction::getCookie('mcr-x-aswq-5');
    }

}
?>
