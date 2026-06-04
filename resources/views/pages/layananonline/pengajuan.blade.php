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


    <section class="py-4">

        <div class="container">

            <!-- HEADER -->

            <div class="dashboard-header">


                <h2>Layanan Surat</h2>


                <div class="header-right">
                    <a href="{{ route('home') }}">Dashboard</a>
                    <span>/</span>
                    <span>Layanan Surat</span>
                </div>


            </div>

            <!-- USER CARD -->

            <div class="user-card">

                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>

                <div class="user-info">

                    <h4>
                        {{ session('pengajuan_penduduk_name') }}
                    </h4>

                    <p>
                        NIK :
                        {{ session('pengajuan_nik') }}
                    </p>

                </div>

                <div class="ms-auto">

                    <form action="{{ route('pengajuan.logout') }}" method="GET">

                        <button type="submit" class="btn btn-danger">

                            <i class="fas fa-sign-out-alt"></i>

                            Logout

                        </button>

                    </form>

                </div>

            </div>

            <!-- ALERT -->

            <div class="info-alert">

                <i class="fas fa-info-circle"></i>

                Pilih jenis surat yang ingin Anda ajukan.

            </div>

            <!-- JENIS SURAT -->

            <h3 class="section-title">

                <i class="fas fa-file-alt"></i>

                Pilih Jenis Surat

            </h3>

            <div class="row g-4 mb-5">

                <div class="col-lg-4 col-md-6">

                    <div class="service-card" onclick="showServiceForm('usaha')">

                        <i class="fas fa-store"></i>

                        <h5>Surat Keterangan Usaha</h5>

                        <p>
                            Untuk keterangan kepemilikan usaha
                        </p>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="service-card" onclick="showServiceForm('domisili')">

                        <i class="fas fa-map-marker-alt"></i>

                        <h5>Surat Domisili</h5>

                        <p>
                            Untuk keterangan alamat domisili
                        </p>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="service-card" onclick="showServiceForm('izin_acara')">

                        <i class="fas fa-calendar-alt"></i>

                        <h5>Surat Izin Acara</h5>

                        <p>
                            Untuk kegiatan masyarakat
                        </p>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="service-card" onclick="showServiceForm('pengantar')">

                        <i class="fas fa-envelope-open-text"></i>

                        <h5>Surat Pengantar</h5>

                        <p>
                            Surat pengantar administrasi
                        </p>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="service-card" onclick="showServiceForm('sktm')">

                        <i class="fas fa-hand-holding-heart"></i>

                        <h5>SKTM</h5>

                        <p>
                            Surat Keterangan Tidak Mampu
                        </p>

                    </div>

                </div>

            </div>

            <div id="service-form-container" style="display:none;" class="mb-5">

                <div class="card shadow-sm border-0">

                    <div class="card-body">

                        <h4 id="service-form-title"></h4>

                        <div id="form-message" style="display:none;"></div>

                        <form id="dynamic-service-form" onsubmit="handleFormSubmit(event)">

                            @csrf

                            <input type="hidden" id="tipe_surat" name="tipe_surat">

                            <div id="form-fields"></div>

                            <button type="submit" id="submitBtn" class="btn btn-success mt-3">

                                <i class="fas fa-paper-plane"></i>
                                Kirim Pengajuan

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            <!-- RIWAYAT -->

            <div class="history-wrapper">

                @if ($surats->count() > 0)

                    @foreach ($surats as $surat)
                        <div class="card mb-3 p-3">

                            <div class="d-flex justify-content-between">

                                <div>

                                    <h5>{{ $surat->keterangan }}</h5>

                                    <small>
                                        Nomor Surat:
                                        {{ $surat->nomor_surat }}
                                    </small>

                                    <br>

                                    <small>
                                        Tanggal:
                                        {{ $surat->tanggal_dibuat }}
                                    </small>

                                </div>

                                <div>

                                    @if ($surat->status == 'menunggu')
                                        <span class="status-badge status-menunggu">
                                            Menunggu
                                        </span>
                                    @elseif($surat->status == 'proses')
                                        <span class="status-badge status-proses">
                                            Diproses
                                        </span>
                                    @elseif($surat->status == 'diterima')
                                        <span class="status-badge status-diterima">
                                            Diterima
                                        </span>
                                    @elseif($surat->status == 'ditolak')
                                        <span class="status-badge status-tolak">
                                            Ditolak
                                        </span>
                                    @endif

                                    <br>

                                    @if ($surat->file_pdf)
                                        <a href="{{ asset('storage/' . $surat->file_pdf) }}" target="_blank"
                                            class="btn btn-success btn-sm mt-2">

                                            <i class="fas fa-download"></i>
                                            Download PDF

                                        </a>
                                    @endif

                                </div>

                            </div>

                        </div>
                    @endforeach
                @else
                    <div class="empty-history">

                        <i class="fas fa-folder-open"></i>

                        <h5>
                            Belum Ada Pengajuan Surat
                        </h5>

                        <p>
                            Riwayat pengajuan surat akan muncul di sini.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </section>

    <script>
        const formConfigs = {
            usaha: {
                title: 'Surat Keterangan Usaha (SKU)',
                fields: `
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Nama Usaha
                            </label>
          
                            <input
                                type="text"
                                name="nama_usaha"
                                class="form-control"
                                placeholder="Masukkan nama usaha"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Alamat Usaha
                            </label>

                            <textarea
                                name="alamat_usaha"
                                class="form-control"
                                rows="3"
                                placeholder="Masukkan alamat usaha"
                                required></textarea>
                        </div>
                    `
            },
            domisili: {
                title: 'Surat Keterangan Domisili',
                fields: `

                        <div class="alert alert-info mb-3">
                            Data domisili akan diambil dari data kependudukan yang terdaftar.
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Keperluan
                            </label>

                            <textarea
                                name="keperluan"
                                class="form-control"
                                rows="3"
                                placeholder="Contoh: Persyaratan kerja, kuliah, administrasi bank, dll"
                                required></textarea>
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
                        <input type="text" id="jenis_acara" name="jenis_acara" class="form-control"
                            placeholder="Misal: Pernikahan, Syukuran, dll" required>
                    </div>

                    <div class="form-group">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input type="number" id="jumlah_peserta" name="jumlah_peserta"
                            class="form-control"
                            placeholder="Masukkan jumlah peserta"
                            min="1"
                            required>
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

                    <div class="alert alert-info mb-3">
                        Permohonan SKTM akan diverifikasi oleh pihak desa.
                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Pekerjaan
                        </label>

                        <input
                            type="text"
                            name="pekerjaan"
                            class="form-control"
                            placeholder="Masukkan pekerjaan"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Penghasilan Per Bulan
                        </label>

                        <input
                            type="number"
                            name="penghasilan"
                            class="form-control"
                            placeholder="Contoh: 1500000"
                            required>

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
            document.getElementById('service-form-container').scrollIntoView({
                behavior: 'smooth'
            });
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

                console.log('Sending fetch request to:', '{{ route('pengajuan.store') }}');

                const response = await fetch('{{ route('pengajuan.store') }}', {
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

                messageDiv.innerHTML = `
                        <div class="alert alert-danger">
                            <strong>✗ Error!</strong>
                            Terjadi kesalahan: ${error.message}
                        </div>
                    `;

                messageDiv.style.display = 'block';

            } finally {

                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML =
                        '<i class="fas fa-paper-plane"></i> Kirim Pengajuan';
                }

            }
        }

        function loadHistory() {
            location.reload();
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
