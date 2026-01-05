<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SKTM;
use App\Models\Surat;
use App\Models\dataPenduduk;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $data = Surat::with('penduduk')->latest()->paginate(10);
        $tes = SKTM::all();
        return view('admin.persuratan.SKTM.surat-index', compact('data', 'tes'));
    }

    public function edit($id)
    {
        $tes = Surat::findOrFail($id);
        return view('admin.persuratan.SKTM.surat-edit', compact('tes', 'id'));
    }


    public function update(Request $request, $id)
{

    $request->validate([
        'status' => 'required|in:diterima,tolak,proses',
    ]);

    $surat = Surat::findOrFail($id);

    $surat->status = $request->status;
    $surat->save();

    return redirect()->route('surat.index')->with('success', 'Status surat berhasil diperbarui.');
}

    public function search(Request $request)
    {
        $keyword = $request->get('keyword');

        $data = Surat::with('penduduk')
            ->whereHas('penduduk', function($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('nik', 'like', "%{$keyword}%");
            })
            ->orWhere('nomor_surat','like', "%{$keyword}%")
            ->orWhere('status','like', "%{$keyword}%")
            ->orWhere('keterangan','like', "%{$keyword}%")
            ->get();

        return response()->json($data);
    }
}