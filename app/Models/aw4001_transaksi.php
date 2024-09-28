<?php
// ! Copyright @ Syahri Ramadhan Wiraasmara (ARI)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aw4001_transaksi extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'aw2001_umkmku';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_transaksi',
        'id_umkm',
        'tgl',
        'id_user',
        'diskon',
        'uang_diterima'
    ];

    public $timestamps = false;
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';

    public function aw2001_umkmku() {
        // NamaModel::class, 'foreign_key', 'local_key'
        return $this->hasOne(aw2001_umkmku::class, 'id_umkm', 'id_umkm');
    }
}