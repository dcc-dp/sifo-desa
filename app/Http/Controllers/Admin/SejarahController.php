<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;

class SejarahController extends Controller
{
    public function index()
    {
        $datas = Sejarah::latest()->get();
        return view('admin.sejarah.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.sejarah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('upload/sejarah'), $filename);
            $data['gambar'] = 'upload/sejarah/' . $filename;
        }

        Sejarah::create($data);

        return redirect()->route('sejarah-index')->with('success', 'Data sejarah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Sejarah::findOrFail($id);
        return view('admin.sejarah.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Sejarah::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $updateData = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            if ($data->gambar && file_exists(public_path($data->gambar))) {
                unlink(public_path($data->gambar));
            }

            $gambar = $request->file('gambar');
            $filename = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('upload/sejarah'), $filename);
            $updateData['gambar'] = 'upload/sejarah/' . $filename;
        }

        $data->update($updateData);

        return redirect()->route('sejarah-index')->with('success', 'Data sejarah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Sejarah::findOrFail($id);

        if ($data->gambar && file_exists(public_path($data->gambar))) {
            unlink(public_path($data->gambar));
        }

        $data->delete();

        return redirect()->route('sejarah-index')->with('success', 'Data sejarah berhasil dihapus.');
    }
}