<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            [
                'id_kategori' => 1,
                'judul'       => 'Peningkatan Sarana Pendidikan di Desa',
                'slug' => Str::slug('Peningkatan Sarana Pendidikan di Desa'),
                'deskripsi'   => 'Desa kami telah melakukan peningkatan sarana pendidikan dengan membangun perpustakaan baru dan memperbaiki fasilitas sekolah.',
                'gambar'      => 'upload/berita/berita1.1.png',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_kategori' => 1,
                'judul'       => 'Peningkatan Barang Pendidikan di Desa',
                'slug' => Str::slug(title: 'Peningkatan Barang Pendidikan di Desa'),
                'deskripsi'   => 'Desa kami telah melakukan peningkatan barang pendidikan dengan membangun perpustakaan baru dan memperbaiki fasilitas sekolah.',
                'gambar'      => 'upload/berita/berita1.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_kategori' => 2,
                'judul'       => 'Gizi Kepada Masyarakat',
                'slug' => Str::slug('Gizi Kepada Masyarakat'),
                'deskripsi'   => 'Kami mengadakan pemberian gizi kepada masyarakat desa untuk meningkatkan imun dan kesadaran hidup sehat.',
                'gambar'      => 'upload/berita/berita2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_kategori' => 2,
                'judul'       => 'Gizi Kepada Anak-anak Desa',
                'slug' => Str::slug('Gizi Kepada Anak-anak Desa'),
                'deskripsi'   => 'Kami mengadakan pemberian gizi kepada anak-anak desa untuk meningkatkan kesehatan dan imun.',
                'gambar'      => 'upload/berita/berita2.1.png',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_kategori' => 3,
                'judul'       => 'Pembangunan Jalan Desa',
                'slug' => Str::slug('Pembangunan Jalan Desa'),
                'deskripsi'   => 'Pembangunan jalan desa telah selesai, memudahkan akses transportasi bagi warga.',
                'gambar'      => 'upload/berita/berita3.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_kategori' => 3,
                'judul'       => 'Pembangunan Jalan Baru di Desa',
                'slug' => Str::slug('Pembangunan Jalan Baru di Desa'),
                'deskripsi'   => 'Pembangunan jalan baru di desa telah selesai dan meningkatkan konektivitas antar desa.',
                'gambar'      => 'upload/berita/berita3.1.png',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_kategori' => 4,
                'judul'       => 'Pelatihan Pertanian Modern',
                'slug' => Str::slug('Pelatihan Pertanian Modern'),
                'deskripsi'   => 'Kami mengadakan pelatihan pertanian modern untuk meningkatkan hasil panen.',
                'gambar'      => 'upload/berita/berita4.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id_kategori' => 4,
                'judul'       => 'Pelatihan Perkebunan Modern',
                'slug' => Str::slug('Pelatihan Perkebunan Modern'),
                'deskripsi'   => 'Pelatihan perkebunan modern untuk membantu petani mengadopsi teknologi terbaru.',
                'gambar'      => 'upload/berita/berita4.1.png',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        Berita::insert($data);
    }
}
