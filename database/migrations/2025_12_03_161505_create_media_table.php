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
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');                // PK
            $table->string('ref_table');           // Contoh: 'persils'
            $table->unsignedBigInteger('ref_id');  // ID dari tabel persil
            $table->string('file_name');           // Nama file saja
            $table->string('caption')->nullable(); // Keterangan file
            $table->string('mime_type');           // jpg, pdf, dll
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Index untuk mempercepat query (Opsional tapi disarankan)
            $table->index(['ref_table', 'ref_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
