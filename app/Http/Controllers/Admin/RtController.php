<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rt;
use App\Models\Rw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RtController extends Controller
{
    public function index()
    {
        $data = Rt::with('rws')->get();
        return view('admin.rt.index', compact('data'));
    }

    public function create()
    {
        $rw_list = Rw::all();
        return view('admin.rt.create', compact('rw_list'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rw_id'    => 'required|exists:rws,id',
            'nomor_rt' => 'required',
        ]);

        Rt::create([
            'rw_id'    => $request->rw_id,
            'nomor_rt' => $request->nomor_rt,
        ]);

        return redirect()->route('rt-index')
            ->with('success', 'Data RT berhasil ditambahkan');
    }

    public function edit($id)
    {
        $rt = Rt::findOrFail($id);
        $rw_list = Rw::all();

        return view('admin.rt.edit', compact('rt', 'rw_list'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rw_id'    => 'required|exists:rws,id',
            'nomor_rt' => 'required',
        ]);

        $rt = Rt::findOrFail($id);
        $rt->update([
            'rw_id'    => $request->rw_id,
            'nomor_rt' => $request->nomor_rt,
        ]);

        return redirect()->route('rt-index')
            ->with('success', 'Data RT berhasil diupdate');
    }

    public function destroy($id)
    {
        Rt::findOrFail($id)->delete();

        return redirect()->route('rt-index')
            ->with('delete', 'Data RT berhasil dihapus');
    }
}
