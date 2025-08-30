<?php

namespace Database\Seeders;

use App\Models\dataPenduduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        dataPenduduk::create([
            'nik' => '7301010101010001',
            'nama' => 'Ahmad Fauzi',
            'tempat_lahir' => 'Makassar',
            'tanggal_lahir' => '1995-05-20',
            'alamat' => 'Jl. Merdeka No. 10',
            'rt' => '01',
            'rw' => '02',
            'keldesa' => 'Kalosi',
            'kecamatan' => 'Alla',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Mahasiswa',
            'kewarganegaraan' => 'WNI',
        ]);

        dataPenduduk::create([
            'nik' => '7301010101010002',
            'nama' => 'Siti Aminah',
            'tempat_lahir' => 'Enrekang',
            'tanggal_lahir' => '1998-08-15',
            'alamat' => 'Jl. Pahlawan No. 25',
            'rt' => '03',
            'rw' => '04',
            'keldesa' => 'Kalosi',
            'kecamatan' => 'Alla',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Ibu Rumah Tangga',
            'kewarganegaraan' => 'WNI',
        ]);
    }
}
