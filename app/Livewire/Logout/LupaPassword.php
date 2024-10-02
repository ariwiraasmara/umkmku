<?php

namespace App\Livewire\Logout;

use Livewire\Component;

class LupaPassword extends Component {
    public String $title = 'Lupa Password';
    public function render() {
        return view(
            'livewire.pages.lupa-password', 
            ['title' => $this->title])
        ->layout(
            'layouts.unauthorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
