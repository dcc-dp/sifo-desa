<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PemerintahDesa;

class PemerintahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama'    => 'Said Sudirman',
                'jabatan' => 'Kepala Desa',
                'tupoksi' => 'Memimpin penyelenggaraan pemerintahan desa',
                'foto'    => 'upload/pemerintah/cai.jpg',
            ],
            [
                'nama'    => 'Alfina Syarif',
                'jabatan' => 'Sekretaris Desa',
                'tupoksi' => 'Membantu kepala desa dalam bidang administrasi pemerintahan',
                'foto'    => 'upload/pemerintah/cai.jpg',
            ],
            [
                'nama'    => 'Hasniawati',
                'jabatan' => 'Bendahara Desa',
                'tupoksi' => 'Mengelola keuangan desa dengan transparan',
                'foto'    => 'upload/pemerintah/cai.jpg',
            ],
        ];

        foreach ($data as $item) {
            PemerintahDesa::create($item);
        }
    }
}
