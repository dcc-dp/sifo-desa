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
            'nama_desa'  => 'Desa Cantik',
            'deskripsi'  => 'Portal resmi layanan & informasi Desa Makmur. Bersama membangun desa yang maju, transparan, dan berdaya.',
            'alamat'     => 'Jl. Raya Makmur No. 1, Kec. Sejahtera, Kab. Nusantara',
            'email'      => 'info@desamakmur.go.id',
            'telepon'    => '+62 812-3456-7890',
            'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3270.0882597061013!2d119.47729770000001!3d-5.139387000000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefd00284cd23f%3A0xc96750f4eff4dacc!2sDipanegara%20Computer%20Club!5e1!3m2!1sid!2sid!4v1774896204042!5m2!1sid!2sid',
            'facebook'   => 'https://facebook.com/desamakmur',
            'instagram'  => 'https://instagram.com/desamakmur',
            'twitter'    => 'https://twitter.com/desamakmur',
        ]);
    }
}
