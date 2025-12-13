<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    public function run(): void
    {
        // User Super Admin utama
        if (!User::where('email', 'superadmin@pertanahan.test')->exists()) {
            User::create([
                'name'     => 'Super Admin',
                'email'    => 'superadmin@pertanahan.test',
                'password' => Hash::make('Admin123'),
                'role'     => 'Super Admin',
            ]);
            
            $this->command->info('✅ Super Admin berhasil dibuat!');
            $this->command->info('   Email: superadmin@pertanahan.test');
            $this->command->info('   Password: Admin123');
            $this->command->info('   Role: Super Admin');
        }
        
        // User Admin contoh
        if (!User::where('email', 'admin@pertanahan.test')->exists()) {
            User::create([
                'name'     => 'Administrator',
                'email'    => 'admin@pertanahan.test',
                'password' => Hash::make('Admin123'),
                'role'     => 'Admin',
            ]);
            
            $this->command->info('✅ Admin berhasil dibuat!');
            $this->command->info('   Email: admin@pertanahan.test');
            $this->command->info('   Password: Admin123');
            $this->command->info('   Role: Admin');
        }
        
        // User biasa contoh
        if (!User::where('email', 'user@pertanahan.test')->exists()) {
            User::create([
                'name'     => 'Regular User',
                'email'    => 'user@pertanahan.test',
                'password' => Hash::make('User123'),
                'role'     => 'User',
            ]);
            
            $this->command->info('✅ User biasa berhasil dibuat!');
            $this->command->info('   Email: user@pertanahan.test');
            $this->command->info('   Password: User123');
            $this->command->info('   Role: User');
        }
    }
}