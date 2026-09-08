<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Menu Setting: Identitas Umum Desa (Nama Desa & Uraian/Selayang Pandang)
     */
    public function edit()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = new Setting();
        }

        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update Menu Setting: Identitas Umum Desa
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_desa' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $setting = Setting::first();
        $data = $request->only(['nama_desa', 'deskripsi']);

        if (!$setting) {
            $setting = Setting::create($data);
        } else {
            $setting->update($data);
        }

        return redirect()->route('admin.setting.edit')
            ->with('success', 'Identitas Umum Desa berhasil disimpan!');
    }

    /**
     * Menu Profil Desa: Kontak, Alamat, Sosmed, dan Peta Maps
     */
    public function editDesa()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = new Setting();
        }

        return view('admin.setting-desa.edit', compact('setting'));
    }

    /**
     * Update Menu Profil Desa: Kontak, Alamat, Sosmed, dan Peta Maps
     */
    public function updateDesa(Request $request)
    {
        $request->validate([
            'alamat'     => 'required|string',
            'email'      => 'required|email',
            'telepon'    => 'required|string|max:20',
            'maps_embed' => 'nullable|string',
            'facebook'   => 'nullable|url',
            'instagram'  => 'nullable|url',
            'twitter'    => 'nullable|url',
        ]);

        $setting = Setting::first();
        $data = $request->only([
            'alamat', 'email', 'telepon', 'maps_embed',
            'facebook', 'instagram', 'twitter'
        ]);

        if (!$setting) {
            $setting = Setting::create($data);
        } else {
            $setting->update($data);
        }

        return redirect()->route('admin.setting-desa.edit')
            ->with('success', 'Profil Desa (Kontak, Sosmed & Peta) berhasil disimpan!');
    }

    /**
     * Menu Pengaturan Surat: Nomor Urut Surat, Logo Kop, Stempel, TTD Kades
     */
    public function editSurat()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = new Setting();
        }

        return view('admin.setting-surat.edit', compact('setting'));
    }

    /**
     * Update Menu Pengaturan Surat
     */
    public function updateSurat(Request $request)
    {
        $request->validate([
            'nomor_surat_berikutnya' => 'nullable|integer|min:1',
            'logo_surat'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stempel_surat'   => 'nullable|image|mimes:png,jpeg,jpg|max:2048',
            'ttd_kepala_desa' => 'nullable|image|mimes:png,jpeg,jpg|max:2048',
        ]);

        $setting = Setting::first();
        $data = $request->only(['nomor_surat_berikutnya']);

        $uploadDir = public_path('upload/persuratan');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // 1. Upload Logo Kop Surat
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

        return redirect()->route('admin.setting-surat.edit')
            ->with('success', 'Pengaturan Penomoran & Aset Persuratan berhasil disimpan!');
    }
}
