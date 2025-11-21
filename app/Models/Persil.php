<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persil extends Model
{

    protected $table = 'persil';
    protected $primaryKey = 'persil_id';
    protected $fillable = [
        'kode_persil',
        'pemilik_warga_id',
        'luas_m2',
        'penggunaan',
        'alamat_lahan',
        'rt',
        'rw',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'pemilik_warga_id', 'warga_id');
    }
}
