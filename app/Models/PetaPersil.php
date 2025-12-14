<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PetaPersil extends Model
{
    use HasFactory;

    // Nama tabel dan Primary Key sesuai dengan migration
    protected $table = 'peta_persil';
    protected $primaryKey = 'peta_id';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'persil_id',
        'geojson',
        'panjang_m',
        'lebar_m',
    ];

    // Casting: Pastikan kolom JSON dibaca sebagai array/object PHP
    protected $casts = [
        'geojson' => 'array',
    ];

    /**
     * Relasi One-to-One terbalik: Dapatkan persil yang terkait dengan peta ini.
     */
    public function persil(): BelongsTo
    {
        // PetaPersil BELONGS TO Persil
        return $this->belongsTo(Persil::class, 'persil_id', 'persil_id');
    }

    /**
     * Relasi ke Media (Lampiran File/Scan Peta).
     * Menggunakan filter ref_table 'peta_persil'.
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(Media::class, 'ref_id', 'peta_id')
                    // Memfilter hanya media yang terikat dengan entitas 'peta_persil'
                    ->where('ref_table', 'peta_persil')
                    ->orderBy('sort_order', 'asc');
    }
}
