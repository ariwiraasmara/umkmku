<?php

namespace App\Livewire\Login\Umkmku;

use Livewire\Component;
use App\Libraries\myfunction as fun;

class Umkmku extends Component {
    
    protected String $title = 'UMKMKU';
    protected $data;


    public function mount() {
        
    }

    public function render() {
        return view(
            'livewire.pages.umkmku.list', 
            ['title' => $this->title])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
