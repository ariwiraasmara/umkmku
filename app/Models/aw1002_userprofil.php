<?php
// ! Copyright @ Syahri Ramadhan Wiraasmara (ARI)
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aw1002_userprofil extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'aw1002_userprofil';
    // protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nama',
        'jk',
        'alamat',
        'foto',
        'tempat_lahir',
        'tgl_lahir',
        'id_umkm',
        'status',
        'jabatan',
    ];

    public $timestamps = false;
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';

    // public function user() {
    //     // NamaModel::class, 'foreign_key', 'local_key'
    //     return $this->hasOne(User::class, 'id', 'id');
    // }

}
