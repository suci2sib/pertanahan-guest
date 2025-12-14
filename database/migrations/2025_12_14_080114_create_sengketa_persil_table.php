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
        Schema::create('sengketa_persil', function (Blueprint $table) {
            $table->id('sengketa_id');

            $table->foreignId('persil_id')
                  ->constrained('persil', 'persil_id')
                  ->onDelete('cascade');

            $table->string('pihak_1', 150);
            $table->string('pihak_2', 150)->nullable();
            $table->text('kronologi');

            // BARIS YANG TELAH DIUBAH: Menggunakan ENUM
            $table->enum('status', ['ditolak', 'diterima', 'diproses'])->default('diproses');

            $table->text('penyelesaian')->nullable();

            $table->timestamps();
        });
    }

    // ... (metode down() tetap sama)
};
