<?php

namespace Database\Seeders;

use App\Models\PetaPersil;
use App\Models\Persil;
use App\Models\Media;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class CreatePetaPersilDummy extends Seeder
{
    public function run(): void
    {
        // Inisialisasi Faker dengan locale Indonesia
        $faker = Faker::create('id_ID');

        // Ambil semua ID Persil yang ada
        $persilIds = Persil::pluck('persil_id')->toArray();

        if (empty($persilIds)) {
            $this->command->info('Tidak ada data Persil. Jalankan PersilSeeder terlebih dahulu!');
            return;
        }

        // --- Bersihkan Data Lama dan Folder Dummy ---
        // Catatan: Karena PetaPersil adalah One-to-One dengan Persil,
        // kita tidak perlu menggunakan truncate, tapi kita hanya membuat data
        // untuk Persil yang belum punya peta.

        // Hapus media lama yang terkait dengan peta_persil
        Media::where('ref_table', 'peta_persil')->delete();
        Storage::disk('public')->deleteDirectory('uploads/peta_persil');

        // Buat folder dummy di storage (jika belum ada)
        Storage::disk('public')->makeDirectory('uploads/peta_persil');

        // Ambil ID Persil yang sudah memiliki peta
        $persilIdsWithMap = PetaPersil::pluck('persil_id')->toArray();
        $availablePersilIds = array_diff($persilIds, $persilIdsWithMap);

        if (empty($availablePersilIds)) {
             $this->command->info('Semua Persil sudah memiliki Peta. Tidak ada data Peta Persil baru yang dibuat.');
            return;
        }

        $jumlahPeta = min(30, count($availablePersilIds));
        $persilToMap = $faker->randomElements($availablePersilIds, $jumlahPeta, false);

        $petaCounter = 0;

        foreach ($persilToMap as $persilId) {

            $panjang = $faker->randomFloat(2, 10, 100);
            $lebar = $faker->randomFloat(2, 10, 80);

            // 1. Buat Data Peta Persil
            $peta = PetaPersil::create([
                'persil_id' => $persilId,
                'panjang_m' => $panjang,
                'lebar_m' => $lebar,
                'geojson' => [
                    'type' => 'Polygon',
                    'coordinates' => [
                        // Dummy coordinates based on Faker
                        [$faker->latitude(), $faker->longitude()],
                        [$faker->latitude(), $faker->longitude()],
                        [$faker->latitude(), $faker->longitude()],
                        [$faker->latitude(), $faker->longitude()],
                    ]
                ],
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-6 months', 'now'),
            ]);

            $petaCounter++;

            // 2. Buat Entry Media Dummy (1-2 file per Peta)
            $jumlahFile = $faker->numberBetween(1, 2);
            for ($j = 1; $j <= $jumlahFile; $j++) {
                $fileExtension = $faker->randomElement(['jpg', 'pdf']);
                $fileName = 'scan_' . $peta->peta_id . '_' . $j . '.' . $fileExtension;

                // Simulasikan pembuatan file dummy di storage
                $dummyPath = 'uploads/peta_persil/' . $fileName;
                Storage::disk('public')->put($dummyPath, 'Isi file scan peta dummy');

                Media::create([
                    'ref_table' => 'peta_persil',
                    'ref_id' => $peta->peta_id,
                    'file_name' => $fileName,
                    'caption' => 'Scan Peta ' . $peta->peta_id . ' - Skala ' . $faker->randomNumber(4) . ' ('.$j.')',
                    'mime_type' => ($fileExtension == 'pdf' ? 'application/pdf' : 'image/jpeg'),
                    'sort_order' => $j,
                ]);
            }
        }

        $this->command->info("Berhasil membuat {$petaCounter} data Peta Persil dummy.");
    }
}
