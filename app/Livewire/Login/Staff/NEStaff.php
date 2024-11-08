<?php

namespace App\Livewire\Login\Staff;

use Livewire\Component;
use App\Services\userService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;

class NEStaff extends Component {

    protected String|null $title;
    protected String|null $isedit;
    protected String|null $url;
    protected userService|String|null $service;
    protected array|Collection|JsonResponse|String|null $data;

    protected int|null $id_user;
    protected String|null $username;
    protected String|null $email;
    protected String|null $password;
    protected String|null $tlp;
    protected int|null $roles;
    protected String|null $nama;
    protected String|null $jk;
    protected String|null $alamat;
    protected String|null $foto;
    protected String|null $tempat_lahir;
    protected String|null $tgl_lahir;
    protected String|null $id_umkm;
    protected String|null $status;
    protected String|null $jabatan;
    
    public function mount(String $id = null, String $title = null) {
        if( fun::getRawCookie('islogin') == null ) return redirect('login');
        $this->title            = $title == null ? 'Staff Baru' : 'Edit Staff';
        $this->isedit           = $title == null ? 'new' : 'edit';
        $this->url              = $title == null ? '/process/staff/baru/'.$id : '/process/staff/edit/'.$id;
        
        $this->service          = $title == null ? null : new userService();
        $this->data             = $title == null ? null : $this->service->getStaff(fun::denval($id));

        $this->id_user          = $title == null ? null : fun::denval($id);
        $this->username         = $title == null ? '' : $this->data[0]['username'];
        $this->email            = $title == null ? '' : $this->data[0]['email'];
        $this->password         = '';
        $this->tlp              = $title == null ? '' : $this->data[0]['tlp'];
        $this->roles            = $title == null ? null : $this->data[0]['roles'];
        $this->nama             = $title == null ? '' : $this->data[0]['nama'];
        $this->jk               = $title == null ? '' : $this->data[0]['jk'];
        $this->alamat           = $title == null ? '' : $this->data[0]['alamat'];
        $this->foto             = $title == null ? '' : $this->data[0]['foto'];
        $this->tempat_lahir     = $title == null ? '' : $this->data[0]['tempat_lahir'];
        $this->tgl_lahir        = $title == null ? '' : $this->data[0]['tgl_lahir'];
        $this->id_umkm          = $title == null ? '' : $this->data[0]['id_umkm'];
        $this->status           = $title == null ? '' : $this->data[0]['status'];
        $this->jabatan          = $title == null ? '' : $this->data[0]['jabatan'];
    }

    public function render() {
        return view('livewire.pages.staff.ne-staff', [
            'title'          => $this->title,
            'isedit'         => $this->isedit,
            'url'            => $this->url,
            'id_user'        => $this->id_user,
            'username'       => $this->username,
            'email'          => $this->email,
            'password'       => $this->password,
            'tlp'            => $this->tlp,
            'roles'          => $this->roles,
            'nama'           => $this->nama,
            'jk'             => $this->jk,
            'alamat'         => $this->alamat,
            'foto'           => $this->foto,
            'tempat_lahir'   => $this->tempat_lahir,
            'tgl_lahir'      => $this->tgl_lahir,
            'id_umkm'        => $this->id_umkm,
            'status'         => $this->status,
            'jabatan'        => $this->jabatan,
        ])
        ->layout(
            'layouts.authorized', [
            'pagetitle' => $this->title.' | UMKMKU'
        ]);
    }
}