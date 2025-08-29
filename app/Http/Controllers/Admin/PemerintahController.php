<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PemerintahDesa;
use Illuminate\Http\Request;

class PemerintahController extends Controller
{

    public function index()
    {
        $pemerintahs = PemerintahDesa::all();
        return view('admin.pemerintah.index', compact('pemerintahs'));
    }


    public function create()
    {
        return view('admin.pemerintah.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tupoksi' => 'required|string',
            'foto' => 'nullable|image',
        ]);

        $data = [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tupoksi' => $request->tupoksi,
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = date('Ymd_His') . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('upload/pemerintah'), $filename);
            $data['foto'] = 'upload/pemerintah/' . $filename;
        }

        PemerintahDesa::create($data);

        return redirect()->route('pemerintah-index')->with('success', 'Pemerintah berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $pemerintahs = PemerintahDesa::findOrFail($id);
        return view('admin.pemerintah.edit', compact('pemerintahs'));
    }

    
    public function update(Request $request, string $id)
    {
        $pemerintahs = PemerintahDesa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tupoksi' => 'required|string',
            'foto' => 'nullable|image',
        ]);

        $data = $request->only(['nama', 'jabatan', 'tupoksi']);

        if ($request->hasFile('foto')) {
            if ($pemerintahs->foto && file_exists(public_path($pemerintahs->foto))) {
                unlink(public_path($pemerintahs->foto));
            }

            $foto = $request->file('foto');
            $filename = date('Ymd_His') . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('upload/pemerintah'), $filename);
            $data['foto'] = 'upload/pemerintah/' . $filename;
        }

        $pemerintahs->update($data);

        return redirect()->route('pemerintah-index')->with('success', 'Pemerintah berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $pemerintahs = PemerintahDesa::findOrFail($id);

        if ($pemerintahs->foto && file_exists(public_path($pemerintahs->foto))) {
            unlink(public_path($pemerintahs->foto));
        }

        $pemerintahs->delete();

        return redirect()->route('pemerintah-index')->with('success', 'Pemerintah berhasil dihapus.');
    }
}
