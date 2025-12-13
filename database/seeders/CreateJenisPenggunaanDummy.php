<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateJenisPenggunaanDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        $this->command->info('📊 Membuat 100 jenis penggunaan dummy...');
        
        $daftarPilihan = [
            'Rumah Tinggal',
            'Sawah',
            'Perkebunan',
            'Kawasan Industri',
            'Fasilitas Umum',
            'Ruko (Rumah Toko)',
            'Taman Kota',
            'Lahan Kosong',
            'Hutan Lindung',
            'Area Pertambangan',
            'Gudang',
            'Tempat Ibadah',
        ];

        for ($i = 1; $i <= 100; $i++) {
            $jenisAcak = $faker->randomElement($daftarPilihan);
            $namaUnik = $jenisAcak . ' - Blok ' . str_pad($i, 3, '0', STR_PAD_LEFT);

            DB::table('jenispenggunaan')->insert([
                'nama_penggunaan' => $namaUnik,
                'keterangan'      => 'Area ' . $jenisAcak . ' yang berlokasi di wilayah ' . $faker->streetName(),
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
        
        $this->command->info('✅ 100 jenis penggunaan dummy berhasil dibuat!');
    }
}