<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUserDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        
        $this->command->info('📊 Membuat 100 user dummy...');

        foreach (range(1, 100) as $index) {
            User::create([
                'name'     => $faker->name,
                'email'    => $faker->unique()->safeEmail,
                'password' => Hash::make('Password123'), // Password default yang lebih aman
                'role'     => $faker->randomElement(['Admin', 'User']), // TAMBAH ROLE
            ]);
        }
        
        $this->command->info('✅ 100 user dummy berhasil dibuat!');
        $this->command->info('   Password default: Password123');
        $this->command->info('   Role: Admin atau User acak');
    }
}