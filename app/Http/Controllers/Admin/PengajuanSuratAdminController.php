<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Setting;
use App\Models\PemerintahDesa;
use Illuminate\Http\Request;

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

        return view(
            'admin.pengajuan-surat.show',
            compact('surat')
        );
    }

    public function terima($id)
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

    $pdf = Pdf::loadView(
        $view,
        compact(
            'surat',
            'setting',
            'kepalaDesa'
        )
    );

    $filename =
        str_replace('/', '-', $surat->nomor_surat)
        . '.pdf';

    $pdf->save(
        storage_path(
            'app/public/surat/' . $filename
        )
    );

    $surat->update([
        'status' => 'diterima',
        'file_pdf' => 'surat/' . $filename
    ]);

    return back()->with(
        'success',
        'Surat berhasil diterima'
    );
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