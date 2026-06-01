<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPenduduk;
use Illuminate\Support\Facades\Session;

class PengaduanAuth extends Controller
{
    public function showLoginForm()
    {
        return view('pages.auth.pengaduan-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16|exists:data_penduduks,nik'
        ], [
            'nik.required' => 'NIK harus diisi',
            'nik.digits' => 'NIK harus terdiri dari 16 angka',
            'nik.exists' => 'NIK tidak terdaftar dalam sistem'
        ]);

        $penduduk = DataPenduduk::where(
            'nik',
            $request->nik
        )->first();

        Session::put('pengaduan_nik', $penduduk->nik);

        Session::put('pengaduan_penduduk_id', $penduduk->id);

        Session::put('pengaduan_penduduk_name', $penduduk->nama);

        return redirect()
            ->route('pengaduan')
            ->with('success', 'Login berhasil');
    }

    public function logout()
    {
        Session::forget([
            'pengaduan_nik',
            'pengaduan_penduduk_id',
            'pengaduan_penduduk_name'
        ]);

        return redirect('/')
            ->with('success', 'Logout berhasil');
    }
}