<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sejarah;

class SejarahSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Tahun 1950 – Awal Pembentukan Desa',
                'deskripsi' => 'Pada tahun ini, beberapa keluarga mulai menetap dan membuka lahan. Mereka membangun rumah-rumah sederhana dari kayu dan bambu. Pada masa ini juga mulai terbentuk kelompok masyarakat yang mengatur kehidupan bersama.',
                'gambar' => 'upload/sejarah/sejarah1.jpg',
            ],
            [
                'judul' => 'Tahun 1960 – Pembentukan Pemerintahan Desa',
                'deskripsi' => 'Pemerintahan desa mulai dibentuk secara resmi dengan adanya kepala desa pertama yang dipilih oleh masyarakat. Pada masa ini juga mulai dibuat pembagian wilayah dusun untuk mempermudah pengelolaan administrasi dan pelayanan masyarakat.',
                'gambar' => 'upload/sejarah/sejarah2.jpg',
            ],
            [
                'judul' => 'Tahun 1975 – Pembangunan Infrastruktur Dasar',
                'deskripsi' => 'Pemerintah mulai membangun fasilitas dasar seperti jalan desa, balai desa, dan sarana pendidikan berupa sekolah dasar.',
                'gambar' => 'upload/sejarah/sejarah3.jpg',
            ],
            [
                'judul' => 'Tahun 1990 – Peningkatan Sarana Sosial dan Ekonomi',
                'deskripsi' => 'Pada periode ini dilakukan pembangunan pasar desa, tempat ibadah, dan pos kesehatan desa (Posyandu).',
                'gambar' => 'upload/sejarah/sejarah4.jpg',
            ],
            [
                'judul' => 'Tahun 2005 – Pengembangan Fasilitas Umum',
                'deskripsi' => 'Pemerintah desa bersama masyarakat melakukan berbagai pembangunan seperti perbaikan jalan dan pembangunan saluran irigasi.',
                'gambar' => 'upload/sejarah/sejarah5.jpg',
            ],
            [
                'judul' => 'Tahun 2015 – Pembangunan Berbasis Desa',
                'deskripsi' => 'Dengan adanya program dana desa dari pemerintah, desa mulai melakukan pembangunan yang lebih terarah.',
                'gambar' => 'upload/sejarah/sejarah6.jpg',
            ],
            [
                'judul' => 'Tahun 2025 – Desa Berkembang dan Mandiri',
                'deskripsi' => 'Saat ini desa terus berkembang dengan berbagai program pembangunan dan pemberdayaan masyarakat.',
                'gambar' => 'upload/sejarah/sejarah7.jpg',
            ]
        ];

        foreach ($data as $item) {
            Sejarah::create($item);
        }
    }
}