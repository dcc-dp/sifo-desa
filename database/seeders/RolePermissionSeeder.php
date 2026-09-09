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
            'setting',
            'setting_surat',
            'setting_desa'
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

        // Buat role Admin dan beri hak akses operasional desa lengkap (kecuali roles, menus, dan identitas utama)
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $adminPermissions = [
            'view_penduduk', 'create_penduduk', 'edit_penduduk', 'delete_penduduk',
            'view_data_penduduk', 'create_data_penduduk', 'edit_data_penduduk', 'delete_data_penduduk',
            'view_rt', 'create_rt', 'edit_rt', 'delete_rt',
            'view_rw', 'create_rw', 'edit_rw', 'delete_rw',
            'view_galeri', 'create_galeri', 'edit_galeri', 'delete_galeri',
            'view_batch_galeri', 'create_batch_galeri', 'edit_batch_galeri', 'delete_batch_galeri',
            'view_sejarah', 'create_sejarah', 'edit_sejarah', 'delete_sejarah',
            'view_sejarah_desa', 'create_sejarah_desa', 'edit_sejarah_desa', 'delete_sejarah_desa',
            'view_agenda', 'create_agenda', 'edit_agenda', 'delete_agenda',
            'view_agenda_kegiatan', 'create_agenda_kegiatan', 'edit_agenda_kegiatan', 'delete_agenda_kegiatan',
            'view_kategori', 'create_kategori', 'edit_kategori', 'delete_kategori',
            'view_berita', 'create_berita', 'edit_berita', 'delete_berita',
            'view_berita_desa', 'create_berita_desa', 'edit_berita_desa', 'delete_berita_desa',
            'view_surat', 'create_surat', 'edit_surat', 'delete_surat',
            'view_pengaduan', 'create_pengaduan', 'edit_pengaduan', 'delete_pengaduan',
            'view_pemerintah', 'create_pemerintah', 'edit_pemerintah', 'delete_pemerintah',
            'view_pemerintah_desa', 'create_pemerintah_desa', 'edit_pemerintah_desa', 'delete_pemerintah_desa',
            'view_setting_surat', 'edit_setting_surat',
            'view_setting_desa', 'edit_setting_desa',
            'view_profil_desa', 'create_profil_desa', 'edit_profil_desa', 'delete_profil_desa',
            'view_users', 'create_users', 'edit_users', 'delete_users',
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
