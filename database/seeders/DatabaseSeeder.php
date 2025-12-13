<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan SEEDER PENTING!
        $this->call([
            CreateFirstUser::class,        // 1. User utama dulu
            CreateUserDummy::class,        // 2. User dummy
            CreateWargaDummy::class,       // 3. Warga (butuh user untuk relasi)
            CreateJenisPenggunaanDummy::class, // 4. Jenis Penggunaan
            CreatePersilDummy::class,      // 5. Persil (butuh warga dan jenis penggunaan)
        ]);
        
        $this->command->info('✅ Semua seeder berhasil dijalankan!');
        $this->command->info('📋 Data yang dibuat:');
        $this->command->info('   - 1 User utama (Admin)');
        $this->command->info('   - 100 User dummy');
        $this->command->info('   - 100 Warga dummy');
        $this->command->info('   - 100 Jenis Penggunaan dummy');
        $this->command->info('   - 100 Persil dummy');
    }
}