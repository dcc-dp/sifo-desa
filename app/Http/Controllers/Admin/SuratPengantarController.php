<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratPengantar;
use App\Models\Surat;
use App\Models\DataPenduduk;
use Illuminate\Http\Request;

class SuratPengantarController extends Controller
{
    public function index()
    {
        $data = SuratPengantar::with('penduduk')->paginate(10);
        return view('admin.persuratan.Surat Pengantar.surat-pengantar', compact('data'));
    }

    public function create()
    {
        $penduduk = DataPenduduk::all();
        return view('admin.persuratan.pengantar.suratpengantar-create', compact('penduduk'));
    }

    public function store(Request $request)
    {
        SuratPengantar::create($request->all());
        return redirect()->route('suratpengantar.index')->with('success', 'Surat pengantar berhasil ditambahkan');
    }

    public function show($id)
    {
        $item = SuratPengantar::with('penduduk')->findOrFail($id);
        return view('admin.persuratan.pengantar.suratpengantar-show', compact('item'));
    }

    public function edit($id)
    {
        $item = SuratPengantar::findOrFail($id);
        $penduduk = DataPenduduk::all();
        return view('admin.persuratan.pengantar.suratpengantar-edit', compact('item', 'penduduk'));
    }

    public function update(Request $request, $id)
    {
        $item = SuratPengantar::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('suratpengantar.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $item = SuratPengantar::findOrFail($id);
        $item->delete();
        return redirect()->route('suratpengantar.index')->with('success', 'Data berhasil dihapus');
    }

    public function search(Request $request)
    {
        $keyword = $request->get('keyword');

        $data = SuratPengantar::with('penduduk')
            ->whereHas('penduduk', function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('nik', 'like', "%{$keyword}%");
            })
            ->orWhere('nomor_surat', 'like', "%{$keyword}%")
            ->orWhere('keperluan', 'like', "%{$keyword}%")
            ->orWhere('status', 'like', "%{$keyword}%")
            ->orWhere('keterangan', 'like', "%{$keyword}%")
            ->paginate(10);

        return view('admin.persuratan.pengantar.suratpengantar-index', compact('data'));
    }
}
