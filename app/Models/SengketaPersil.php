<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany; // Diperlukan untuk relasi attachments

class SengketaPersil extends Model
{
    use HasFactory;

    // Nama tabel dan Primary Key sesuai dengan migration
    protected $table = 'sengketa_persil';
    protected $primaryKey = 'sengketa_id';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'persil_id',
        'pihak_1',
        'pihak_2',
        'kronologi',
        'status',
        'penyelesaian',
    ];

    /**
     * Dapatkan persil yang terkait dengan sengketa ini (Relasi Many-to-One).
     */
    public function persil(): BelongsTo
    {
        // SengketaPersil BELONGS TO Persil
        return $this->belongsTo(Persil::class, 'persil_id', 'persil_id');
    }

    /**
     * Dapatkan semua lampiran (media) yang terkait dengan sengketa ini.
     * Menggunakan filter ref_table 'sengketa_persil'.
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(Media::class, 'ref_id', 'sengketa_id')
                    // Memfilter hanya media yang terikat dengan entitas 'sengketa_persil'
                    ->where('ref_table', 'sengketa_persil')
                    ->orderBy('sort_order', 'asc');
    }

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }
}
