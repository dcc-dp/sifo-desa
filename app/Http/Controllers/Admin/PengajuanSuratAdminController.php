<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Setting;
use App\Models\PemerintahDesa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanSuratAdminController extends Controller
{
    public function index()
    {
        $surats = Surat::with('penduduk')
            ->latest()
            ->get();

        return view(
            'admin.pengajuan-surat.index',
            compact('surats')
        );
    }

    public function show($id)
    {
        $surat = Surat::with([
            'penduduk',
            'usaha',
            'domisili',
            'pengantar',
            'izin',
            'sktm'
        ])->findOrFail($id);

        $setting = Setting::first();
        $nextNumber = $setting ? (int) ($setting->nomor_surat_berikutnya ?? 1) : 1;
        if ($nextNumber < 1) $nextNumber = 1;
        $nextNomorUrut = sprintf('%03d', $nextNumber);
        $nextNomorSurat = $nextNomorUrut;

        $kodeSurat = $surat->kode_surat;
        $romawiBulan = Surat::getRomawiBulan(Carbon::now()->month);
        $tahun = Carbon::now()->year;
        $nextNomorSuratFull = "{$nextNomorUrut}/{$kodeSurat}/{$romawiBulan}/{$tahun}";

        return view(
            'admin.pengajuan-surat.show',
            compact('surat', 'setting', 'nextNomorSurat', 'nextNomorUrut', 'kodeSurat', 'romawiBulan', 'tahun', 'nextNomorSuratFull')
        );
    }

    public function terima(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $surat = Surat::with([
                'penduduk',
                'usaha',
                'domisili',
                'izin',
                'pengantar',
                'sktm'
            ])->lockForUpdate()->findOrFail($id);

            // Ambil setting dengan lockForUpdate untuk mencegah nomor duplikat saat disetujui bersamaan
            $setting = Setting::lockForUpdate()->first();
            if (!$setting) {
                $setting = Setting::create([
                    'nama_desa' => 'Desa Rante Gola',
                    'alamat' => '-',
                    'email' => 'desa@example.com',
                    'telepon' => '-',
                    'nomor_surat_berikutnya' => 1,
                ]);
                $setting = Setting::lockForUpdate()->find($setting->id);
            }

            // Hanya generate nomor baru jika surat belum memiliki nomor resmi
            if (empty($surat->nomor_surat)) {
                $inputNomor = trim($request->input('nomor_surat', ''));
                $kodeSurat = $surat->kode_surat;
                $romawiBulan = Surat::getRomawiBulan(Carbon::now()->month);
                $tahun = Carbon::now()->year;

                if (!empty($inputNomor)) {
                    // Jika admin input nomor dengan format lengkap (misal: 006/SKU/IX/2026)
                    if (str_contains($inputNomor, '/')) {
                        $formattedNomor = $inputNomor;
                        preg_match('/\d+/', $inputNomor, $matches);
                        if (!empty($matches[0])) {
                            $setting->nomor_surat_berikutnya = (int) $matches[0] + 1;
                        } else {
                            $setting->nomor_surat_berikutnya = (int) ($setting->nomor_surat_berikutnya ?? 1) + 1;
                        }
                    } else {
                        // Jika admin input nomor urut tertentu di modal (misal: 006)
                        preg_match('/\d+/', $inputNomor, $matches);
                        if (!empty($matches[0])) {
                            $numVal = (int) $matches[0];
                            $padLen = max(strlen($matches[0]), 3);
                            $nomorUrut = sprintf("%0{$padLen}d", $numVal);
                            $setting->nomor_surat_berikutnya = $numVal + 1;
                        } else {
                            $nomorUrut = $inputNomor;
                            $setting->nomor_surat_berikutnya = (int) ($setting->nomor_surat_berikutnya ?? 1) + 1;
                        }
                        $formattedNomor = "{$nomorUrut}/{$kodeSurat}/{$romawiBulan}/{$tahun}";
                    }
                } else {
                    $currentNumber = (int) ($setting->nomor_surat_berikutnya ?? 1);
                    if ($currentNumber < 1) $currentNumber = 1;
                    $nomorUrut = sprintf('%03d', $currentNumber);
                    $setting->nomor_surat_berikutnya = $currentNumber + 1;
                    $formattedNomor = "{$nomorUrut}/{$kodeSurat}/{$romawiBulan}/{$tahun}";
                }

                $surat->nomor_surat = $formattedNomor;
                $surat->save();
                $setting->save();
            }

            $kepalaDesa = PemerintahDesa::where('jabatan', 'Kepala Desa')
                ->orWhere('jabatan', 'like', '%Kepala Desa%')
                ->first();

            if ($surat->usaha) {
                $view = 'pdf.sku';
            } elseif ($surat->domisili) {
                $view = 'pdf.domisili';
            } elseif ($surat->sktm) {
                $view = 'pdf.sktm';
            } elseif ($surat->pengantar) {
                $view = 'pdf.pengantar';
            } elseif ($surat->izin) {
                $view = 'pdf.izin';
            } else {
                abort(404);
            }

            $pdf = Pdf::loadView(
                $view,
                compact(
                    'surat',
                    'setting',
                    'kepalaDesa'
                )
            );

            $filename = str_replace('/', '-', $surat->nomor_surat) . '.pdf';

            $storageDir = storage_path('app/public/surat');
            if (!file_exists($storageDir)) {
                mkdir($storageDir, 0755, true);
            }

            $pdf->save($storageDir . '/' . $filename);

            $surat->update([
                'status' => 'diterima',
                'file_pdf' => 'surat/' . $filename
            ]);

            return back()->with(
                'success',
                'Surat berhasil disetujui & diterbitkan dengan Nomor: ' . $surat->nomor_surat
            );
        });
    }

public function tolak(Request $request, $id)
{
    $request->validate([
        'alasan_tolak' => 'required'
    ]);

    $surat = Surat::findOrFail($id);

    $surat->update([
        'status' => 'ditolak',
        'alasan_tolak' => $request->alasan_tolak
    ]);

    return back()->with(
        'success',
        'Surat berhasil ditolak'
    );
}
}