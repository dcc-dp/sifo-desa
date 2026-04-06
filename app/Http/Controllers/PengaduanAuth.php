<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPenduduk;
use Illuminate\Support\Facades\Session;

class PengaduanAuth extends Controller
{
    /**
     * Show login form with NIK
     */
    public function showLoginForm()
    {
        return view('pages.auth.pengaduan-login');
    }

    /**
     * Handle NIK login
     */
    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16|exists:data_penduduks,nik'
        ], [
            'nik.required' => 'NIK harus diisi',
            'nik.digits' => 'NIK harus terdiri dari 16 angka',
            'nik.exists' => 'NIK tidak terdaftar dalam sistem'
        ]);

        // Get penduduk by NIK
        $penduduk = DataPenduduk::where('nik', $request->nik)->firstOrFail();

        // Store session for pengaduan
        Session::put('pengaduan_nik', $request->nik);
        Session::put('pengaduan_penduduk_id', $penduduk->id);
        Session::put('pengaduan_penduduk_name', $penduduk->nama);

        return redirect()->route('pengaduan')->with('success', 'Silakan lanjutkan pengaduan Anda');
    }

    /**
     * Logout from pengaduan
     */
    public function logout()
    {
        Session::forget(['pengaduan_nik', 'pengaduan_penduduk_id', 'pengaduan_penduduk_name']);
        return redirect('/')->with('success', 'Logout berhasil');
    }
}
