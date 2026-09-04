<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use App\Models\Setting;
use App\Models\PemerintahDesa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;

class SuratController extends Controller
{

    public function download($id)
    {
        // Otorisasi: Boleh diunduh oleh Admin (auth) ATAU Warga pemilik surat (session penduduk_id)
        $isAdmin = auth()->check();
        $isWarga = Session::has('pengajuan_penduduk_id');

        if (!$isAdmin && !$isWarga) {
            abort(403, 'Silakan login terlebih dahulu untuk mengunduh surat.');
        }

        $surat = Surat::with([
            'penduduk',
            'usaha',
            'domisili',
            'izin',
            'pengantar',
            'sktm'
        ])->findOrFail($id);

        // Jika warga biasa yang mengunduh, pastikan surat adalah miliknya
        if (!$isAdmin && $surat->penduduk_id != Session::get('pengajuan_penduduk_id')) {
            abort(403, 'Akses ditolak: Anda tidak memiliki izin untuk mengunduh surat ini.');
        }

        $filename = str_replace(
            '/',
            '-',
            $surat->nomor_surat ?? 'surat'
        ) . '.pdf';

        // 1. Jika file fisik PDF sudah ada di storage disk, unduh langsung file tersebut
        if ($surat->file_pdf && file_exists(storage_path('app/public/' . $surat->file_pdf))) {
            return response()->download(storage_path('app/public/' . $surat->file_pdf), $filename);
        }

        // 2. Jika file fisik belum ada atau hilang, generate secara dinamis via DomPDF
        $setting = Setting::first();
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
            abort(404, 'Jenis surat tidak ditemukan');
        }

        \Carbon\Carbon::setLocale('id');

        $pdf = Pdf::loadView(
            $view,
            compact(
                'surat',
                'setting',
                'kepalaDesa'
            )
        );

        return $pdf->download($filename);
    }
}