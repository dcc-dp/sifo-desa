<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BatchGaleri;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GaleriController extends Controller
{
    public function create($id)
    {
        $batch = BatchGaleri::findOrFail($id);

        return view('admin.galeri.create', compact('batch'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $batch = BatchGaleri::findOrFail($id);

        $file     = $request->file('gambar');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/galeri'), $fileName);

        Galeri::create([
            'id_batch' => $batch->id,
            'judul'    => $request->judul,
            'gambar'   => 'uploads/galeri/' . $fileName,
        ]);

        return redirect()
            ->route('batchgaleri.show', $batch->id)
            ->with('success', 'Gambar berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        $filePath = public_path($galeri->gambar);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $batchId = $galeri->id_batch;
        $galeri->delete();

        return redirect()
            ->route('batchgaleri.show', $batchId)
            ->with('success', 'Gambar berhasil dihapus!');
    }
}