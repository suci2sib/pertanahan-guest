<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateWargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        $this->command->info('📊 Membuat 100 warga dummy...');

        for ($i = 0; $i < 100; $i++) {
            DB::table('warga')->insert([
                'no_ktp'        => $faker->numerify('################'), // 16 digit angka acak
                'nama'          => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama'         => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']),
                'pekerjaan'     => $faker->jobTitle(),
                'telp'          => $faker->phoneNumber(),
                'email'         => $faker->unique()->safeEmail(),
                'created_at'    => now(), // TAMBAH
                'updated_at'    => now(), // TAMBAH
            ]);
        }
        
        $this->command->info('✅ 100 warga dummy berhasil dibuat!');
    }
}