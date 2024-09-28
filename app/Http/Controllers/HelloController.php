<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller {
    //

    public function hello1(Request $request) {
        return 'hello 1';
    }

    public function hello2(Request $request) {
        return 'hello 2';
    }

}
