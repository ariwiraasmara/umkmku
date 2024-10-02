<?php
//! Copyright Syahri Ramadhan Wiraasmara (ARI)
namespace App\Libraries;
class myroute {

    // WEB ROUTES {
        public static function view(string $classname = null) {
            if($classname == '' || $classname == null) return '\App\Livewire\NotFound::class';
            return '\App\Livewire\\'.$classname.'::class';
        }
    // }

    // Frontend Process Route {
        public static function process(string $controller, string $procname = null) {
            return '\App\Http\Controllers\Frontend\\'.$controller.'@'.$procname;
        }
    // }

    // API ROUTES {
        public static function API(string $controller, string $procname = null) {
            return '\App\Http\Controllers\\'.$controller.'@'.$procname;
        }
    // }

}
?>
