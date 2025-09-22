<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritas = Berita::with('kategori')->get();
        return view('admin.berita.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.berita.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id',
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image',
        ]);

        $data = [
            'id_kategori' => $request->id_kategori,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = date('Ymd_His') . '_' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('upload/berita'), $filename);
            $data['gambar'] = 'upload/berita/' . $filename;
        }

        Berita::create($data);

        return redirect()->route('berita-index')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $beritas = Berita::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.berita.edit', compact('beritas', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $beritas = Berita::findOrFail($id);

        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image',
        ]);

        $data = $request->only(['id_kategori', 'judul', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($beritas->gambar && file_exists(public_path($beritas->gambar))) {
                unlink(public_path($beritas->gambar));
            }

            $gambar = $request->file('gambar');
            $filename = date('Ymd_His') . '_' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('upload/berita'), $filename);
            $data['gambar'] = 'upload/berita/' . $filename;
        }

        $beritas->update($data);

        return redirect()->route('berita-index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $beritas = Berita::findOrFail($id);
        if ($beritas->gambar && file_exists(public_path($beritas->gambar))) {
            unlink(public_path($beritas->gambar));
        }
        $beritas->delete();

        return redirect()->route('berita-index')->with('success', 'Berita berhasil dihapus.');
    }
}
