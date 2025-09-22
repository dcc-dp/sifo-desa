<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [ 'nama_kategori' => 'Pendidikan' ],
            [ 'nama_kategori' => 'Kesehatan' ],
            [ 'nama_kategori' => 'Infrastruktur' ],
            [ 'nama_kategori' => 'Pertanian' ],
        ];

        // masukkan data ke tabel kategori
        Kategori::insert($data);
    }
}
