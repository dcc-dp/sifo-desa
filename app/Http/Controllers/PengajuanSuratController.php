<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Suraketus;
use App\Models\SuratDomisili;
use App\Models\SuratIzin;
use App\Models\SuratPengantar;
use App\Models\SKTM;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class PengajuanSuratController extends Controller
{
    /**
     * Store pengajuan surat
     */
    public function store(Request $request)
    {
        try {
            $tipe_surat = $request->input('tipe_surat');
            \Log::info('Pengajuan received - tipe_surat: ' . $tipe_surat);
            \Log::info('Request data: ' . json_encode($request->all()));
            
            // Validasi NIK session
            if (!Session::has('pengajuan_nik')) {
                if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                    return response()->json([
                        'success' => false,
                        'message' => 'Silakan login terlebih dahulu'
                    ], 401);
                }
                return redirect()->route('pengajuan.login-form')->with('error', 'Silakan login terlebih dahulu');
            }

            $penduduk_id = Session::get('pengajuan_penduduk_id');

            // Validate based on tipe surat
            if ($tipe_surat === 'usaha') {
                return $this->storeSuratUsaha($request, $penduduk_id);
            } elseif ($tipe_surat === 'domisili') {
                return $this->storeSuratDomisili($request, $penduduk_id);
            } elseif ($tipe_surat === 'izin_acara') {
                return $this->storeSuratIzin($request, $penduduk_id);
            } elseif ($tipe_surat === 'pengantar') {
                return $this->storeSuratPengantar($request, $penduduk_id);
            } elseif ($tipe_surat === 'sktm') {
                return $this->storeSKTM($request, $penduduk_id);
            }

            $errorMsg = 'Tipe surat tidak valid. Nilai tipe_surat: ' . $tipe_surat;
            \Log::error($errorMsg);
            if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => $errorMsg
                ], 400);
            }
            return redirect()->back()->with('error', $errorMsg);
        } catch (\Exception $e) {
            \Log::error('Error storing pengajuan surat: ' . $e->getMessage());
            if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Store Surat Keterangan Usaha
     */
    private function storeSuratUsaha($request, $penduduk_id)
    {
        try {
            // Validate input
            try {
                $request->validate([
                    'nama_usaha' => 'required|string|max:255',
                    'alamat_usaha' => 'required|string|max:255',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                    return response()->json([
                        'success' => false,
                        'message' => 'Validasi gagal: ' . implode(', ', array_map(fn($e) => implode(', ', $e), $e->validator->errors()->toArray()))
                    ], 422);
                }
                throw $e;
            }

            // Create Surat
            $surat = Surat::create([
                'penduduk_id' => $penduduk_id,
                'nomor_surat' => $this->generateNomorSurat('SKU'),
                'tanggal_dibuat' => Carbon::now()->format('Y-m-d'),
                'status' => 'menunggu',
                'keterangan' => 'Surat Keterangan Usaha',
            ]);

            // Create Surat Keterangan Usaha
            Suraketus::create([
                'surat_id' => $surat->id,
                'nama_usaha' => $request->nama_usaha,
                'alamat_usaha' => $request->alamat_usaha,
            ]);

            // Check if request is AJAX
            if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengajuan surat berhasil dikirim! Nomor surat: ' . $surat->nomor_surat
                ]);
            }

            return redirect()->route('pengajuan')->with('success', 'Pengajuan surat berhasil dikirim! Nomor surat: ' . $surat->nomor_surat);
        } catch (\Exception $e) {
            \Log::error('Error storing surat usaha: ' . $e->getMessage());
            if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }

    /**
     * Store Surat Keterangan Domisili
     */
    private function storeSuratDomisili($request, $penduduk_id)
    {
        try {
            // Create Surat
            $surat = Surat::create([
                'penduduk_id' => $penduduk_id,
                'nomor_surat' => $this->generateNomorSurat('DOM'),
                'tanggal_dibuat' => Carbon::now()->format('Y-m-d'),
                'status' => 'menunggu',
                'keterangan' => 'Surat Keterangan Domisili',
            ]);

            // Create Surat Domisili
            SuratDomisili::create([
                'surat_id' => $surat->id,
            ]);

            return redirect()->route('pengajuan')->with('success', 'Pengajuan surat berhasil dikirim! Nomor surat: ' . $surat->nomor_surat);
        } catch (\Exception $e) {
            \Log::error('Error storing surat domisili: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Store Surat Izin Acara
     */
    private function storeSuratIzin($request, $penduduk_id)
    {
        try {
            $request->validate([
                'hari' => 'required|string',
                'tanggal' => 'required|date',
                'tempat' => 'required|string|max:255',
                'jenis_acara' => 'required|string|max:255',
            ]);

            // Create Surat
            $surat = Surat::create([
                'penduduk_id' => $penduduk_id,
                'nomor_surat' => $this->generateNomorSurat('IZN'),
                'tanggal_dibuat' => Carbon::now()->format('Y-m-d'),
                'status' => 'menunggu',
                'keterangan' => 'Surat Izin Acara/Keramaian',
            ]);

            // Create Surat Izin
            SuratIzin::create([
                'surat_id' => $surat->id,
                'hari' => $request->hari,
                'tanggal' => $request->tanggal,
                'tempat' => $request->tempat,
                'jenis_acara' => $request->jenis_acara,
            ]);

            return redirect()->route('pengajuan')->with('success', 'Pengajuan surat berhasil dikirim! Nomor surat: ' . $surat->nomor_surat);
        } catch (\Exception $e) {
            \Log::error('Error storing surat izin: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Store Surat Pengantar
     */
    private function storeSuratPengantar($request, $penduduk_id)
    {
        try {
            $request->validate([
                'keterangan_pengantar' => 'nullable|string',
            ]);

            // Create Surat
            $surat = Surat::create([
                'penduduk_id' => $penduduk_id,
                'nomor_surat' => $this->generateNomorSurat('PGT'),
                'tanggal_dibuat' => Carbon::now()->format('Y-m-d'),
                'status' => 'menunggu',
                'keterangan' => $request->keterangan_pengantar ?? 'Surat Pengantar Umum',
            ]);

            // Create Surat Pengantar
            SuratPengantar::create([
                'surat_id' => $surat->id,
            ]);

            return redirect()->route('pengajuan')->with('success', 'Pengajuan surat berhasil dikirim! Nomor surat: ' . $surat->nomor_surat);
        } catch (\Exception $e) {
            \Log::error('Error storing surat pengantar: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Store SKTM
     */
    private function storeSKTM($request, $penduduk_id)
    {
        try {
            // Create Surat
            $surat = Surat::create([
                'penduduk_id' => $penduduk_id,
                'nomor_surat' => $this->generateNomorSurat('SKTM'),
                'tanggal_dibuat' => Carbon::now()->format('Y-m-d'),
                'status' => 'menunggu',
                'keterangan' => 'SKTM (Surat Keterangan Tidak Mampu)',
            ]);

            // Create SKTM
            SKTM::create([
                'surat_id' => $surat->id,
            ]);

            return redirect()->route('pengajuan')->with('success', 'Pengajuan surat berhasil dikirim! Nomor surat: ' . $surat->nomor_surat);
        } catch (\Exception $e) {
            \Log::error('Error storing SKTM: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Generate nomor surat
     */
    private function generateNomorSurat($prefix)
    {
        $tahun = Carbon::now()->year;
        $bulan = str_pad(Carbon::now()->month, 2, '0', STR_PAD_LEFT);
        
        // Ambil nomor urut terakhir dengan prefix dan tahun/bulan yang sama
        $pattern = $prefix . '/' . $tahun . '/' . $bulan . '/%';
        $lastSurat = Surat::where('nomor_surat', 'like', $pattern)
            ->latest('id')
            ->first();

        $urut = 1;
        if ($lastSurat) {
            // Extract nomor urut dari format: PREFIX/TAHUN/BULAN/URUT
            $parts = explode('/', $lastSurat->nomor_surat);
            if (count($parts) === 4) {
                $urut = intval($parts[3]) + 1;
            }
        }
        
        return sprintf('%s/%d/%s/%04d', $prefix, $tahun, $bulan, $urut);
    }

    /**
     * Get pengajuan history
     */
    public function history()
    {
        if (!Session::has('pengajuan_nik')) {
            return redirect()->route('pengajuan.login-form');
        }

        $penduduk_id = Session::get('pengajuan_penduduk_id');
        $surats = Surat::where('penduduk_id', $penduduk_id)->latest()->get();

        return view('pages.layananonline.pengajuan-history', compact('surats'));
    }
}
