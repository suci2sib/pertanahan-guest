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
        Schema::create('dokumen_persil', function (Blueprint $table) {

            $table->id('dokumen_id');
            $table->foreignId('persil_id')
                ->constrained(
                    'persil',
                    'persil_id')
                ->onDelete('cascade');
            $table->string('jenis_dokumen', 255)->nullable(false);
            $table->string('nomor', 255)->nullable();
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_persil');
    }
};
