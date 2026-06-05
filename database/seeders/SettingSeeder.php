<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([

            'nama_desa'  => 'Desa Harapan Hijau',
            'deskripsi'  => 'Desa Harapan Hijau merupakan desa pelayanan publik berbasis teknologi informasi. Melalui Sistem Informasi Desa (SIFO Desa), masyarakat dapat mengakses informasi, layanan administrasi, pengaduan, dan berbagai kegiatan desa secara cepat, transparan, dan mudah.',
            'alamat'     => 'Jl. Poros Parangloe No. 1, Desa Harapan Hijau, Kecamatan Parangloe, Kabupaten Gowa, Sulawesi Selatan 92174',
            'email'      => 'info@harapanhijau.desa.id',
            'telepon'    => '0411-876543',
            'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1043882.6748422635!2d139.25882874614518!3d35.58418385230075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x605d1b87f02e57e7%3A0x2e01618b22571b89!2sTokyo%2C%20Jepang!5e0!3m2!1sid!2sid!4v1780628305162!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade',
            'facebook'   => 'https://facebook.com/desaharapanhijau',
            'instagram'  => 'https://instagram.com/desaharapanhijau',
            'twitter'    => 'https://x.com/desaharapanhijau ',

        ]);
    }
}
   