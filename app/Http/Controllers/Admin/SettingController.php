<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first();
        return view('admin.setting.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_desa'  => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'alamat'     => 'required|string',
            'email'      => 'required|email',
            'telepon'    => 'required|string|max:20',
            'maps_embed' => 'nullable|string',
            'facebook'   => 'nullable|url',
            'instagram'  => 'nullable|url',
            'twitter'    => 'nullable|url',
        ]);

        Setting::first()->update($request->all());

        return redirect()->route('admin.setting.edit')
                         ->with('success', 'Pengaturan berhasil disimpan!');
    }
}