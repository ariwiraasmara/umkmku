<?php
// ! Copyright @ Syahri Ramadhan Wiraasmara (ARI)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aw2001_umkmku extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'aw2001_umkmku';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_umkm',
        'id',
        'nama_umkm',
        'tgl_berdiri',
        'jenis_usaha',
        'deskripsi',
        'no_tlp',
        'logo_umkm',
        'foto_umkm',
        'alamat',
        'longitude',
        'latitude',
    ];

    public $timestamps = false;
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';

    public function user() {
        // NamaModel::class, 'foreign_key', 'local_key'
        return $this->hasOne(User::class, 'id', 'id');
    }
}
