<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Logout;

use Livewire\Component;
use App\Libraries\myfunction as fun;

class LoginPage extends Component {

    public String $title = 'Login';

    public function mount() {
        if( fun::getRawCookie('islogin') != null ) return redirect('dashboard');
    }

    public function render() {
        return view(
            'livewire.pages.login-page', 
            ['title' => $this->title])
        ->layout(
            'layouts.unauthorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}