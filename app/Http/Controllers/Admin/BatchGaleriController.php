<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BatchGaleri;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BatchGaleriController extends Controller
{

    public function index()
    {
        $batches = BatchGaleri::withCount('galeris')
            ->latest()
            ->get();

        return view('admin.batchgaleri.index', compact('batches'));
    }

    public function create()
    {
        return view('admin.batchgaleri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        BatchGaleri::create([
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('batchgaleri.index')
            ->with('success', 'Batch berhasil ditambahkan!');
    }

    public function show($id)
    {
        $batch = BatchGaleri::with('galeris')->findOrFail($id);

        return view('admin.batchgaleri.show', compact('batch'));
    }


    public function edit($id)
    {
        $batch = BatchGaleri::findOrFail($id);
        return view('admin.batchgaleri.edit', compact('batch'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $batch = BatchGaleri::findOrFail($id);
        $batch->update([
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('batchgaleri.index')
            ->with('success', 'Batch berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $batch = BatchGaleri::with('galeris')->findOrFail($id);

        foreach ($batch->galeris as $galeri) {
            $filePath = public_path($galeri->gambar);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $galeri->delete();
        }
        $batch->delete();

        return redirect()
            ->route('batchgaleri.index')
            ->with('success', 'Batch dan semua gambar berhasil dihapus!');
    }
}
