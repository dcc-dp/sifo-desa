<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekNikController extends Controller
{
    public function index()
    {
        return view('account-pages.ceknik');
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'nik_id' => 'required'
        ]);

        $penduduk = DataPenduduk::where('nik', $request->nik_id)->first();

        if (!$penduduk) {
            return back()->with('notfound', 'NIK tidak ditemukan.');
        }

        return redirect()->route('userlogin')
            ->with('success', 'NIK ditemukan, silakan login.');
    }
}
