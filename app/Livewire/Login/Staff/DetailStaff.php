<?php
namespace App\Livewire\Login\Staff;

use Livewire\Component;
use App\Libraries\myfunction as fun;
use App\Services\userService;

class DetailStaff extends Component {

    protected $service;
    protected String $title;
    protected $data;

    public function mount(String $id = null, String $title = null, array $data = null) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->service          = new userService();
        $this->data             = $this->service->getStaff($id);
        $this->title            = 'Detail Staff - '.$this->data[0]['nama'];
    }

    public function render() {
        return view('livewire.pages.staff.detailstaff', [
            'title' => $this->title,
            'data'  => $this->data    
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}
