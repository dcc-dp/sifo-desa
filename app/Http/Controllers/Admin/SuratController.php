<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use App\Models\Setting;
use App\Models\PemerintahDesa;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
      
    public function download($id)
        {
            $surat = Surat::with([
                'penduduk',
                'usaha',
                'domisili',
                'izin',
                'pengantar',
                'sktm'
            ])->findOrFail($id);

            $setting = Setting::first();

            $kepalaDesa = PemerintahDesa::where(
                'jabatan',
                'Kepala Desa'
            )->first();

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

            \Carbon\Carbon::setLocale('id');

            $pdf = Pdf::loadView(
                $view,
                compact(
                    'surat',
                    'setting',
                    'kepalaDesa'
                )
            );

            $filename = str_replace(
                '/',
                '-',
                $surat->nomor_surat
            ) . '.pdf';

            return $pdf->download($filename);
        }
}