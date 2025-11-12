<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Pengaduan;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduans = Pengaduan::with('kategori')->get();
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.pengaduan.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'user_id' => 'required|exists:users,id',
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image',
            'file' => 'nullable|file|mimes:pdf',
            'status' => 'required|in:1,2,3',
            'anonymous' => 'required|boolean',
        ]);

        Pengaduan::create([
            'kategori_id' => $validatedData['kategori_id'],
            'user_id' => $validatedData['user_id'],
            'judul' => $validatedData['judul'],
            'deskripsi' => $validatedData['deskripsi'],
            'status' => $validatedData['status'],
            'anonymous' => $validatedData['anonymous'],
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = date('Ymd_His') . '_' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('upload/pengaduan'), $filename);
            $data['gambar'] = 'upload/pengaduan/' . $filename;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = date('Ymd_His') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/file'), $filename);
            $data['file'] = 'upload/file/' . $filename;
        }

        return redirect()->route('pengaduan-index')->with('success', 'Pengaduan berhasil ditambahkan.');
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
        $pengaduan = Pengaduan::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.pengaduan.edit', compact('pengaduan', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:1,2,3',
        ]);

        $data = $request->only(['status']);

        $pengaduan->update($data);

        return redirect()->route('pengaduan-index')->with('success', 'Pengaduan berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
}
