<?php
namespace App\Mylibs;
class mcr {

    // WEB ROUTES {
        public static function User(string $procname = null) {
            if($procname == '' || $procname == null) return '\App\Http\Controllers\UserController';
            return '\App\Http\Controllers\UserController@'.$procname;
        }

        public static function UserUnauth(string $procname = null) {
            if($procname == '' || $procname == null) return '\App\Http\Controllers\UserUnauthController';
            return '\App\Http\Controllers\UserUnauthController@'.$procname;
        }

        public static function UserAuth(string $procname = null) {
            if($procname == '' || $procname == null) return '\App\Http\Controllers\UserAuthController';
            return '\App\Http\Controllers\UserAuthController@'.$procname;
        }

        public static function Player(string $procname = null) {
            if($procname == '' || $procname == null) return '\App\Http\Controllers\PlayerController';
            return '\App\Http\Controllers\PlayerController@'.$procname;
        }

        public static function asmcp1008(string $procname = null) {
            if($procname == '' || $procname == null) return '\App\Http\Controllers\Asmcp1008LevelingsystemController';
            return '\App\Http\Controllers\Asmcp1008LevelingsystemController@'.$procname;
        }
    // }

    // API ROUTES {
        public static function API(string $procname = null) {
            return '\App\Http\Controllers\APIController@'.$procname;
        }
    // }

}
?>
