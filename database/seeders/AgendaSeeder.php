<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_kegiatan' => 'Musyawarah Desa',
                'waktu_pelaksanaan' => '2025-09-15 10:00:00',
            ],
            [
                'nama_kegiatan' => 'Pelatihan Pertanian',
                'waktu_pelaksanaan' => '2025-09-20 09:00:00',
            ],
            [
                'nama_kegiatan' => 'Peringatan Hari Kemerdekaan',
                'waktu_pelaksanaan' => '2025-08-17 08:00:00',
            ],
        ];

        DB::table('agendas')->insert($data);
    }
}
