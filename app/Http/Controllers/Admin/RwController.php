<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RwController extends Controller
{
    public function index()
    {
        $data = Rw::withCount('rts')->get();
        return view('admin.rw.index', compact('data'));
    }

    public function create()
    {
        return view('admin.rw.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_rw' => 'required|unique:rws,nomor_rw',
        ]);

        Rw::create([
            'nomor_rw' => $request->nomor_rw,
        ]);

        return redirect()->route('rw-index')
            ->with('success', 'Data RW berhasil ditambahkan');
    }

    public function edit($id)
    {
        $rw = Rw::findOrFail($id);
        return view('admin.rw.edit', compact('rw'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_rw' => 'required|unique:rws,nomor_rw,' . $id,
        ]);

        $rw = Rw::findOrFail($id);
        $rw->update([
            'nomor_rw' => $request->nomor_rw,
        ]);

        return redirect()->route('rw-index')
            ->with('success', 'Data RW berhasil diupdate');
    }

    public function destroy($id)
    {
        Rw::findOrFail($id)->delete();

        return redirect()->route('rw-index')
            ->with('delete', 'Data RW berhasil dihapus');
    }
}
