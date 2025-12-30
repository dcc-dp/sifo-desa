<?php

namespace App\Http\Controllers;

use App\Models\dataPenduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function statistikPenduduk(Request $request)
    {

        $rw = $request->rw;
        $rt = $request->rt;


        $query = dataPenduduk::query();

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
}
