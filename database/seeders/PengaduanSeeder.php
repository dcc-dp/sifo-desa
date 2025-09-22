<?php

namespace Database\Seeders;

use App\Models\Pengaduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'user_id'     => 1,
                'judul'       => 'Jalan Rusak di RT 03',
                'gambar'      => 'upload/pengaduan/pengaduan1.jpg',
                'deskripsi'   => 'Jalan di RT 03 sangat rusak dan sulit dilalui, mohon perbaikan segera.',
                'file'        => 'upload/file/file.pdf',
                'status'      => 1,
                'anonymous'  => false,
            ],
            [
                'kategori_id' => 2,
                'user_id'     => 2,
                'judul'       => 'Lampu Jalan Mati',
                'gambar'      => 'upload/pengaduan/pengaduan2.jpg',
                'deskripsi'   => 'Lampu jalan di sekitar pasar tidak berfungsi, membuat malam hari menjadi gelap dan rawan kecelakaan.',
                'file'        => 'upload/file/file.pdf',
                'status'      => 2,
                'anonymous'  => true,
            ],
            [
                'kategori_id' => 3,
                'user_id'     => 3,
                'judul'       => 'Sampah Menumpuk di Sungai',
                'gambar'      => 'upload/pengaduan/pengaduan3.jpg',
                'deskripsi'   => 'Sungai di dekat pemukiman warga dipenuhi sampah, menyebabkan bau tidak sedap dan potensi banjir.',
                'file'        => 'upload/file/file.pdf',
                'status'      => 3,
                'anonymous'  => false,
            ],
        ];
        Pengaduan::insert($data);
    }
}
