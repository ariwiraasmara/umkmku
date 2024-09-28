<?php
// ! Copyright @ Syahri Ramadhan Wiraasmara (ARI)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aw3001_produkku extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'aw3001_produkku';
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'id_produk',
        'id_umkm',
        'nama',
        'merk',
        'jenis',
        'deskripsi',
        'harga',
        'stok',
        'satuan_unit',
        'diskon',
    ];

    public $timestamps = false;
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';

    public function aw2001_umkmku() {
        // NamaModel::class, 'foreign_key', 'local_key'
        return $this->hasOne(aw2001_umkmku::class, 'id_umkm', 'id_umkm');
    }
}
