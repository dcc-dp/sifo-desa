<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use App\Models\Rw;
use App\Models\Rt;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function statistikPenduduk(Request $request)
    {
        $rw = $request->rw;
        $rt = $request->rt;

        $query = DataPenduduk::query();
        if ($rw) $query->where('rw_id', $rw);
        if ($rt) $query->where('rt_id', $rt);

        $totalPenduduk = $query->count();
        $laki      = (clone $query)->where('jenis_kelamin', 'L')->count();
        $perempuan = (clone $query)->where('jenis_kelamin', 'P')->count();

        $rwList = Rw::all();
        $rtList = $rw ? Rt::where('rw_id', $rw)->get() : collect();

        return view('pages.datastatik.penduduk', compact(
            'totalPenduduk', 'laki', 'perempuan', 'rw', 'rt', 'rwList', 'rtList'
        ));
    }

    public function statistikAgama(Request $request)
    {
        $rw = $request->get('rw');
        $rt = $request->get('rt');

        $query = DataPenduduk::query();
        if ($rw) $query->where('rw_id', $rw);
        if ($rt) $query->where('rt_id', $rt);

        $islam    = (clone $query)->where('agama', 'Islam')->count();
        $kristen  = (clone $query)->where('agama', 'Kristen')->count();
        $katolik  = (clone $query)->where('agama', 'Katolik')->count();
        $hindu    = (clone $query)->where('agama', 'Hindu')->count();
        $budha    = (clone $query)->where('agama', 'Budha')->count();
        $konghucu = (clone $query)->where('agama', 'Konghucu')->count();

        $rwList = Rw::all();
        $rtList = $rw ? Rt::where('rw_id', $rw)->get() : collect();

        return view('pages.datastatik.agama', compact(
            'islam', 'kristen', 'katolik', 'hindu', 'budha', 'konghucu',
            'rw', 'rt', 'rwList', 'rtList'
        ));
    }

    public function statistikPekerjaan(Request $request)
    {
        $rw = $request->get('rw');
        $rt = $request->get('rt');

        $query = DataPenduduk::query();
        if ($rw) $query->where('rw_id', $rw);
        if ($rt) $query->where('rt_id', $rt);

        $petani     = (clone $query)->where('pekerjaan', 'Petani')->count();
        $buruh      = (clone $query)->where('pekerjaan', 'Buruh')->count();
        $wiraswasta = (clone $query)->where('pekerjaan', 'Wiraswasta')->count();
        $pns        = (clone $query)->where('pekerjaan', 'PNS')->count();
        $total      = $petani + $buruh + $wiraswasta + $pns;

        $rwList = Rw::all();
        $rtList = $rw ? Rt::where('rw_id', $rw)->get() : collect();

        return view('pages.datastatik.pekerjaan', compact(
            'petani', 'buruh', 'wiraswasta', 'pns', 'total',
            'rw', 'rt', 'rwList', 'rtList'
        ));
    }

    public function statistikPendidikan(Request $request)
    {
        $rw = $request->get('rw');
        $rt = $request->get('rt');

        $query = DataPenduduk::query();
        if ($rw) $query->where('rw_id', $rw);
        if ($rt) $query->where('rt_id', $rt);

        $tidakSekolah = (clone $query)->where('pendidikan', 'Tidak Sekolah')->count();
        $sd           = (clone $query)->where('pendidikan', 'SD')->count();
        $smp          = (clone $query)->where('pendidikan', 'SMP')->count();
        $sma          = (clone $query)->where('pendidikan', 'SMA')->count();
        $diploma      = (clone $query)->whereIn('pendidikan', ['D3', 'S1'])->count();
        $total        = $tidakSekolah + $sd + $smp + $sma + $diploma;

        $rwList = Rw::all();
        $rtList = $rw ? Rt::where('rw_id', $rw)->get() : collect();

        return view('pages.datastatik.pendidikan', compact(
            'tidakSekolah', 'sd', 'smp', 'sma', 'diploma', 'total',
            'rw', 'rt', 'rwList', 'rtList'
        ));
    }
}