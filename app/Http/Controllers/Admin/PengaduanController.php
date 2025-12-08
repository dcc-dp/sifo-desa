<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Kategori;
use App\Models\Pengaduan;

use Illuminate\Http\Request;

class PengaduanController extends Controller
{

    public function index()
    {
        $pengaduans = Pengaduan::with('kategori', 'user')->latest()->get();
        return view('admin.pengaduan.index', compact('pengaduans'));
    }


    public function create()
    {
        $kategoris = Kategori::all();
        return view('pages.layananonline.pengaduan', compact('kategoris'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg',
            'file' => 'nullable|mimes:pdf',
            'anonymous' => 'nullable|boolean',
        ]);

        $validated['anonymous'] = $request->anonymous ? 1 : 0;
        $validated['user_id'] = Auth::id();

        $validated['status'] = 1;

        if ($request->hasFile('gambar')) {
            $fileName = time() . '_img.' . $request->gambar->extension();
            $request->gambar->move(public_path('upload/pengaduan'), $fileName);
            $validated['gambar'] = 'upload/pengaduan/' . $fileName;
        }

        if ($request->hasFile('file')) {
            $fileName = time() . '_file.' . $request->file->extension();
            $request->file->move(public_path('upload/file'), $fileName);
            $validated['file'] = 'upload/file/' . $fileName;
        }

        Pengaduan::create($validated);

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim.');
    }

    public function detailpengaduan($id)
    {
        $pengaduan = Pengaduan::with('kategori', 'user')->findOrFail($id);
        return view('pages.layananonline.detailpengaduan', compact('pengaduan'));
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::with('kategori')->findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.pengaduan.edit', compact('pengaduan', 'kategoris'));
    }


    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:1,2,3',
        ]);

        $pengaduan->update([
            'status' => $request->status
        ]);

        return redirect()->route('pengaduan-index')->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    
}

