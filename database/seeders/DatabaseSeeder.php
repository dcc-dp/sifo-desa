<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(PemerintahSeeder::class);
        $this->call(AgendaSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(BeritaSeeder::class);
        $this->call(PengaduanSeeder::class);
        $this->call(DataSeeder::class);
        $this->call(SejarahSeeder::class);
        $this->call(SettingSeeder::class);

        // Buat Akun Super Admin
        $user = User::where('email', 'admin@gmail.com')->first();
        if (!$user) {
            $user = User::create([
                'nik_id' => '1234567890123456',
                'email_verified_at' => now(),
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'about' => "Hi, I’m admin",
            ]);
        }

        // Seed Roles & Permissions serta Menu Management
        $this->call(RolePermissionSeeder::class);
        $this->call(MenuSeeder::class);
    }
}
