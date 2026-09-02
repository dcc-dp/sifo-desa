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

        if (!$setting) {
            $setting = new Setting();
        }

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
            'nomor_surat_berikutnya' => 'nullable|integer|min:1',
            'logo_surat'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stempel_surat'   => 'nullable|image|mimes:png,jpeg,jpg|max:2048',
            'ttd_kepala_desa' => 'nullable|image|mimes:png,jpeg,jpg|max:2048',
        ]);

        $setting = Setting::first();
        $data = $request->except(['logo_surat', 'stempel_surat', 'ttd_kepala_desa']);

        $uploadDir = public_path('upload/persuratan');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // 1. Upload Logo Surat
        if ($request->hasFile('logo_surat')) {
            if ($setting && $setting->logo_surat && file_exists(public_path($setting->logo_surat)) && str_contains($setting->logo_surat, 'upload/persuratan/')) {
                @unlink(public_path($setting->logo_surat));
            }
            $file = $request->file('logo_surat');
            $filename = 'logo_' . date('Ymd_His') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $data['logo_surat'] = 'upload/persuratan/' . $filename;
        }

        // 2. Upload Stempel Surat
        if ($request->hasFile('stempel_surat')) {
            if ($setting && $setting->stempel_surat && file_exists(public_path($setting->stempel_surat)) && str_contains($setting->stempel_surat, 'upload/persuratan/')) {
                @unlink(public_path($setting->stempel_surat));
            }
            $file = $request->file('stempel_surat');
            $filename = 'stempel_' . date('Ymd_His') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $data['stempel_surat'] = 'upload/persuratan/' . $filename;
        }

        // 3. Upload Tanda Tangan Kepala Desa
        if ($request->hasFile('ttd_kepala_desa')) {
            if ($setting && $setting->ttd_kepala_desa && file_exists(public_path($setting->ttd_kepala_desa)) && str_contains($setting->ttd_kepala_desa, 'upload/persuratan/')) {
                @unlink(public_path($setting->ttd_kepala_desa));
            }
            $file = $request->file('ttd_kepala_desa');
            $filename = 'ttd_' . date('Ymd_His') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $data['ttd_kepala_desa'] = 'upload/persuratan/' . $filename;
        }

        if (!$setting) {
            $setting = Setting::create($data);
        } else {
            $setting->update($data);
        }

        return redirect()->route('admin.setting.edit')
            ->with('success', 'Seluruh pengaturan dan aset persuratan berhasil disimpan!');
    }
}
