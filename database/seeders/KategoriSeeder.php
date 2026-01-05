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
            [   'nama_kategori' => 'Pendidikan',
                'slug' => 'pendidikan'
            ],
            [   'nama_kategori' => 'Kesehatan',
                'slug' => 'Kesehatan'
            ],
            [   'nama_kategori' => 'Infrastruktur',
                'slug' => 'Infrastruktur'
            ],
            [   'nama_kategori' => 'Pertanian',
                'slug' => 'Pertanian'
            ],
        ];

        // masukkan data ke tabel kategori
        Kategori::insert($data);
    }
}
