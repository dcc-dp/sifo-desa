<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendas = Agenda::all();
        return view('admin.agenda.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'waktu_pelaksanaan' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        $data = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
            'deskripsi' => $request->deskripsi,
        ];

        Agenda::create($data);

        return redirect()->route('agenda-index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agendas = Agenda::findOrFail($id);
        return view('admin.agenda.edit', compact('agendas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $agendas = Agenda::findOrFail($id);

        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'waktu_pelaksanaan' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->only(['nama_kegiatan', 'waktu_pelaksanaan', 'deskripsi']);

        $agendas->update($data);

        return redirect()->route('agenda-index')->with('success', 'Agenda berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agendas = Agenda::findOrFail($id);
        $agendas->delete();

        return redirect()->route('agenda-index')->with('success', 'Agenda berhasil dihapus.');
    }
}
