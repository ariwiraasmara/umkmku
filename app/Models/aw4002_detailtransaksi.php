<?php
// ! Copyright @ Syahri Ramadhan Wiraasmara (ARI)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aw4002_detailtransaksi extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'aw4002_detailtransaksi';
    protected $primaryKey = 'id_detailtransaksi';
    protected $fillable = [
        'id_detailtransaksi',
        'id_transaksi',
        'id_produk',
        'jumlah',
    ];

    public $timestamps = false;
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';

    public function aw4001_transaksi() {
        // NamaModel::class, 'foreign_key', 'local_key'
        return $this->hasOne(aw4001_transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
