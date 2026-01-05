<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\dataPenduduk;
use App\Models\SKTM;
use Illuminate\Http\Request;

class DatapendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = dataPenduduk::all();
        return view('admin.data-penduduk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data-penduduk.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:data_penduduks,nik',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'keldesa' => 'required',          
            'kecamatan' => 'required',        
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required',
            'kewarganegaraan' => 'required',
        ]);

        $data = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'keldesa' => $request->keldesa,      
            'kecamatan' => $request->kecamatan,  
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'pekerjaan' => $request->pekerjaan,
            'kewarganegaraan' => $request->kewarganegaraan,
        ];

        dataPenduduk::create($data);

        return redirect()->route('data.penduduk-index')->with('success', 'Data Penduduk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = dataPenduduk::findOrFail($id);
        return view('admin.data-penduduk.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penduduk = dataPenduduk::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:data_penduduks,nik,' . $penduduk->id,
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'keldesa' => 'required',         
            'kecamatan' => 'required',       
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required',
            'kewarganegaraan' => 'required',
        ]);

        $penduduk->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'keldesa' => $request->keldesa,      
            'kecamatan' => $request->kecamatan,   
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'pekerjaan' => $request->pekerjaan,
            'kewarganegaraan' => $request->kewarganegaraan,
        ]);

        return redirect()->route('data.penduduk-index')->with('success', 'Data Penduduk berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penduduk = dataPenduduk::findOrFail($id);
        $penduduk->delete();

        return redirect()->route('data.penduduk-index')->with('success', 'Data Penduduk berhasil dihapus');
    }

    public function show(string $id)
    {
        $data = dataPenduduk::findOrFail($id);

        return view('admin.data-penduduk.show', compact('data'));
    }

    public function search(Request $request)
{
    $keyword = $request->keyword;

    $data = dataPenduduk::where('nama', 'LIKE', "%{$keyword}%")
        ->orWhere('nik', 'LIKE', "%{$keyword}%")
        ->orWhere('alamat', 'LIKE', "%{$keyword}%")
        ->get();
    return response()->json($data);
}

}
