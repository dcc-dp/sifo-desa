<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Suraketus;
use App\Models\Surat;
use App\Models\DataPenduduk;
use Illuminate\Http\Request;

class SuratKetusController extends Controller
{
    // Tampilkan semua surat (dengan pagination)
    public function index()
    {
        $data = Suraketus::with('penduduk')->paginate(10);
        return view('admin.persuratan.Surat KetUsaha.surat-ketusaha', compact('data'));
    }

    // Form tambah surat baru
    public function create()
    {
        $penduduk = DataPenduduk::all();
        return view('admin.persuratan.usaha.suratketus-create', compact('penduduk'));
    }

    // Simpan data surat baru
    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required',
            'nomor_surat' => 'required|unique:surat_keterangan_usaha,nomor_surat',
            'nama_usaha' => 'required',
            'alamat_usaha' => 'required',
            'status' => 'required',
        ]);

        Suraketus::create($request->all());
        return redirect()->route('suratketus.index')->with('success', 'Data surat keterangan usaha berhasil ditambahkan');
    }

    // Detail surat
    public function show($id)
    {
        $item = Suraketus::with('penduduk')->findOrFail($id);
        return view('admin.persuratan.usaha.suratketus-show', compact('item'));
    }

    // Form edit
    public function edit($id)
    {
        $item = Suraketus::findOrFail($id);
        $penduduk = DataPenduduk::all();
        return view('admin.persuratan.usaha.suratketus-edit', compact('item', 'penduduk'));
    }

    // Update data surat
    public function update(Request $request, $id)
    {
        $item = Suraketus::findOrFail($id);

        $request->validate([
            'nomor_surat' => 'required|unique:surat_keterangan_usaha,nomor_surat,' . $item->id,
            'nama_usaha' => 'required',
            'alamat_usaha' => 'required',
            'status' => 'required',
        ]);

        $item->update($request->all());
        return redirect()->route('suratketus.index')->with('success', 'Data berhasil diperbarui');
    }

    // Hapus data surat
    public function destroy($id)
    {
        $item = Suraketus::findOrFail($id);
        $item->delete();
        return redirect()->route('suratketus.index')->with('success', 'Data berhasil dihapus');
    }

    // Pencarian AJAX
    public function search(Request $request)
    {
        $keyword = $request->get('keyword');

        $data = Suraketus::with('penduduk')
            ->whereHas('penduduk', function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('nik', 'like', "%{$keyword}%");
            })
            ->orWhere('nomor_surat', 'like', "%{$keyword}%")
            ->orWhere('nama_usaha', 'like', "%{$keyword}%")
            ->orWhere('alamat_usaha', 'like', "%{$keyword}%")
            ->orWhere('status', 'like', "%{$keyword}%")
            ->orWhere('keterangan', 'like', "%{$keyword}%")
            ->get();

        return response()->json($data);
    }
}
