<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratDomisili;
use App\Models\Surat;
use App\Models\DataPenduduk;
use Illuminate\Http\Request;

class SuratDomisiliController extends Controller
{
    public function index()
    {
        $data = SuratDomisili::with('penduduk')->paginate(10);
        return view('admin.persuratan.Surat Domisili.surat-sktm', compact('data'));
    }

    public function create()
    {
        return view('admin.persuratan.domisili.suratdomisili-create');
    }

    public function store(Request $request)
    {
        SuratDomisili::create($request->all());
        return redirect()->route('suratdomisili.index')->with('success', 'Data surat domisili berhasil ditambahkan');
    }

    public function show($id)
    {
        $item = SuratDomisili::with('penduduk')->findOrFail($id);
        return view('admin.persuratan.domisili.suratdomisili-show', compact('item'));
    }

    public function edit($id)
    {
        $item = SuratDomisili::findOrFail($id);
        return view('admin.persuratan.domisili.suratdomisili-edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = SuratDomisili::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('suratdomisili.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $item = SuratDomisili::findOrFail($id);
        $item->delete();
        return redirect()->route('suratdomisili.index')->with('success', 'Data berhasil dihapus');
    }

    public function search(Request $request)
    {
        $keyword = $request->get('keyword');

        $data = SuratDomisili::with('penduduk')
            ->whereHas('penduduk', function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('nik', 'like', "%{$keyword}%");
            })
            ->orWhere('nomor_surat', 'like', "%{$keyword}%")
            ->orWhere('status', 'like', "%{$keyword}%")
            ->orWhere('keterangan', 'like', "%{$keyword}%")
            ->paginate(10);

        return view('admin.persuratan.domisili.suratdomisili-index', compact('data'));
    }
}
