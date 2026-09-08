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

        // Modul dasar aplikasi (sesuai middleware routes & controller)
        $baseModules = [
            'roles',
            'users',
            'surat',
            'berita',
            'pengaduan',
            'pemerintah',
            'menus',
            'penduduk',
            'rt',
            'rw',
            'galeri',
            'sejarah',
            'kategori',
            'agenda',
            'setting'
        ];

        // Ambil juga modul dari menu dinamis jika ada
        $dynamicMenus = \App\Models\Menu::where('is_header', false)->get();
        $menuModules = [];
        foreach ($dynamicMenus as $m) {
            $menuModules[] = \Illuminate\Support\Str::slug($m->title, '_');
        }

        $modules = array_unique(array_merge($baseModules, $menuModules));

        $actions = ['view', 'create', 'edit', 'delete'];
        $validPermissionNames = [];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $permName = "{$action}_{$module}";
                Permission::firstOrCreate(['name' => $permName]);
                $validPermissionNames[] = $permName;
            }
        }

        // Hapus permission lama yang tidak terpakai lagi (stale permissions)
        Permission::whereNotIn('name', $validPermissionNames)->delete();

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
