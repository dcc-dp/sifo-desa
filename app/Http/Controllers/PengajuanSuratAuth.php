<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPenduduk;
use Illuminate\Support\Facades\Session;

class PengajuanSuratAuth extends Controller
{
    /**
     * Show login form with NIK
     */
    public function showLoginForm()
    {
        return view('pages.auth.pengajuan-login');
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

        // Store session for pengajuan surat
        Session::put('pengajuan_nik', $request->nik);
        Session::put('pengajuan_penduduk_id', $penduduk->id);
        Session::put('pengajuan_penduduk_name', $penduduk->nama);

        return redirect()->route('pengajuan')->with('success', 'Silakan lanjutkan pengajuan surat Anda');
    }

    /**
     * Logout from pengajuan surat
     */
    public function logout()
    {
        Session::forget(['pengajuan_nik', 'pengajuan_penduduk_id', 'pengajuan_penduduk_name']);
        return redirect('/')->with('success', 'Logout berhasil');
    }
}
