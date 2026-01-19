<?php

namespace Database\Seeders;

use App\Models\Rw;
use App\Models\Rt;
use App\Models\DataPenduduk;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run(): void
    {
       
        $rw02 = Rw::create([
            'nomor_rw' => '02'
        ]);

        $rw04 = Rw::create([
            'nomor_rw' => '04'
        ]);

       
        $rt01 = Rt::create([
            'rw_id' => $rw02->id,
            'nomor_rt' => '01'
        ]);

        $rt03 = Rt::create([
            'rw_id' => $rw04->id,
            'nomor_rt' => '03'
        ]);

        
        DataPenduduk::create([
            'nik' => '7301010101010001',
            'nama' => 'Ahmad Fauzi',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Makassar',
            'tanggal_lahir' => '1995-05-20',
            'alamat' => 'Jl. Merdeka No. 10',
            'rw_id' => $rw02->id,
            'rt_id' => $rt01->id,
            'keldesa' => 'Kalosi',
            'kecamatan' => 'Alla',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Mahasiswa',
            'kewarganegaraan' => 'WNI',
        ]);

        DataPenduduk::create([
            'nik' => '7301010101010002',
            'nama' => 'Siti Aminah',
            'jenis_kelamin' => 'P',
            'tempat_lahir' => 'Enrekang',
            'tanggal_lahir' => '1998-08-15',
            'alamat' => 'Jl. Pahlawan No. 25',
            'rw_id' => $rw04->id,
            'rt_id' => $rt03->id,
            'keldesa' => 'Kalosi',
            'kecamatan' => 'Alla',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Ibu Rumah Tangga',
            'kewarganegaraan' => 'WNI',
        ]);
    }
}
