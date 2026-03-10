@extends('layouts.user')

@section('title', 'Layanan Pengajuan | Sistem Informasi Desa')

@section('content')
    <style>
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-proses {
            background-color: #cfe2ff;
            color: #084298;
        }
        .status-diterima {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        .status-tolak {
            background-color: #f8d7da;
            color: #842029;
        }
    </style>

    <section>
        <div class="container">
            <h2><i class="fas fa-file-alt"></i> Layanan Surat Desa</h2>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <div>
                    <p style="margin: 0; color: #666;">
                        <strong>Nama:</strong> {{ session('pengajuan_penduduk_name') }}
                    </p>
                    <p style="margin: 5px 0 0 0; color: #666;">
                        <strong>NIK:</strong> {{ session('pengajuan_nik') }}
                    </p>
                </div>
                <form action="{{ route('pengajuan.logout') }}" method="GET" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            @if ($errors->any())
                <div style="background-color: #fee; border: 1px solid #fcc; color: #c33; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div style="background-color: #efe; border: 1px solid #cfc; color: #3c3; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <p style="margin-bottom: 30px;">Pilih jenis surat yang ingin Anda ajukan:</p>

            <div class="service-menu-grid">
                <div class="card service-card" onclick="showServiceForm('usaha')">
                    <i class="fas fa-store"></i>
                    <h4>Surat Keterangan Usaha (SKU)</h4>
                </div>
                <div class="card service-card" onclick="showServiceForm('domisili')">
                    <i class="fas fa-map-marker-alt"></i>
                    <h4>Surat Keterangan Domisili</h4>
                </div>
                <div class="card service-card" onclick="showServiceForm('izin_acara')">
                    <i class="fas fa-calendar-day"></i>
                    <h4>Surat Izin Acara/Keramaian</h4>
                </div>
                <div class="card service-card" onclick="showServiceForm('pengantar')">
                    <i class="fas fa-envelope-open-text"></i>
                    <h4>Surat Pengantar Umum</h4>
                </div>
                <div class="card service-card" onclick="showServiceForm('sktm')">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h4>SKTM (Surat Keterangan Tidak Mampu)</h4>
                </div>
            </div>

            <div id="service-form-container" class="card" style="margin-top: 40px; display: none; padding: 30px;">
                <h3 id="service-form-title"></h3>
                <button onclick="hideServiceForm()" style="float: right; background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
                
                <div id="form-message" style="display: none; padding: 15px; border-radius: 5px; margin-bottom: 20px;"></div>
                
                <form id="dynamic-service-form" onsubmit="handleFormSubmit(event)">
                    @csrf
                    <input type="hidden" name="tipe_surat" id="tipe_surat" value="">
                    <div id="form-fields"></div>
                    <button type="submit" id="submitBtn" class="btn btn-primary" style="width: 100%; margin-top: 20px;">
                        <i class="fas fa-paper-plane"></i> Kirim Pengajuan
                    </button>
                </form>
            </div>

            <h3 style="margin-top: 40px;">Riwayat Pengajuan Surat</h3>
            <div class="card" style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background-color: var(--color-secondary);">
                            <th style="padding: 12px; border-radius: 8px 0 0 0;">Nomor Surat</th>
                            <th style="padding: 12px;">Keterangan</th>
                            <th style="padding: 12px;">Tanggal Dibuat</th>
                            <th style="padding: 12px; border-radius: 0 8px 0 0;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $penduduk_id = session('pengajuan_penduduk_id');
                            $surats = \App\Models\Surat::where('penduduk_id', $penduduk_id)->latest()->get();
                        @endphp
                        @forelse ($surats as $surat)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 12px;"><strong>{{ $surat->nomor_surat }}</strong></td>
                                <td style="padding: 12px;">{{ $surat->keterangan }}</td>
                                <td style="padding: 12px;">{{ \Carbon\Carbon::parse($surat->tanggal_dibuat)->format('d/m/Y') }}</td>
                                <td style="padding: 12px;">
                                    <span class="status-badge status-{{ strtolower($surat->status) }}">
                                        {{ ucfirst($surat->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 15px; text-align: center; color: #999;">Belum ada pengajuan surat</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <script>
        const formConfigs = {
            usaha: {
                title: 'Surat Keterangan Usaha (SKU)',
                fields: `
                    <div class="form-group">
                        <label for="nama_usaha">Nama Usaha</label>
                        <input type="text" id="nama_usaha" name="nama_usaha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat_usaha">Alamat Usaha</label>
                        <textarea id="alamat_usaha" name="alamat_usaha" class="form-control" rows="3" required></textarea>
                    </div>
                `
            },
            domisili: {
                title: 'Surat Keterangan Domisili',
                fields: `
                    <div style="background-color: #e7f3ff; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                        <p><strong>Informasi:</strong> Data domisili Anda akan diambil dari data kependudukan yang terdaftar di sistem.</p>
                    </div>
                `
            },
            izin_acara: {
                title: 'Surat Izin Acara/Keramaian',
                fields: `
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <input type="text" id="hari" name="hari" class="form-control" placeholder="Misal: Jumat" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal Acara</label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tempat">Tempat Acara</label>
                        <input type="text" id="tempat" name="tempat" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_acara">Jenis Acara</label>
                        <input type="text" id="jenis_acara" name="jenis_acara" class="form-control" placeholder="Misal: Pernikahan, Syukuran, dll" required>
                    </div>
                `
            },
            pengantar: {
                title: 'Surat Pengantar Umum',
                fields: `
                    <div class="form-group">
                        <label for="keterangan_pengantar">Keterangan / Tujuan</label>
                        <textarea id="keterangan_pengantar" name="keterangan_pengantar" class="form-control" rows="3" placeholder="Jelaskan tujuan pengajuan surat pengantar"></textarea>
                    </div>
                `
            },
            sktm: {
                title: 'SKTM (Surat Keterangan Tidak Mampu)',
                fields: `
                    <div style="background-color: #e7f3ff; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                        <p><strong>Informasi:</strong> Permohonan SKTM akan diproses oleh perangkat desa setelah melalui verifikasi.</p>
                    </div>
                `
            }
        };

        function showServiceForm(tipe) {
            const config = formConfigs[tipe];
            if (!config) {
                console.error('Config not found for tipe:', tipe);
                return;
            }

            console.log('Showing form for tipe:', tipe);
            document.getElementById('service-form-title').textContent = config.title;
            document.getElementById('form-fields').innerHTML = config.fields;
            const tipeSuratInput = document.getElementById('tipe_surat');
            tipeSuratInput.value = tipe;
            console.log('Set tipe_surat to:', tipeSuratInput.value);
            document.getElementById('form-message').style.display = 'none';
            document.getElementById('service-form-container').style.display = 'block';
            document.getElementById('service-form-container').scrollIntoView({ behavior: 'smooth' });
        }

        function hideServiceForm() {
            document.getElementById('service-form-container').style.display = 'none';
            document.getElementById('form-message').style.display = 'none';
        }

        async function handleFormSubmit(event) {
            event.preventDefault();
            console.log('Form submit triggered');
            
            const form = document.getElementById('dynamic-service-form');
            const submitBtn = document.getElementById('submitBtn');
            const messageDiv = document.getElementById('form-message');
            
            if (!form) {
                console.error('Form not found');
                alert('Form not found!');
                return false;
            }
            
            console.log('Form found, proceeding...');
            
            try {
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
                }
                
                // Build FormData using form element
                const formData = new FormData(form);
                
                // Manually ensure tipe_surat is included
                const tipeSuratInput = document.getElementById('tipe_surat');
                if (tipeSuratInput && tipeSuratInput.value) {
                    formData.set('tipe_surat', tipeSuratInput.value);
                }
                
                // Debug: log form data
                console.log('Form Data being sent:');
                for (let [key, value] of formData.entries()) {
                    console.log(`  ${key}: ${value}`);
                }
                
                const csrfTokenElement = document.querySelector('input[name="_token"]');
                const csrfToken = csrfTokenElement ? csrfTokenElement.value : '';
                console.log('CSRF Token present:', !!csrfToken);
                
                console.log('Sending fetch request to:', '{{ route("pengajuan.store") }}');
                
                const response = await fetch('{{ route("pengajuan.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                console.log('Response status:', response.status);

                let data;
                try {
                    const responseText = await response.text();
                    console.log('Response text:', responseText.substring(0, 200));
                    data = JSON.parse(responseText);
                } catch (parseError) {
                    console.error('JSON Parse Error:', parseError);
                    messageDiv.innerHTML = `<div style="background-color: #fee; border: 1px solid #fcc; color: #c33;">
                        <strong>✗ Error!</strong> Respons server tidak valid. Status: ${response.status}
                    </div>`;
                    messageDiv.style.display = 'block';
                    throw parseError;
                }

                if (data.success) {
                    messageDiv.innerHTML = `<div style="background-color: #efe; border: 1px solid #cfc; color: #3c3;">
                        <strong>✓ Sukses!</strong> ${data.message}
                    </div>`;
                    messageDiv.style.display = 'block';
                    
                    form.reset();
                    
                    setTimeout(() => {
                        loadHistory();
                    }, 2000);
                } else {
                    messageDiv.innerHTML = `<div style="background-color: #fee; border: 1px solid #fcc; color: #c33;">
                        <strong>✗ Error!</strong> ${data.message}
                    </div>`;
                    messageDiv.style.display = 'block';
                }
            } catch (error) {
                console.error('Error in handleFormSubmit:', error);
                messageDiv.innerHTML = `<div style="background-color: #fee; border: 1px solid #fcc; color: #c33;">
                    <strong>✗ Error!</strong> Terjadi kesalahan: ${error.message}
                </div>`;
                messageDiv.style.display = 'block';
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Pengajuan';
                }
            }
        }
                </div>`;
                messageDiv.style.display = 'block';
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Pengajuan';
                }
            }
        }

        function loadHistory() {
            // Reload halaman untuk update riwayat
            location.reload();
        }
    </script>

    <style>
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--color-text);
        }
        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group textarea {
            resize: vertical;
            font-family: Arial, sans-serif;
        }
    </style>

@endsection