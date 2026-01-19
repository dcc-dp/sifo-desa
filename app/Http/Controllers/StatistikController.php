<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function statistikPenduduk(Request $request)
    {

        $rw = $request->rw;
        $rt = $request->rt;


        $query = DataPenduduk::query();

    if ($request->rw) {
        $query->where('rw', $request->rw);
    }

    if ($request->rt) {
        $query->where('rt', $request->rt);
    }

    $totalPenduduk = $query->count();

    $laki = (clone $query)->where('jenis_kelamin', 'L')->count();
    $perempuan = (clone $query)->where('jenis_kelamin', 'P')->count();

    // $kepalaKeluarga = (clone $query)
    //     ->where('status_perkawinan', 'Kawin') 
    //     ->count();

    return view('pages.datastatik.penduduk', compact(
        'totalPenduduk',
        'laki',
        'perempuan',
        'rt', 'rw'
    ));
    }


    public function statistikAgama(Request $request)
    {
        $rw = $request->get('rw');
        $rt = $request->get('rt');
        
        $query = DataPenduduk::query();
        
        if ($rw) {
            $query->where('rw', $rw);
        }
        
        if ($rt) {
            $query->where('rt', $rt);
        }
        
        $islam = (clone $query)->where('agama', 'Islam')->count();
        $kristen = (clone $query)->where('agama', 'Kristen')->count();
        $katolik = (clone $query)->where('agama', 'Katolik')->count();
        $hindu = (clone $query)->where('agama', 'Hindu')->count();
        $budha = (clone $query)->where('agama', 'Budha')->count();
        $konghucu = (clone $query)->where('agama', 'Konghucu')->count();
        
        return view('pages.datastatik.agama', compact(
            'islam', 
            'kristen', 
            'katolik', 
            'hindu', 
            'budha', 
            'konghucu',
            'rw',
            'rt'
        ));
    }

    public function statistikPekerjaan(Request $request)
{
    $rw = $request->get('rw');
    $rt = $request->get('rt');

    $query = DataPenduduk::query();

    if ($rw) {
        $query->where('rw', $rw);
    }

    if ($rt) {
        $query->where('rt', $rt);
    }

    $petani      = (clone $query)->where('pekerjaan', 'Petani')->count();
    $buruh       = (clone $query)->where('pekerjaan', 'Buruh')->count();
    $wiraswasta  = (clone $query)->where('pekerjaan', 'Wiraswasta')->count();
    $pns         = (clone $query)->where('pekerjaan', 'PNS')->count();

    $total = $petani + $buruh + $wiraswasta + $pns;

    return view('pages.datastatik.pekerjaan', compact(
        'petani',
        'buruh',
        'wiraswasta',
        'pns',
        'total',
        'rw',
        'rt'
    ));
}

public function statistikPendidikan(Request $request)
{
    $rw = $request->get('rw');
    $rt = $request->get('rt');

    $query = DataPenduduk::query();

    if ($rw) {
        $query->where('rw', $rw);
    }

    if ($rt) {
        $query->where('rt', $rt);
    }

    $tidakSekolah = (clone $query)->where('pendidikan', 'Tidak Sekolah')->count();
    $sd           = (clone $query)->where('pendidikan', 'SD')->count();
    $smp          = (clone $query)->where('pendidikan', 'SMP')->count();
    $sma          = (clone $query)->where('pendidikan', 'SMA')->count();
    $diploma      = (clone $query)->whereIn('pendidikan', ['D3', 'S1'])->count();

    $total = $tidakSekolah + $sd + $smp + $sma + $diploma;

    return view('pages.datastatik.pendidikan', compact(
        'tidakSekolah',
        'sd',
        'smp',
        'sma',
        'diploma',
        'total',
        'rw',
        'rt'
    ));
}


}
