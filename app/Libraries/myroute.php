<?php
//! Copyright Syahri Ramadhan Wiraasmara (ARI)
namespace App\Libraries;
class myroute {

    // WEB ROUTES {
        public static function tardulu(string $procname = null) {
            if($procname == '' || $procname == null) return '\App\Http\Controllers\..UserController..';
            return '\App\Http\Controllers\..UserController..@'.$procname;
        }
    // }

    // API ROUTES {
        public static function API(string $controller, string $procname = null) {
            return '\App\Http\Controllers\\'.$controller.'@'.$procname;
        }
    // }

}
?>
