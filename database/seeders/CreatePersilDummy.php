<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Warga;

class CreatePersilDummy extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua warga_id untuk dijadikan pemilik acak
        $wargaIds = Warga::pluck('warga_id')->toArray();

        // Pastikan ada data warga terlebih dahulu
        if (empty($wargaIds)) {
            $this->command->warn('⚠️  Tidak ada data warga. Jalankan seeder CreateWargaDummy terlebih dahulu.');
            return;
        }

        for ($i = 0; $i < 30; $i++) {
            DB::table('persil')->insert([
                'kode_persil'      => strtoupper('PRS-' . $faker->unique()->bothify('##??##')),
                'pemilik_warga_id' => $faker->randomElement($wargaIds),
                'luas_m2'          => $faker->numberBetween(100, 5000),
                'penggunaan'       => $faker->randomElement(['Sawah', 'Kebun', 'Perumahan', 'Ruko', 'Lahan Kosong']),
                'alamat_lahan'     => $faker->address(),
                'rt'               =>  strtoupper('00' . $faker->numberBetween(1, 10)),
                'rw'               => strtoupper('00' . $faker->numberBetween(1, 5)),
            ]);
        }

        $this->command->info('✅ Data dummy persil berhasil dibuat!');
    }
}
