<?php

namespace App\Livewire\Login;

use Livewire\Component;

class Profil extends Component {

    

    public String $title = 'Profil';
    public function render() {
        return view(
            'livewire.pages.profile.profil', 
            ['title' => $this->title])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
