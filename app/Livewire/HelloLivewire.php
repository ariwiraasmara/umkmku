<?php

namespace App\Livewire;

use Livewire\Component;

class HelloLivewire extends Component {
    public int $x = 5;
    public int $y = 9;
    public $count = 0;
    public string $hello = 'HELLO LIVEWIRE';

    public function increment()
    {
        $this->count++;
    }


    public function render() {
        
        // return view('livewire.hello-livewire');
        return view('livewire.hello-livewire')
                ->layout('layouts.authorized');

    }
}
