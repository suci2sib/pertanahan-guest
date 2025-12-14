<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peta_persil', function (Blueprint $table) {
            // Primary Key: peta_id
            $table->id('peta_id');

            // Foreign Key: persil_id, terikat ke tabel 'persil'
            $table->foreignId('persil_id')
                  ->constrained('persil', 'persil_id')
                  ->onDelete('cascade')
                  ->unique(); // Satu Persil hanya memiliki satu data peta

            // Data Geospasial/Dimensi
            $table->json('geojson')->nullable(); // Menyimpan data geospasial (Polygon/JSON)
            $table->decimal('panjang_m', 10, 2)->nullable(); // Panjang dalam meter (10 digit total, 2 desimal)
            $table->decimal('lebar_m', 10, 2)->nullable();   // Lebar dalam meter

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peta_persil');
    }
};
