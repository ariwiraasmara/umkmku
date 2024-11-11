<?php
//! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Livewire\Login\Staff;

use Livewire\Component;
use App\Services\userService;
use App\Libraries\myfunction as fun;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Exception;

class NEStaff extends Component {

    protected String|null $title;
    protected String|null $isedit;
    protected String|null $url;
    protected userService|String|null $service;
    protected array|Collection|JsonResponse|String|int|null $data;

    protected String|int|null $id_user;
    protected String|null $username;
    protected String|null $email;
    protected String|null $password;
    protected String|null $tlp;
    protected String|int|null $roles;
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
        /*
        $this->title            = $title == null ? 'Staff Baru' : 'Edit Staff';
        $this->isedit           = $title == null ? 'new' : 'edit';
        $this->url              = $title == null ? '/process/staff/baru/'.$id : '/process/staff/edit/'.$id;
        $this->service          = $title == null ? null : new userService();
        $this->data             = $title == null ? null : $this->service->getStaff(fun::denval($id));
        $this->id_user          = $title == null ? null : fun::denval($id);
        $this->username         = $title == null ? null : $this->data[0]['username'];
        $this->email            = $title == null ? null : $this->data[0]['email'];
        $this->password         = null;
        $this->tlp              = $title == null ? null : $this->data[0]['tlp'];
        $this->roles            = $title == null ? null : $this->data[0]['roles'];
        $this->nama             = $title == null ? null : $this->data[0]['nama'];
        $this->jk               = $title == null ? null : $this->data[0]['jk'];
        $this->alamat           = $title == null ? null : $this->data[0]['alamat'];
        $this->foto             = $title == null ? null : $this->data[0]['foto'];
        $this->tempat_lahir     = $title == null ? null : $this->data[0]['tempat_lahir'];
        $this->tgl_lahir        = $title == null ? null : $this->data[0]['tgl_lahir'];
        $this->id_umkm          = $title == null ? null : $this->data[0]['id_umkm'];
        $this->status           = $title == null ? null : $this->data[0]['status'];
        $this->jabatan          = $title == null ? null : $this->data[0]['jabatan'];
        */
        if($title == null) {
            $this->title        = 'Staff Baru';
            $this->isedit       = 'new';
            $this->url          = '/process/staff/baru/'.$id;
            $this->service      = null;
            $this->data         = null;
            $this->id_user      = null;
            $this->username     = null;
            $this->email        = null;
            $this->password     = null;
            $this->tlp          = null;
            $this->roles        = null;
            $this->nama         = null;
            $this->jk           = null;
            $this->alamat       = null;
            $this->foto         = null;
            $this->tempat_lahir = null;
            $this->tgl_lahir    = null;
            $this->id_umkm      = null;
            $this->status       = null;
            $this->jabatan      = null;
        }
        else {
            $this->title        = 'Edit Staff';
            $this->isedit       = 'edit';
            $this->url          = '/process/staff/edit/'.$id;
            $this->service      = new userService();
            $this->data         = $this->service->getStaff(fun::denval($id));
            try {
                $this->id_user      = fun::denval($id);
                $this->username     = $this->data[0]['username'];
                $this->email        = $this->data[0]['email'];
                $this->password     = null;
                $this->tlp          = $this->data[0]['tlp'];
                $this->roles        = $this->data[0]['roles'];
                $this->nama         = $this->data[0]['nama'];
                $this->jk           = $this->data[0]['jk'];
                $this->alamat       = $this->data[0]['alamat'];
                $this->foto         = $this->data[0]['foto'];
                $this->tempat_lahir = $this->data[0]['tempat_lahir'];
                $this->tgl_lahir    = $this->data[0]['tgl_lahir'];
                $this->id_umkm      = $this->data[0]['id_umkm'];
                $this->status       = $this->data[0]['status'];
                $this->jabatan      = $this->data[0]['jabatan'];
            }
            catch(Exception $e) {
                $this->id_user      = null;
                $this->username     = null;
                $this->email        = null;
                $this->password     = null;
                $this->tlp          = null;
                $this->roles        = null;
                $this->nama         = null;
                $this->jk           = null;
                $this->alamat       = null;
                $this->foto         = null;
                $this->tempat_lahir = null;
                $this->tgl_lahir    = null;
                $this->id_umkm      = null;
                $this->status       = null;
                $this->jabatan      = null;
            }
        }
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
        ->layout('layouts.authorized', [
            'pagetitle'     => $this->title.' | UMKMKU',
            'uniquekey'     => fun::random('combwisp', 60),
            'description'   => 'UMKMKU adalah sebuah aplikasi berbasis website untuk pelaku usaha UMKM dan digunakan oleh mereka (sebagai user). Aplikasi ini bisa digunakan untuk berbagai jenis umkm dan dapat diakses di berbagai device dan platform.',
            'keywords'      => 'UMKMKU, Aplikasi UMKM, Website UMKM, Aplikasi untuk pengusaha kecil dan menengah kebawah, Website untuk pengusaha kecil dan menengah kebawah, Platform UMKM kecil dan menengah ke bawah.',
            'copyright'     => 'Copyright '.date('Y').' @ Syahri Ramadhan Wiraasmara (ARI)'
        ]);
    }
}