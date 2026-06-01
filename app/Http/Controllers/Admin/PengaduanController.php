<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::with('kategori', 'user')
            ->latest()
            ->get();

        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    public function create()
    {
        if (!session()->has('pengaduan_penduduk_id')) {

            return redirect()
                ->route('pengaduan.login-form');
        }

        $kategoris = Kategori::all();

        $pengaduans = Pengaduan::where(
            'user_id',
            session('pengaduan_penduduk_id')
        )->latest()->get();

        return view(
            'pages.layananonline.pengaduan',
            compact('kategoris', 'pengaduans')
        );
    }

    public function store(Request $request)
    {
        if (!session()->has('pengaduan_penduduk_id')) {

            return redirect()
                ->route('pengaduan.login-form');
        }

        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
            'file' => 'nullable|mimes:pdf',
        ]);

        $validated['user_id'] = session('pengaduan_penduduk_id');

        $validated['anonymous'] = $request->has('anonymous') ? 1 : 0;

        $validated['status'] = 1;

        if ($request->hasFile('gambar')) {

            $gambar = time() . '_gambar.' . $request->gambar->extension();

            $request->gambar->move(
                public_path('upload/pengaduan'),
                $gambar
            );

            $validated['gambar'] = 'upload/pengaduan/' . $gambar;
        }

        if ($request->hasFile('file')) {

            $file = time() . '_file.' . $request->file->extension();

            $request->file->move(
                public_path('upload/file'),
                $file
            );

            $validated['file'] = 'upload/file/' . $file;
        }

        Pengaduan::create($validated);

        return redirect()
            ->route('pengaduan')
            ->with('success', 'Pengaduan berhasil dikirim');
    }

    public function detailpengaduan($id)
    {
        $pengaduan = Pengaduan::with('kategori', 'user')
            ->findOrFail($id);

        return view(
            'pages.layananonline.detailpengaduan',
            compact('pengaduan')
        );
    }

    public function riwayat()
    {
        if (!session()->has('pengaduan_penduduk_id')) {

            return redirect()
                ->route('pengaduan.login-form');
        }

        $pengaduans = Pengaduan::where(
            'user_id',
            session('pengaduan_penduduk_id')
        )->latest()->get();

        $kategoris = Kategori::all();

        return view(
            'pages.layananonline.pengaduan',
            compact('pengaduans', 'kategoris')
        );
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::with('kategori')
            ->findOrFail($id);

        $kategoris = Kategori::all();

        return view(
            'admin.pengaduan.edit',
            compact('pengaduan', 'kategoris')
        );
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:1,2,3'
        ]);

        $pengaduan->update([
            'status' => $request->status
        ]);

        return redirect()
            ->route('pengaduan-index')
            ->with('success', 'Status pengaduan berhasil diperbarui');
    }
}