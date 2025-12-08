<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\dataPenduduk;
use App\Models\PemerintahDesa;
use App\Models\Pengaduan;
use App\Models\Surat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendudukCount = dataPenduduk::count();
        $beritaCount = Berita::count();
        $pengaduanCount = Pengaduan::count();
        $pemerintahanCount = PemerintahDesa::count();
       return view('admin.dashboard', compact('pendudukCount', 'beritaCount', 'pengaduanCount', 'pemerintahanCount'));

    }   
}
