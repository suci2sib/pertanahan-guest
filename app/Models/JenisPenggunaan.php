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

    public function scopeSearch($query, $request, array $columns)
{
    if ($request->filled('search')) {
        $query->where(function($q) use ($request, $columns) {
            foreach ($columns as $column) {
                $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
            }
        });
    }
}
}
