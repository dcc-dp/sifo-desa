<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat permissions
        $modules = [
            'roles',
            'users',
            'surat',
            'berita',
            'pengaduan',
            'pemerintah',
            'menus'
        ];

        $actions = ['view', 'create', 'edit', 'delete'];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "{$action}_{$module}"]);
            }
        }

        // Buat role Super Admin dan beri semua permissions
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $roleSuperAdmin->syncPermissions(Permission::all());

        // Buat role Admin dan beri sebagian permissions (contoh)
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $adminPermissions = [
            'view_surat', 'create_surat', 'edit_surat', 'delete_surat',
            'view_berita', 'create_berita', 'edit_berita', 'delete_berita',
            'view_pengaduan', 'create_pengaduan', 'edit_pengaduan', 'delete_pengaduan',
            'view_pemerintah', 'create_pemerintah', 'edit_pemerintah', 'delete_pemerintah',
        ];
        $roleAdmin->syncPermissions($adminPermissions);

        // Buat role Penduduk
        $rolePenduduk = Role::firstOrCreate(['name' => 'Penduduk']);

        // Cari user yang sudah ada, dan beri role Super Admin ke user pertama
        // Atau buat user baru jika belum ada
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Super Admin',
                'nik_id' => '1234567890123456',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
        
        // Tetapkan role Super Admin ke user pertama
        $user->assignRole($roleSuperAdmin);
    }
}
