<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPenggunaan extends Model
{
    protected $table = 'jenispenggunaan';
    protected $primaryKey = 'jenis_id';

    protected $fillable = [
        'nama_penggunaan',
        'keterangan',
    ];
}
