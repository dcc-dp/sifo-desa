<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\SuratIzin;
use App\Models\Penduduk;

class SuratIzinController extends Controller
{
    public function index()
    {
        $data = SuratIzin::with('penduduk')->paginate(10);
        return view('admin.persuratan.Surat Izin.surat-izin', compact('data'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $data = SuratIzin::with('penduduk')
            ->whereHas('penduduk', function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('nik', 'like', "%{$keyword}%");
            })
            ->orWhere('nomor_surat', 'like', "%{$keyword}%")
            ->take(20)
            ->get();

        return response()->json($data);
    }

    public function create()
    {
        $penduduk = Penduduk::all();
        return view('admin.suratizin.create', compact('penduduk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'penduduk_id' => 'required',
            'tanggal_dibuat' => 'required|date',
            'hari' => 'required',
            'tanggal' => 'required|date',
            'tempat' => 'required',
            'jenis_acara' => 'required',
            'status' => 'required',
        ]);

        SuratIzin::create($request->all());
        return redirect()->route('suratizin.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = SuratIzin::findOrFail($id);
        $penduduk = Penduduk::all();
        return view('admin.suratizin.edit', compact('data', 'penduduk'));
    }

    public function update(Request $request, $id)
    {
        $data = SuratIzin::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('suratizin.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        SuratIzin::findOrFail($id)->delete();
        return redirect()->route('suratizin.index')->with('success', 'Data berhasil dihapus.');
    }
}
