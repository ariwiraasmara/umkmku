<?php

namespace App\Livewire\Logout;

use Livewire\Component;

class LoginPage extends Component {

    public String $title = 'Login';
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