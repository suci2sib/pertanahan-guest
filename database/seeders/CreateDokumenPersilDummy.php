<?php

namespace Database\Seeders;

use App\Models\DokumenPersil;
use App\Models\Media;
use App\Models\Persil;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateDokumenPersilDummy extends Seeder
{
    public function run(): void
    {
        // Inisialisasi Faker dengan locale Indonesia
        $faker = Faker::create('id_ID');

        // Pastikan tabel Persil sudah terisi data, ambil semua ID Persil yang ada
        $persilIds = Persil::pluck('persil_id')->toArray();

        // Jika tidak ada data Persil, kita tidak bisa membuat Dokumen Persil
        if (empty($persilIds)) {
            $this->command->info('Tidak ada data Persil. Jalankan PersilSeeder terlebih dahulu!');
            return;
        }

        // --- Hapus Data Lama dan Folder Dummy ---
        DokumenPersil::truncate();
        Media::where('ref_table', 'dokumen_persil')->delete();
        Storage::disk('public')->deleteDirectory('uploads/dokumen_persil');

        // Buat folder dummy di storage (jika belum ada)
        Storage::disk('public')->makeDirectory('uploads/dokumen_persil');

        $jenisDokumen = [
            'Sertifikat Hak Milik (SHM)',
            'Akta Jual Beli (AJB)',
            'Surat Keterangan Tanah (SKT)',
            'Surat Izin Mendirikan Bangunan (IMB)',
            'Peta Lokasi',
        ];

        // Buat 50 Data Dokumen Persil Dummy
        for ($i = 0; $i < 50; $i++) {
            // 1. Buat Dokumen Persil
            $dokumen = DokumenPersil::create([
                'persil_id' => $faker->randomElement($persilIds), // FK ke Persil random
                'jenis_dokumen' => $faker->randomElement($jenisDokumen),
                'nomor' => $faker->bothify('DOK-###/??-####'), // Contoh: DOK-123/AB-2025
                'keterangan' => $faker->text(200),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);

            // 2. Buat Entry Media Dummy (1-3 file per Dokumen)
            $jumlahFile = $faker->numberBetween(1, 3);
            for ($j = 1; $j <= $jumlahFile; $j++) {
                $fileExtension = $faker->randomElement(['jpg', 'png', 'pdf', 'docx']);
                $fileName = 'file_' . $dokumen->dokumen_id . '_' . $j . '.' . $fileExtension;

                // Simulasikan pembuatan file dummy (file kosong) di storage
                $dummyPath = 'uploads/dokumen_persil/' . $fileName;
                Storage::disk('public')->put($dummyPath, 'Isi file dummy '.$dokumen->jenis_dokumen.' - '.$dokumen->nomor);

                Media::create([
                    'ref_table' => 'dokumen_persil',
                    'ref_id' => $dokumen->dokumen_id,
                    'file_name' => $fileName,
                    'caption' => 'Lampiran ' . $dokumen->jenis_dokumen . ' - ' . $faker->word() . ' ('.$j.')',
                    'mime_type' => ($fileExtension == 'pdf' ? 'application/pdf' : ($fileExtension == 'docx' ? 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' : 'image/'.$fileExtension)),
                    'sort_order' => $j,
                ]);
            }
        }
    }
}
