<?php

namespace Database\Seeders;

use App\Models\SengketaPersil;
use App\Models\Persil;
use App\Models\Media;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class CreateSengketaPersilDummy extends Seeder
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
        SengketaPersil::truncate();
        Media::where('ref_table', 'sengketa_persil')->delete();
        Storage::disk('public')->deleteDirectory('uploads/sengketa_persil');

        // Buat folder dummy di storage (jika belum ada)
        Storage::disk('public')->makeDirectory('uploads/sengketa_persil');

        $statuses = ['ditolak', 'diterima', 'diproses'];
        $jumlahSengketa = 30;

        for ($i = 0; $i < $jumlahSengketa; $i++) {

            $status = $faker->randomElement($statuses);

            // 1. Buat Data Sengketa Persil
            $sengketa = SengketaPersil::create([
                'persil_id' => $faker->randomElement($persilIds),
                'pihak_1' => $faker->firstName($faker->randomElement(['male', 'female'])) . ' ' . $faker->lastName(),
                'pihak_2' => ($faker->boolean(80)) ? ($faker->firstName($faker->randomElement(['male', 'female'])) . ' ' . $faker->lastName()) : null,
                'kronologi' => 'Pada tanggal ' . $faker->date('d M Y') . ', terjadi sengketa kepemilikan. ' . $faker->paragraph(3, true),
                'status' => $status,
                'penyelesaian' => ($status != 'diproses') ? $faker->text(150) : null,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);

            // 2. Buat Entry Media Dummy (1-2 file per Sengketa)
            $jumlahFile = $faker->numberBetween(1, 2);
            for ($j = 1; $j <= $jumlahFile; $j++) {
                $fileExtension = $faker->randomElement(['jpg', 'pdf']);
                $fileName = 'bukti_' . $sengketa->sengketa_id . '_' . $j . '.' . $fileExtension;

                // Simulasikan pembuatan file dummy (file kosong) di storage
                $dummyPath = 'uploads/sengketa_persil/' . $fileName;
                Storage::disk('public')->put($dummyPath, 'Isi file bukti sengketa - '.$sengketa->status);

                Media::create([
                    'ref_table' => 'sengketa_persil',
                    'ref_id' => $sengketa->sengketa_id,
                    'file_name' => $fileName,
                    'caption' => 'Bukti ' . ($sengketa->pihak_2 ? 'Pihak 1 vs Pihak 2' : 'Pelaporan') . ' ('.$j.')',
                    'mime_type' => ($fileExtension == 'pdf' ? 'application/pdf' : 'image/jpeg'),
                    'sort_order' => $j,
                ]);
            }
        }
    }
}
