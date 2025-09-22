<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Berita;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_kategori' => 1,
                'judul'       => 'Peningkatan Sarana Pendidikan di Desa',
                'deskripsi'   => 'Desa kami telah melakukan peningkatan sarana pendidikan dengan membangun perpustakaan baru dan memperbaiki fasilitas sekolah.',
                'gambar'      => 'upload/berita/berita1.jpg',
            ],
            [
                'id_kategori' => 2,
                'judul'       => 'Kampanye Kesehatan Masyarakat',
                'deskripsi'   => 'Kami mengadakan kampanye kesehatan untuk meningkatkan kesadaran masyarakat tentang pentingnya pola hidup sehat dan pencegahan penyakit.',
                'gambar'      => 'upload/berita/berita2.jpg',
            ],
            [
                'id_kategori' => 3,
                'judul'       => 'Pembangunan Jalan Desa',
                'deskripsi'   => 'Pembangunan jalan desa telah selesai, memudahkan akses transportasi bagi warga dan meningkatkan konektivitas antar wilayah.',
                'gambar'      => 'upload/berita/berita3.jpg',
            ],
            [
                'id_kategori' => 4,
                'judul'       => 'Pelatihan Pertanian Modern',
                'deskripsi'   => 'Kami mengadakan pelatihan pertanian modern untuk membantu petani meningkatkan hasil panen dan mengadopsi teknologi terbaru dalam bercocok tanam.',
                'gambar'      => 'upload/berita/berita4.jpg',
            ],
        ];
        Berita::insert($data);
    }
}
