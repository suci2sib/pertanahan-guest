<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DokumenPersil extends Model
{
    use HasFactory;
    protected $table      = 'dokumen_persil';
    protected $primaryKey = 'dokumen_id';
    protected $fillable   = [
        'persil_id',
        'jenis_dokumen',
        'nomor',
        'keterangan',
    ];

    public function persil(): BelongsTo
    {
        return $this->belongsTo(Persil::class, 'persil_id', 'persil_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Media::class, 'ref_id', 'dokumen_id')
                    // Memfilter hanya media yang terikat dengan entitas 'dokumen_persil'
                    ->where('ref_table', 'dokumen_persil')
                    ->orderBy('sort_order', 'asc');
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
